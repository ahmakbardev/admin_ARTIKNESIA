@extends('admin.layouts.layout')

@section('admin_content')
    <div class="flex justify-between items-center mb-4">
        <div>
            <h2 class="text-2xl font-semibold text-white">Manajemen Provinsi</h2>
        </div>
        <div>
            <a href="{{ route('admin.province.create') }}"
               class="bg-white rounded-md px-5 py-3 text-sm font-semibold">Tambah
                Provinsi Baru</a>
        </div>
    </div>

    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table id="article-table"
                   class="min-w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="bg-gray-50 dark:bg-gray-700 text-xs uppercase font-semibold text-gray-700 dark:text-gray-400">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Nama Provinsi</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @if(count($provinces) > 0)
                    @foreach($provinces as $item)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3 text-sm">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 text-sm">{{ $item->name }}</td>
                            <td class="px-4 py-3 text-sm">
                                <a href="{{ route('admin.province.edit', $item->id) }}"
                                   class="bg-yellow-700 text-white px-2 py-0.5 rounded text-sm">Edit</a>
                                <form action="{{ route('admin.province.destroy', $item->id) }}"
                                      method="post"
                                      onsubmit="return confirm('Move data to trash?')">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"
                                            class="bg-red-700 text-white px-2 py-0.5 rounded text-sm">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm text-center" colspan="3">Tidak ada data</td>
                    </tr>
                @endif
                </tbody>
            </table>
            {{ $provinces->links() }}
        </div>
    </div>
@endsection

@section('custom-js')

@endsection