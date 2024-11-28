<!-- resources/views/home.blade.php -->
@extends('layouts.user-app')

@section('title', 'Pengelolaan Data Giat')

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
  <div class="card-giat-container w-full p-2 space-y-4">


  </div>
  <script>
  $(document).ready(function() {
    // Ambil data user dari localStorage
    const userData = localStorage.getItem('user');

    // Pastikan userData ada dan di-parse menjadi objek
    const user = userData ? JSON.parse(userData) : null;
    const token = user ? user.token : null;

    const fetchingData = (status) => {
      $.ajax({
        url: `/api/giat?status=${status}`,
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'Authorization': `Bearer ${token}`
        },
        beforeSend: () => {
          $('.card-giat-container').html(`
    <x-alert loading title="Loading" info="Data Giat sedang dimuat" />
        
        `)
        },
        success: function({
          data
        }) {
          $('.card-giat-container').html(``)
          if (data.length === 0) {
            $('.card-giat-container').html(`
    <x-alert title="Data Kosong" info="Tidak ada giat yang diajukan" />
        `);
          } else {
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
              if (status === 'selesai' || status === 'dibatalkan') {
                const item = `
                      <x-card-giat-item 
                      disabled
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
              } else {
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
              }

            });
          }
        },
        error: function(xhr, status, error) {
          console.error('Error:', error);
        }
      });
    }



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
</div>
@endsection