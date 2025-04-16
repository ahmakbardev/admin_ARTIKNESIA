@extends('admin.layouts.layout')

@section('admin_content')
    @php
        $currentPage = $exhibitions->currentPage();
        $lastPage = $exhibitions->lastPage();
        $range = 10; // jumlah maksimal tombol angka
        $start = floor(($currentPage - 1) / $range) * $range + 1;
        $end = min($start + $range - 1, $lastPage);
    @endphp

    <div class="flex justify-between items-center mb-4">
        <div>
            <h2 class="text-2xl font-semibold text-white">Manajemen Pameran</h2>
        </div>
        <div>
            <a href="{{ route('admin.exhibition.create') }}"
                class="bg-white rounded-md px-5 py-3 text-sm font-semibold">Tambah
                Pameran Baru</a>
        </div>
    </div>

    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table id="article-table" class="min-w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="bg-gray-50 dark:bg-gray-700 text-xs uppercase font-semibold text-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Event Name</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @if (count($exhibitions) > 0)
                        @foreach ($exhibitions as $item)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3 text-sm">{{ $item->name }}</td>
                                <td class="px-4 py-3 text-sm">

                                    <div class="flex justify-center items-center space-x-4 gap-4">
                                        <a href="{{ route('admin.exhibition.edit', $item->id) }}"
                                            class="bg-yellow-700 text-white px-4 py-2 rounded text-base hover:bg-yellow-800 transition m-2">
                                            Edit
                                        </a>
                                        <div>
                                            <form action="{{ route('admin.exhibition.destroy', $item->id) }}" method="post"
                                                onsubmit="return confirm('Move data to trash?')" class="inline-block">
                                                @csrf
                                                @method('delete')
                                                <button type="submit"
                                                    class="bg-red-700 text-white px-4 py-2 rounded text-base hover:bg-red-800 transition">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>


                                    </div>




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
            <div
                class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                <span class="flex items-center col-span-3">
                    Showing {{ $exhibitions->lastItem() }} of {{ $exhibitions->total() }}
                </span>
                <span class="col-span-2"></span>
                <!-- Pagination -->
                <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                    <nav aria-label="Table navigation" class="overflow-hidden">
                        <ul class="inline-flex items-center">
                            <ul class="inline-flex items-center">

                                {{-- Tombol Previous Window --}}
                                @if ($start > 1)
                                    <li>
                                        <a href="{{ $exhibitions->url($start - 1) }}"
                                            class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">&laquo;</a>
                                    </li>
                                @endif

                                {{-- Angka Halaman --}}
                                @for ($i = $start; $i <= $end; $i++)
                                    <li>
                                        <a href="{{ $exhibitions->url($i) }}"
                                            class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple {{ $currentPage == $i ? 'bg-purple-600 text-white' : '' }}">
                                            {{ $i }}
                                        </a>
                                    </li>
                                @endfor

                                {{-- Tombol Next Window --}}
                                @if ($end < $lastPage)
                                    <li>
                                        <a href="{{ $exhibitions->url($end + 1) }}"
                                            class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">&raquo;</a>
                                    </li>
                                @endif

                            </ul>
                        </ul>
                    </nav>
                </span>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
@endsection
