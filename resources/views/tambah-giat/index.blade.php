<!-- resources/views/home.blade.php -->
@extends('layouts.user-app')

@section('title', 'Pengajuan Giat')

@section('content')
<script>
$(document).ready(function() {
  $('#form-giat').on('submit', function(event) {
    event.preventDefault(); // Mencegah form dari pengiriman langsung

    // Mengambil semua nilai dari input dengan name dalam bentuk array
    let formDataArray = $(this).serializeArray();

    // Konversi array menjadi objek untuk payload
    let payload = {};
    formDataArray.forEach(function(item) {
      payload[item.name] = item.value;
    });

    // Array untuk menampung ID hasil ekstraksi dari input "check-"
    let idArray = [];

    // Loop untuk mengekstrak ID dari properti yang diawali dengan "check-" dan menghapusnya dari payload
    for (const key in payload) {
      if (key.startsWith("check-")) {
        // Ambil angka setelah "check-" dan tambahkan ke array
        const id = key.split("-")[1];
        idArray.push(parseInt(id, 10)); // Parse to integer

        // Hapus key dari payload
        delete payload[key];
      }
    }

    // Tambahkan array ID ke payload dengan key "ditugaskan"
    payload.ditugaskan = idArray;
    console.log(payload);

    // Menambahkan data tambahan ke payload

    // Mendapatkan token dari localStorage
    const token = JSON.parse(localStorage.getItem('user')).token;

    $.ajax({
      url: '/api/giat',
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer ' + token
      },
      data: JSON.stringify(payload),
      success: function(response) {
        Swal.fire({
          icon: 'success',
          title: 'Berhasil!',
          text: 'Data giat berhasil diajukan.',
          confirmButtonText: 'OK'
        });
        console.log("Response:", response); // Tampilkan response dari server di console
      },
      error: function(error) {
        Swal.fire({
          icon: 'error',
          title: 'Gagal!',
          text: 'Terjadi kesalahan saat mengajukan data giat.',
          confirmButtonText: 'Coba Lagi'
        });
        console.error("Error:", error); // Tampilkan error jika ada
      }
    });
  });
});
</script>

<div class="w-full min-h-[550px]  bg-white text-zinc-700 rounded-md p-4 flex flex-col items-start">
  <h1 class="font-bold text-4xl W-full">Data Giat</h1>
  <p class="text-lg text-zinc-400 W-full">Isi data untuk pengajuan giat</p>
  <form id="form-giat" class="mt-2 space-y-4 w-full">
    <div class="form-row-1 flex w-full space-x-4 ">
      <x-input type="text" name="kegiatan" value="" label="Nama Kegiatan" />
      <x-input type="text" name="tempat" value="" label="Tempat" />
    </div>

    <div class="form-row-2 flex w-full space-x-4 ">
      <x-input type="text" name="detail_kegiatan" value="" label="Detail Kegiatan" />
    </div>

    <div class="form-row-3 flex w-full space-x-4 ">
      <x-input type="text" name="kendaraan" value="" label="Kendaraan" />
      <x-input type="text" name="beban_biaya" value="" label="Beban Biaya" />
    </div>

    <div class="form-row-4 flex w-full space-x-4 ">
      <x-input type="datetime-local" name="tanggal_mulai" value="" label="Tanggal Mulai" />
      <x-input type="datetime-local" name="tanggal_selesai" value="" label="Tanggal Selesai" />
      <x-input type="datetime-local" name="akses_mulai" value="" label="Akses Mulai" />
      <x-input type="datetime-local" name="akses_selesai" value="" label="Akses Selesai" />
    </div>
    <x-giat-user-table />
    <div class="buttons-container">
      <button type="submit"
        class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Ajukan</button>
      <button type="button"
        class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Batal</button>
    </div>
  </form>

</div>
@endsection