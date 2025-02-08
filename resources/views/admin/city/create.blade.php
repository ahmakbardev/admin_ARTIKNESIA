@extends('admin.layouts.layout')

@section('admin_content')
    <div class="flex justify-between items-center mb-4">
        <a href="{{ route('admin.city.index') }}" class="text-white">Kembali</a>
        <div>
            <h2 class="text-2xl font-semibold text-white">Form Tambah Kota</h2>
        </div>
    </div>
    <div class="w-full">
        <form action="{{route('admin.city.store')}}" method="post"
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
            <div class="w-full">
                <label class="text-white text-sm">Provinsi</label>
                <select class="w-full px-2 rounded-md h-6" name="province_id" id="province_id"
                >
                    @foreach($provinces as $item)
                        <option value="{{ $item->id }}" @selected($item->id == old('province_id'))>{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('province_id')
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