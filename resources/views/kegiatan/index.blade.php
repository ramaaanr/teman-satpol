<!-- resources/views/home.blade.php -->
@extends('layouts.user-app')

@section('title', 'Kegiatan Pegawai')

@section('content')
<div class="w-full min-h-[550px]  bg-white rounded-md p-4 flex flex-col items-center">
  <div class="actions-container flex py-2 w-full justify-start space-x-1">
    <button id="button-giat-berlangsung" type="button"
      class="text-gray-900  bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5  dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Berlangsung</button>
    <button id="button-giat-selesai" type="button"
      class="text-gray-900  bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5  dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Selesai</button>
    <button id="button-giat-dibatalkan" type="button"
      class="text-gray-900  bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5  dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Dibatalkan</button>



  </div>
  <div id="card-kegiatan-container" class=" w-full p-2 space-y-4">
  </div>
</div>
<script>
$(document).ready(function() {
  // Fungsi untuk mengambil data JSON dan menampilkannya
  const userData = localStorage.getItem('user');
  // Pastikan userData ada dan di-parse menjadi objek
  const user = userData ? JSON.parse(userData) : null;
  const token = user ? user.token : null;
  const idUser = user.id;

  const fetchingData = (status) => {
    $.ajax({
      url: `/api/penugasan?id_user=${idUser}&status${status}`, // Sesuaikan URL JSON
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'Authorization': `Bearer ${token}`
      },
      dataType: 'json',
      beforeSend: () => {
        $('#card-kegiatan-container').html(`
    <x-alert loading title="Loading" info="Data kegiatan sedang dimuat" />
        `)
      },
      success: function({
        data
      }) {
        $('#card-kegiatan-container').html(``)
        if (!data) {
          $('#card-kegiatan-container').html(`
    <x-alert title="Data Kosong" info="Tidak ada kegiatan yang diajukan" />
        `);
        } else {
          // Loop untuk menampilkan data kegiatan
          data.forEach(function({
            id_penugasan,
            status,
            giats: {
              kegiatan,
              detail_kegiatan,
              tempat,
              tanggal_mulai,
              tanggal_selesai,
              jumlah_petugas,
              kendaraan,
            }
          }) {
            const colors = {
              "Bertugas": 'blue',
              "Ditugaskan": 'yellow',
              "Disetujui": 'green',
              "Ditolak": 'red',
            }
            const color = colors[status];
            let kegiatanItem =
              `<x-card-kegiatan-item id="${id_penugasan}" color="${color}" kegiatan="${kegiatan}" status="${status}" detail="${detail_kegiatan}" tempat="${tempat}" tanggal="${tanggal_mulai} - ${tanggal_selesai}" petugas="${jumlah_petugas}" kendaraan="${kendaraan}" />`
            $('#card-kegiatan-container').append(kegiatanItem);
          });
        }

      },
      error: function() {
        console.error('Gagal mengambil data kegiatan.');
      }
    });
  };


  $('#button-giat-berlangsung').on('click', () => {
    fetchingData("");

  })
  $('#button-giat-selesai').on('click', () => {
    fetchingData("selesai");
  })
  $('#button-giat-dibatalkan').on('click', () => {
    fetchingData("dibatalkan");
  })

  fetchingData("");

});
</script>
@endsection