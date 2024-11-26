<!-- resources/views/giat/edit.blade.php -->
@extends('layouts.user-app')

@section('title', 'Edit Giat')

@section('content')
<script>
$(document).ready(function() {
  const url = window.location.href;
  const id = url.split("/").pop();
  const userData = localStorage.getItem('user');
  const user = userData ? JSON.parse(userData) : null;
  const token = user ? user.token : null;

  // Redirect if there's no token
  if (!token) {
    console.error("Token not found.");
    return;
  }

  // Pastikan userData ada dan di-parse menjadi objek

  $.ajax({
    url: '/api/users',
    method: 'GET',
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      'Authorization': `Bearer ${token}`
    },
    success: function({
      data: users
    }) {
      users.forEach(user => {
        const tableRow =
          `<x-giat-user-table-row id=${user.id} nama="${user.nama}" nip="${user.NIP}" jabatan="${user.jabatan}" />`;
        $('#table-body-giat-user').append(tableRow);
      });
    },
    error: function(xhr, status, error) {
      console.error('Error:', error);
    }
  }).then(() => {


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

          // Fill in the form fields with existing data
          $("#kegiatan").val(data.Data.kegiatan);
          $("#tempat").val(data.Data.tempat);
          $("#detail_kegiatan").val(data.Data.detail_kegiatan);
          $("#kendaraan").val(data.Data.kendaraan);
          $("#beban_biaya").val(data.Data.beban_biaya);
          $("#tanggal_mulai").val(data.Data.tanggal_mulai_raw);
          $("#tanggal_selesai").val(data.Data.tanggal_selesai_raw);
          $("#akses_mulai").val(data.Data.akses_mulai_raw);
          $("#akses_selesai").val(data.Data.akses_selesai_raw);

          const penugasans = data.Data.penugasans;
          penugasans.forEach(({
            user
          }) => {
            // Ensure the checkbox for the user is checked by matching the user id with the checkbox id
            $("#check-ditugaskan-" + user.id).prop('checked', "true");
          });

          // Populate any additional table or fields as needed
        } else {
          console.error("Failed to retrieve data:", data.message);
        }
      },
      error: function(xhr, status, error) {
        console.error("Error retrieving data:", error);
      }
    });

    // Handle form submission for updating data
    $('#form-giat').on('submit', function(event) {
      event.preventDefault();

      // Gather form data
      let formDataArray = $(this).serializeArray();
      let payload = {};
      formDataArray.forEach(function(item) {
        payload[item.name] = item.value;
      });

      // Handle selected ID fields
      let idArray = [];
      for (const key in payload) {
        if (key.startsWith("check-")) {
          const id = key.split("-")[1];
          idArray.push(parseInt(id, 10));
          delete payload[key];
        }
      }
      payload.ditugaskan = idArray;

      $.ajax({
        url: `/api/giat/${id}`, // Update URL
        method: 'PATCH', // Update method
        headers: {
          'Content-Type': 'application/json',
          'Authorization': 'Bearer ' + token
        },
        data: JSON.stringify(payload),
        beforeSend: function() {
          // Tampilkan spinner atau disable tombol saat proses pengiriman
          Swal.fire({
            title: 'Mohon Tunggu',
            html: 'Sedang memproses data...',
            allowOutsideClick: false,
            didOpen: () => {
              Swal.showLoading();
            }
          });
        },
        success: function(response) {
          Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Data giat berhasil diperbarui.',
            confirmButtonText: 'OK'
          }).then(() => {
            window.location.href = '/data-giat/'
          });
          console.log("Response:", response);
        },
        error: function(error) {
          Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: 'Terjadi kesalahan saat memperbarui data giat.',
            confirmButtonText: 'Coba Lagi'
          });
          console.error("Error:", error);
        }
      });
    });
  });
  $('#delete-button').on('click', function() {
    Swal.fire({
      title: 'Apakah Anda yakin?',
      text: "Data ini akan dihapus dan tidak bisa dikembalikan!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya, Hapus!',
      cancelButtonText: 'Batal',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: `/api/giat/${id}`, // Delete URL
          method: 'DELETE', // Use DELETE method for API
          headers: {
            'Authorization': 'Bearer ' + token,
            'Content-Type': 'application/json'
          },
          success: function(response) {
            Swal.fire({
              icon: 'success',
              title: 'Berhasil!',
              text: 'Data giat berhasil dihapus.',
              confirmButtonText: 'OK'
            }).then(() => {
              // Optionally, redirect the user to another page or refresh the page
              window.location.href = '/data-giat'; // Redirect to the list of activities
            });
          },
          error: function(error) {
            Swal.fire({
              icon: 'error',
              title: 'Gagal!',
              text: 'Terjadi kesalahan saat menghapus data giat.',
              confirmButtonText: 'Coba Lagi'
            });
            console.error("Error:", error);
          }
        });
      }
    });
  });
});
</script>

<div class="w-full min-h-[550px] bg-white text-zinc-700 rounded-md p-4 flex flex-col items-start">
  <h1 class="font-bold text-4xl W-full">Edit Data Giat</h1>
  <p class="text-lg text-zinc-400 W-full">Ubah data giat yang diinginkan</p>
  <div class="alert-container w-1/2 mt-2">
    <x-alert loading title="Loading" info="Sedang Memuat Data! Mohon ditunggu"></x-alert>
  </div>
  <form id="form-giat" class="mt-2 space-y-4 w-full hidden">
    <div class="form-row-1 flex w-full space-x-4">
      <x-input value="" type="text" name="kegiatan" id="kegiatan" label="Nama Kegiatan" />
      <x-input value="" type="text" name="tempat" id="tempat" label="Tempat" />
    </div>

    <div class="form-row-2 flex w-full space-x-4">
      <x-input value="" type="text" name="detail_kegiatan" id="detail_kegiatan" label="Detail Kegiatan" />
    </div>

    <div class="form-row-3 flex w-full space-x-4">
      <x-input value="" type="text" name="kendaraan" id="kendaraan" label="Kendaraan" />
      <x-input value="" type="text" name="beban_biaya" id="beban_biaya" label="Beban Biaya" />
    </div>

    <div class="form-row-4 flex w-full space-x-4">
      <x-input value="" type="datetime-local" name="tanggal_mulai" id="tanggal_mulai" label="Tanggal Mulai" />
      <x-input value="" type="datetime-local" name="tanggal_selesai" id="tanggal_selesai" label="Tanggal Selesai" />
      <x-input value="" type="datetime-local" name="akses_mulai" id="akses_mulai" label="Akses Mulai" />
      <x-input value="" type="datetime-local" name="akses_selesai" id="akses_selesai" label="Akses Selesai" />
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-6 py-3 ">
              Ditugaskan?
            </th>
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

    <div class="buttons-container">
      <button type="submit"
        class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Perbarui</button>
      <button type="button" onclick="window.history.back()"
        class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Batal</button>
      <button type="button" id="delete-button"
        class="text-white bg-red-400 border border-gray-300 focus:outline-none hover:bg-red-500 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
        Hapus
      </button>
    </div>
  </form>
</div>
@endsection