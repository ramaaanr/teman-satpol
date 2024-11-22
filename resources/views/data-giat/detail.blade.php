<!-- resources/views/home.blade.php -->
@extends('layouts.user-app')

@section('title', 'Pengelolaan Giat')

@section('content')

<div class="w-full min-h-[550px] bg-white text-zinc-700 rounded-md p-4 flex flex-col items-start">
  <h1 class="font-bold text-4xl W-full">Detail Giat</h1>
  <p class="text-lg text-zinc-400 W-full">detail dari giat yang dilakukan</p>
  <div class="alert-container w-1/2 mt-2">
    <x-alert loading title="Loading" info="Sedang Memuat Data! Mohon ditunggu"></x-alert>
  </div>
  <form id="form-giat" class="mt-2 space-y-4 w-full hidden">
    <div class="form-row-1 flex w-full space-x-4 ">
      <x-detail-item id="kegiatan" value="" label="Nama Kegiatan" />
      <x-detail-item id="tempat" value="" label="Tempat" />
    </div>

    <div class="form-row-2 flex w-full space-x-4 ">
      <x-detail-item id="detail" value="" label="Detail Kegiatan" />
    </div>

    <div class="form-row-3 flex w-full space-x-4 ">
      <x-detail-item id="kendaraan" value="" label="Kendaraan" />
      <x-detail-item id="beban_biaya" value="" label="Beban Biaya" />
    </div>

    <div class="form-row-4 flex w-full space-x-4 ">
      <x-detail-item id="tanggal_mulai" value="" label="Tanggal Mulai" />
      <x-detail-item id="tanggal_selesai" value="" label="Tanggal Selesai" />
      <x-detail-item id="akses_mulai" value="" label="Akses Mulai" />
      <x-detail-item id="akses_selesai" value="" label="Akses Selesai" />
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-6 py-3">
              Nama
            </th>
            <th scope="col" class="px-6 py-3">
              NIP
            </th>
            <th scope="col" class="px-6 py-3">
              Jabatan
            </th>
          </tr>
        </thead>
        <tbody id="table-body-giat-user">

        </tbody>
      </table>
    </div>
  </form>
</div>

<script>
$(document).ready(function() {
  const url = window.location.href;
  const id = url.split("/").pop();
  const userData = localStorage.getItem('user');

  const user = userData ? JSON.parse(userData) : null;
  const token = user ? user.token : null;

  if (!token) {
    console.error("Token not found.");
    return;
  }

  $.ajax({
    url: `/api/giat/${id}`,
    method: "GET",
    headers: {
      "Authorization": `Bearer ${token}`,
      "Content-Type": "application/json",
    },
    success: function(data) {
      $('.alert-container').addClass('hidden');
      $('#form-giat').removeClass('hidden');
      if (data.status) {
        // Update values inside each detail-item component
        $("#kegiatan .value-display").text(data.Data.kegiatan);
        $("#tempat .value-display").text(data.Data.tempat);
        $("#detail .value-display").text(data.Data.detail_kegiatan);
        $("#kendaraan .value-display").text(data.Data.kendaraan);
        $("#beban_biaya .value-display").text(data.Data.beban_biaya);
        $("#tanggal_mulai .value-display").text(data.Data.tanggal_mulai);
        $("#tanggal_selesai .value-display").text(data.Data.tanggal_selesai);
        $("#akses_mulai .value-display").text(data.Data.akses_mulai);
        $("#akses_selesai .value-display").text(data.Data.akses_selesai);

        // Populate the assignment table if available
        data.Data.penugasans.forEach(penugasan => {
          const user = penugasan.user;
          const tableRow =
            `<x-detail-giat-user-table-row id=${user.id} nama="${user.nama}" nip="${user.NIP}" jabatan="${user.jabatan}" />`;
          $('#table-body-giat-user').append(tableRow);
        });
      } else {
        console.error("Failed to retrieve data:", data.message);
      }
    },
    error: function(xhr, status, error) {
      console.error("Error retrieving data:", error);
    }
  });
});
</script>

@endsection