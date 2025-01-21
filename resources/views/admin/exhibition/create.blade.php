@extends('admin.layouts.layout')

@section('admin_content')
    <div class="flex justify-between items-center mb-4">
        <a href="{{ route('admin.exhibition.index') }}" class="text-white">Kembali</a>
        <div>
            <h2 class="text-2xl font-semibold text-white">Form Tambah Pameran</h2>
        </div>
    </div>
    <div>
        <livewire:exhibition-form-create></livewire:exhibition-form-create>
    </div>
@endsection

@section('custom-css')
@endsection

@section('custom-js')
@endsection