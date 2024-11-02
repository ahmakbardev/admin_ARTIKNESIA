@extends('admin.layouts.layout')

@section('admin_content')
    <div class="flex justify-between items-center mb-4">
        <div>
            <h2 class="text-2xl font-semibold text-white">Manajemen Artikel</h2>
        </div>
        <!-- Date Range Picker with Reset Button -->
        <div class="flex space-x-2 items-center">
            <input type="text" id="dateRangePicker" class="border p-2 rounded text-sm"
                   placeholder="Filter by date range">
            <button id="resetDateRange"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded text-sm">Reset
            </button>
        </div>
    </div>

    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <a href="{{ route('admin.article.create') }}" class="bg-white rounded-md px-2 py-1 text-sm font-semibold">Tambah
                Artikel</a>
            <table id="article-table" class="min-w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="bg-gray-50 dark:bg-gray-700 text-xs uppercase font-semibold text-gray-700 dark:text-gray-400">
                <tr>
                    <th class="px-4 py-3">Judul Artikel</th>
                    <th class="px-4 py-3">Author</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Tanggal Upload</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($articles as $item)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm">{{ $item->title }}</td>
                        <td class="px-4 py-3 text-sm">{{ $item->author->name }}</td>
                        <td class="px-4 py-3 text-sm">{{ $item->status }}</td>
                        <td class="px-4 py-3 text-sm">{{ $item->created_at }}</td>
                        <td class="px-4 py-3 text-sm">
                            <a href="{{ route('admin.article.edit', $item->slug) }}"
                               class="bg-yellow-700 text-white px-2 py-0.5 rounded text-sm">Edit</a>
                            <form action="{{ route('admin.article.destroy', $item->slug) }}" method="post"
                                  onsubmit="return confirm('Move data to trash?')">
                                @csrf
                                @method('delete')
                                <button type="submit" class="bg-red-700 text-white px-2 py-0.5 rounded text-sm">Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('custom-js')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            let table = $('#article-table').DataTable({
                "responsive": true,
                "lengthChange": false,
            });

            $('#dateRangePicker').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                }
            }, function (start, end) {
                // Apply filtering based on the selected date range
                $.fn.dataTable.ext.search.push(
                    function (settings, data, dataIndex) {
                        var uploadDate = data[3]; // Index of 'Tanggal Upload' column
                        var minDate = start.format('YYYY-MM-DD');
                        var maxDate = end.format('YYYY-MM-DD');

                        return (uploadDate >= minDate && uploadDate <= maxDate);
                    }
                );

                table.draw(); // Redraw the table
            });

            // Reset Date Range Filter
            $('#resetDateRange').click(function () {
                $('#dateRangePicker').val('');
                $.fn.dataTable.ext.search.pop(); // Remove date range filter
                table.draw(); // Redraw the table
            });
        })
    </script>
@endsection