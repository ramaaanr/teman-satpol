<!-- resources/views/home.blade.php -->
@extends('layouts.user-app')

@section('title', 'Pengelolaan Data Giat')

@section('content')
<div class="w-full min-h-[550px]  bg-white rounded-md p-4 flex flex-col items-center">
  <div class="actions-container flex py-2 w-full justify-start space-x-1">
    <button type="button"
      class="text-white  bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5  dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Berlangsung</button>
    <button type="button"
      class="text-gray-900  bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5  dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Selesai</button>
    <button type="button"
      class="text-gray-900  bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5  dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Dibatalkan</button>

    <form class="flex items-center max-w-sm">
      <label for="simple-search" class="sr-only">Search</label>
      <div class="relative w-full">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
          <span class="material-symbols-outlined text-gray-500">
            event
          </span>
        </div>
        <input type="text" id="simple-search"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          placeholder="Nama Kegiatan" required />
      </div>
      <button type="submit"
        class="p-2.5 ms-2 text-sm font-medium text-white bg-yellow-300 rounded-lg border  hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-yellow-200 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
        </svg>
        <span class="sr-only">Cari</span>
      </button>
    </form>

  </div>
  <div class="card-giat-container w-full p-2 space-y-4">
  </div>
  <script>
  $(document).ready(function() {
    // Ambil data user dari localStorage
    const userData = localStorage.getItem('user');

    // Pastikan userData ada dan di-parse menjadi objek
    const user = userData ? JSON.parse(userData) : null;
    const token = user ? user.token : null;

    $.ajax({
      url: '/api/giat',
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'Authorization': `Bearer ${token}`
      },
      success: function({
        data
      }) {
        data.forEach(({
          id,
          kegiatan,
          detail_kegiatan,
          tempat,
          kendaraan,
          beban_biaya,
          tanggal_mulai,
          tanggal_selesai,
          akses_mulai,
          akses_selesai,
          jumlah_ditugaskan,
          jumlah_selesai,
        }) => {
          const item = `
            <x-card-giat-item 
id="${id}"
kegiatan="${kegiatan}"
detailKegiatan="${detail_kegiatan}"
tempat="${tempat}"
kendaraan="${kendaraan}"
bebanBiaya="${beban_biaya}"
tanggalMulai="${tanggal_mulai}"
tanggalSelesai="${tanggal_selesai}"
aksesMulai="${akses_mulai}"
aksesSelesai="${akses_selesai}"
jumlahDitugaskan="${jumlah_ditugaskan}"
jumlahSelesai="${jumlah_selesai}"
            />
            `
          $('.card-giat-container').append(item);
        });
      },
      error: function(xhr, status, error) {
        console.error('Error:', error);
      }
    });
  });
  </script>
</div>
@endsection