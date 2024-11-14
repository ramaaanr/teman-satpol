<!-- resources/views/home.blade.php -->
@extends('layouts.user-app')

@section('title', 'Pengelolaan Giat')

@section('content')
<div class="w-full text-zinc-700 bg-white rounded-lg shadow-md border border-gray-100 p-6  ">

  <div class="detail-1 flex">
    <div class="header-detail w-full">
      <p class="font-bold text-3xl">Kegiatan Memilanduk</p>
      <p class=" text-md text-zinc-500">memilanduk dengan sahabat</p>
    </div>
    <div class="actions-detail flex items-center space-x-4">
      <p class="flex space-x-1">
        <span class="text-yellow-300 font-semibold">120</span>
        <span class="text-zinc-700 font-semibold">Ditugaskan</span>
      </p>
      <p class="flex space-x-1">
        <span class="text-blue-500 font-semibold">12</span>
        <span class="text-zinc-700 font-semibold">Mengajukan</span>
      </p>
      <p class="flex space-x-1">
        <span class="text-green-500 font-semibold">5</span>
        <span class="text-zinc-700 font-semibold">Diterima</span>
      </p>
      <p class="flex space-x-1">
        <span class="text-red-500 font-semibold">2</span>
        <span class="text-zinc-700 font-semibold">Ditolak</span>
      </p>

    </div>
  </div>

  <div class="detail-2 mt-2 flex">
    <div class="detail-content flex items-start w-full">
      <span class="material-symbols-outlined mr-1 text-gray-300">
        location_on
      </span>
      <p class="text-sm text-gray-700">Jl. Veteran Gang Kelurahan blbladpiadoiah</p>
    </div>
    <div class="detail-content flex items-start w-full">
      <span class="material-symbols-outlined mr-1 text-gray-300">
        calendar_month
      </span>
      <p class="text-sm text-gray-700">19 September 2024, 08:00 WITA - 19 September 2024 24:00 WITA</p>
    </div>
  </div>
  <hr class="border border-gray-300 my-4">
  <p class="text-sm text-zinc-400">Diperintahkan Kepada</p>
  <x-review-kegiatan-user-table />
</div>
@endsection