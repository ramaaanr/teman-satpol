<!-- resources/views/home.blade.php -->
@extends('layouts.user-app')

@section('title', 'Pengelolaan Kegiatan')

@section('content')
<div class="w-full text-zinc-700 bg-white rounded-lg shadow-md border border-gray-100 p-6  ">

  <div class="detail-1 flex">
    <div class="header-detail w-full">
      <p id="kegiatan" class="font-bold text-3xl"></p>
      <p id="detail" class=" text-md text-zinc-500"></p>
    </div>
  </div>

  <div class="detail-2 mt-2 flex">
    <div class="detail-content flex items-start w-full">
      <span class="material-symbols-outlined mr-1 text-gray-300">
        location_on
      </span>
      <p id="tempat" class="text-sm text-gray-700"></p>
    </div>
    <div class="detail-content flex items-start w-full">
      <span class="material-symbols-outlined mr-1 text-gray-300">
        calendar_month
      </span>
      <p id="tanggal" class="text-sm text-gray-700"></p>
    </div>
  </div>
  <div class="detail-3 mt-2 flex items-center">

    <div class="detail-content flex items-start w-full">
      <span class="material-symbols-outlined mr-1 text-gray-300">
        groups
      </span>
      <p class="text-sm flex space-x-1  text-gray-700"><span id="petugas" class="mr-1"></span> petugas</p>
    </div>
    <div class="detail-content flex items-start w-full">
      <span class="material-symbols-outlined mr-1 text-gray-300">
        airport_shuttle
      </span>
      <p id="kendaraan" class="text-sm text-gray-700"></p>
    </div>
  </div>
  <hr class="border text-gray-400 my-4">

  <div class="input-container flex space-x-4">
    <div class="w-1/6">
      <x-input type="time" value="" label="Durasi" name="durasi" />
    </div>
    <div class="w-5/6">
      <x-input type="text" value="" label="Detail Kegiatan" name="detail" />
    </div>
  </div>
  <div class="input-container flex space-x-4 items-start">
    <div class="w-full">
      <x-item-list />
    </div>
    <div class="flex items-center justify-center w-full mt-8">
      <label for="dropzone-file"
        class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
        <div class="flex flex-col items-center justify-center pt-5 pb-6">
          <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
          </svg>
          <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span>
            or drag and drop</p>
          <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
        </div>
        <input id="dropzone-file" type="file" class="hidden" />
      </label>
    </div>
  </div>
  <div class="action-container w-full flex mt-4 space-x-4">
    <div class="button-container w-1/4">
      <x-button color="gray" text="Ajukan" />
    </div>
    <div class="button-container w-1/4">
      <x-button color="light" text="Batal" />
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
  // Ambil data user dari localStorage
  // Pastikan userData ada dan di-parse menjadi objek
  $.ajax({
    url: '/samples/detail-data-kegiatan.json',
    method: 'GET',
    success: function({
      kegiatan,
      detail_kegiatan,
      tempat,
      tanggal,
      jumlah_petugas,
      kendaraan,
    }) {
      $('#kegiatan').text(kegiatan);
      $('#detail').text(detail_kegiatan);
      $('#tempat').text(tempat);
      $('#tanggal').text(tanggal);
      $('#petugas').text(jumlah_petugas);
      $('#kendaraan').text(kendaraan);
    },
    error: function(xhr, status, error) {
      console.error('Error:', error);
    }
  });
});
</script>
@endsection