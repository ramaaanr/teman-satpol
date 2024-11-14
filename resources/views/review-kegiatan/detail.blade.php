<!-- resources/views/home.blade.php -->
@extends('layouts.user-app')

@section('title', 'Pengelolaan Giat')

@section('content')

<div class="w-full min-h-[550px]  bg-white text-zinc-700 rounded-md p-4 flex flex-col items-start">
  <h1 class="font-bold text-4xl W-full">Detail Giat</h1>
  <p class="text-lg text-zinc-400 W-full">detail dari giat yang dilakukan</p>
  <form id="form-giat" class="mt-2 space-y-4 w-full">
    <div class="form-row-1 flex w-full space-x-4 ">
      <x-detail-item value="Penjagaan Wilayah PPDB" label="Nama Kegiatan" />
      <x-detail-item value="Jl. A Yani" label="Tempat" />
    </div>

    <div class="form-row-2 flex w-full space-x-4 ">
      <x-detail-item value="Melkaukan penjagaan untuk wilayah sekitar PPDB rutin dengan penjagaan ketat"
        label="Detail Kegiatan" />
    </div>

    <div class="form-row-3 flex w-full space-x-4 ">
      <x-detail-item value="Mobil Dinas" label="Kendaraan" />
      <x-detail-item value="Sesuia Ketentuan" label="Beban Biaya" />
    </div>

    <div class="form-row-4 flex w-full space-x-4 ">
      <x-detail-item value="20 November 2024" label="Tanggal Mulai" />
      <x-detail-item value="22 Novmber 2024" label="Tanggal Selesai" />
      <x-detail-item value="21 November 2024" label="Akses Mulai" />
      <x-detail-item value="22 Novmber 2024" label="Akses Selesai" />
    </div>
    <x-detail-giat-user-table />
  </form>

</div>
@endsection