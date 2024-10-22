@extends('admin.layouts.layout')

@section('admin_content')
    <div class="flex justify-between items-center mb-4">
        <div>
            <h2 class="text-2xl font-semibold text-white">Manajemen Karya</h2>
        </div>
        <!-- Date Range Picker with Reset Button -->
        <div class="flex space-x-2 items-center">
            <input type="text" id="dateRangePicker" class="border p-2 rounded text-sm" placeholder="Filter by date range">
            <button id="resetDateRange"
                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded text-sm">Reset</button>
        </div>
    </div>

    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table id="karyaTable" class="min-w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="bg-gray-50 dark:bg-gray-700 text-xs uppercase font-semibold text-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-4 py-3">Nama Karya</th>
                        <th class="px-4 py-3">User</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Tanggal Upload</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach ($karyas as $karya)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3">
                                <a href="javascript:void(0)" class="open-modal text-primary hover:text-primary-dark"
                                    data-id="{{ $karya->id }}">{{ $karya->name }}</a>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $karya->user_name }} <!-- Menampilkan nama user -->
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <select name="status" class="status-dropdown border border-gray-300 p-1 rounded text-xs"
                                    data-id="{{ $karya->id }}">
                                    <option value="pending" {{ $karya->status == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="accepted" {{ $karya->status == 'accepted' ? 'selected' : '' }}>Accepted
                                    </option>
                                    <option value="rejected" {{ $karya->status == 'rejected' ? 'selected' : '' }}>Rejected
                                    </option>
                                </select>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ \Carbon\Carbon::parse($karya->created_at)->format('d M Y') }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <span class="text-success" id="status-msg-{{ $karya->id }}"></span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Structure -->
    <div id="karyaDetailModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-5 rounded-lg shadow-lg w-3/4 md:w-1/2">
            <h2 class="text-xl font-bold mb-3" id="modalKaryaName"></h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <img id="modalKaryaImage" src="" class="w-full h-auto rounded-lg">
                </div>
                <div>
                    <p><strong>Ukuran:</strong> <span id="modalKaryaSize"></span></p>
                    <p><strong>Bahan:</strong> <span id="modalKaryaMaterial"></span></p>
                    <p><strong>Filosofi:</strong> <span id="modalKaryaPhilosophy"></span></p>
                    <p><strong>Harga:</strong> Rp. <span id="modalKaryaPrice"></span></p>
                </div>
            </div>
            <div class="mt-4 text-right">
                <button id="closeModal" class="bg-red-500 text-white px-4 py-2 rounded-lg">Close</button>
            </div>
        </div>
    </div>

    <!-- DataTables and jQuery Date Range Picker scripts -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#karyaTable').DataTable({
                "order": [
                    [3, "desc"]
                ],
                "responsive": true,
                "lengthChange": false,
            });

            // Event delegation for dynamically loaded elements
            $(document).on('click', '.open-modal', function() {
                var karyaId = $(this).data('id');

                $.ajax({
                    url: '/admin/karya/' + karyaId,
                    method: 'GET',
                    success: function(karya) {
                        $('#modalKaryaName').text(karya.name);
                        $('#modalKaryaSize').text(karya.size_x + ' x ' + karya.size_y + ' cm');
                        $('#modalKaryaMaterial').text(karya.material);
                        $('#modalKaryaPhilosophy').text(karya.philosophy);
                        $('#modalKaryaPrice').text(new Intl.NumberFormat().format(karya.price));

                        var images = JSON.parse(karya.images);

                        // Check if the image is from the public folder
                        if (images[0].startsWith('storage/')) {
                            var imageUrl = `{{ asset('${images[0]}') }}`;
                        } else {
                            var imageUrl = images[0];
                        }

                        $('#modalKaryaImage').attr('src', imageUrl);

                        $('#karyaDetailModal').removeClass('hidden');
                    },
                    error: function() {
                        alert('Failed to load karya details');
                    }
                });
            });

            $('#closeModal').click(function() {
                $('#karyaDetailModal').addClass('hidden');
            });

            // Handle status dropdown change
            $(document).on('change', '.status-dropdown', function() {
                var karyaId = $(this).data('id');
                var newStatus = $(this).val();

                $.ajax({
                    url: '/admin/karya/update-status/' + karyaId,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: newStatus
                    },
                    success: function(response) {
                        $('#status-msg-' + karyaId).text('Status updated to ' + newStatus)
                            .fadeIn().delay(2000).fadeOut();
                    },
                    error: function() {
                        alert('Failed to update status');
                    }
                });
            });

            // Initialize Date Range Picker
            $('#dateRangePicker').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                }
            }, function(start, end) {
                // Apply filtering based on the selected date range
                $.fn.dataTable.ext.search.push(
                    function(settings, data, dataIndex) {
                        var uploadDate = data[3]; // Index of 'Tanggal Upload' column
                        var minDate = start.format('YYYY-MM-DD');
                        var maxDate = end.format('YYYY-MM-DD');

                        return (uploadDate >= minDate && uploadDate <= maxDate);
                    }
                );

                table.draw(); // Redraw the table
            });

            // Reset Date Range Filter
            $('#resetDateRange').click(function() {
                $('#dateRangePicker').val('');
                $.fn.dataTable.ext.search.pop(); // Remove date range filter
                table.draw(); // Redraw the table
            });
        });
    </script>
@endsection
