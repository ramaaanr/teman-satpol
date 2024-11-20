@extends('layouts.user-app')

@section('title', 'Pengelolaan Kegiatan')

@section('content')
<form id="form-kegiatan" enctype="multipart/form-data"
  class="w-full text-zinc-700 bg-white rounded-lg shadow-md border border-gray-100 p-6  ">

  <div class="detail-1 flex">
    <div class="header-detail w-full">
      <p id="kegiatan" class="font-bold text-3xl"></p>
      <p id="detail_giat" class=" text-md text-zinc-500"></p>
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
      <x-input :disabled="true" type="time" value="" label="Durasi" name="durasi" />
    </div>
    <div class="w-5/6">
      <x-input :disabled="true" type="text" value="" label="Detail Kegiatan" name="detail" />
    </div>
  </div>
  <div class="input-container flex space-x-4 items-start">
    <div class="w-full">
      <x-item-list :disabled="true" />
    </div>
    <div class="w-full">
      <p class="text-gray-500 font-md mt-2 text-xs">Dokumentasi Lapangan</p>

      <div id="image-preview"
        class="mt-2 w-full h-64 flex items-center justify-center border border-gray-200 rounded-lg hidden">
        <img id="preview-img" src="" alt="Image Preview" class="object-contain w-full h-full" />
      </div>
    </div>



  </div>
  <input type="hidden" id="id_user" name="id_user">
  <input type="hidden" id="id_giat" name="id_giat">
  <input type="hidden" id="status" value="Bertugas" name="status">
  <div class="action-container w-full flex mt-4 space-x-4">
    <div id="back-button" class="button-container w-1/4">
      <x-button color="light" text="Kembali" />
    </div>
  </div>
</form>

<script>
const baseUrl = `${window.location.protocol}//${window.location.host}`;
const fileInput = document.getElementById('dropzone-file');
const previewContainer = document.getElementById('image-preview');
const previewImg = document.getElementById('preview-img');
const url = window.location.href;
let parts = url.split('/');
console.log(parts);
let idPenugasan = parts[6];
const userData = localStorage.getItem('user');
const user = userData ? JSON.parse(userData) : null;
const token = user ? user.token : null;
let imagePreview;
$('#back-button').click(() => {
  window.history.back();
});
// console.log(idPenugasan);

$.ajax({
  url: `/api/penugasan/${idPenugasan}`,
  method: 'GET',
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
    'Authorization': `Bearer ${token}`
  },
  success: function({
    data: {
      id_user,
      id_giat,
      durasi,
      detail,
      status,
      dokumen_lapangan,
      giats: {
        kegiatan,
        detail_kegiatan,
        tempat,
        tanggal_mulai,
        tanggal_selesai,
        jumlah_petugas,
        kendaraan,
      }
    }
  }) {
    imagePreview = dokumen_lapangan ? `${baseUrl}/${dokumen_lapangan.replace("public/", "")}` : '';
    if (imagePreview) {
      previewImg.src = imagePreview; // Set image source to the selected file
      previewContainer.classList.remove('hidden'); // Show the preview container
    }
    $('#durasi').val(durasi);
    $('#detail').val(detail);
    $('#kegiatan').text(kegiatan);
    $('#id_user').val(id_user);
    $('#id_giat').val(id_giat);
    $('#detail_giat').text(detail_kegiatan);
    $('#tempat').text(tempat);
    $('#tanggal').text(`${tanggal_mulai} - ${tanggal_selesai}`);
    $('#petugas').text(jumlah_petugas);
    $('#kendaraan').text(kendaraan);

    // Set tombol aksi berdasarkan status yang diterima
  },
  error: function(xhr, status, error) {
    console.error('Error:', error);
  }
});
</script>


@endsection