@extends('admin.layouts.layout')

@section('admin_content')
    <div class="flex justify-between items-center mb-4">
        <a href="{{ route('admin.province.index') }}" class="text-white">Kembali</a>
        <div>
            <h2 class="text-2xl font-semibold text-white">Form Tambah Provinsi</h2>
        </div>
    </div>
    <div class="w-full">
        <form action="{{route('admin.province.store')}}" method="post"
              class="flex flex-col gap-4 w-full">
            @csrf
            <div class="w-full">
                <label class="text-white text-sm">Name</label>
                <input class="w-full px-2 rounded-md" name="name" id="name"
                       value="{{old('name')}}"
                />
                @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md w-full">
                Simpan
            </button>
        </form>
    </div>
@endsection

@section('custom-css')
@endsection

@section('custom-js')
@endsection