@extends('admin.layouts.layout')

@section('admin_content')
    <div class="flex justify-between items-center mb-4">
        <div>
            <h2 class="text-2xl font-semibold text-white">Manajemen Writer</h2>
        </div>
    </div>

    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <a href="{{ route('admin.writer.create') }}" class="bg-white rounded-md px-2 py-1 text-sm font-semibold">Tambah
                Writer</a>
            <table id="writer-table" class="min-w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="bg-gray-50 dark:bg-gray-700 text-xs uppercase font-semibold text-gray-700 dark:text-gray-400">
                <tr>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($writers as $item)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm">{{ $item->name }}</td>
                        <td class="px-4 py-3 text-sm">{{ $item->email }}</td>
                        <td class="px-4 py-3 text-sm">
                            <a href="{{ route('admin.writer.edit', $item->id) }}"
                               class="bg-yellow-700 text-white px-2 py-0.5 rounded text-sm">Edit</a>
                            <form action="{{ route('admin.writer.destroy', $item->id) }}" method="post"
                                  onsubmit="return confirm('Are you sure remove this data?')">
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
            $('#writer-table').DataTable({
                "responsive": true,
                "lengthChange": false,
            });
        })
    </script>
@endsection