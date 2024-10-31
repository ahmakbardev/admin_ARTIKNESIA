@extends('admin.layouts.layout')

@section('admin_content')
    <div class="flex justify-between items-center mb-4">
        <a href="{{ route('admin.writer.index') }}" class="text-white">Kembali</a>
        <div>
            <h2 class="text-2xl font-semibold text-white">Tambah Writer Baru</h2>
        </div>
    </div>

    <div>
        @if ($errors->any())
            <div class="bg-red-600 text-white w-full">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route('admin.writer.store')}}" method="POST">
            @csrf
            <div class="w-1/2 flex flex-col gap-y-3">
                <div class="w-full">
                    <label class="text-white text-sm">Nama</label>
                    <input type="text" class="w-full px-2 rounded-md h-8" name="name" id="name"/>
                </div>
                <div class="w-full">
                    <label class="text-white text-sm">Username</label>
                    <input type="text" class="w-full px-2 rounded-md h-8" name="username" id="username"/>
                </div>
                <div class="w-full">
                    <label class="text-white text-sm">Email</label>
                    <input type="email" class="w-full px-2 rounded-md h-8" name="email" id="email"/>
                </div>
                <div class="w-full">
                    <label class="text-white text-sm">Password</label>
                    <input type="password" class="w-full px-2 rounded-md h-8" name="password" id="password"/>
                </div>
                <div class="w-full">
                    <button type="submit" class="bg-blue-600 text-white rounded-md px-3 py-1 w-full">Simpan</button>
                </div>
            </div>
        </form>
    </div>
@endsection