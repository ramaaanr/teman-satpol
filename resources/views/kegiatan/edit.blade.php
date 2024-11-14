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
    <div class="flex flex-col space-y-4 w-full">
      <!-- Preview Image -->

      <div class="flex items-center justify-center w-full mt-8">
        <label for="dropzone-file"
          class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50  dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
          <div class="flex flex-col items-center justify-center pt-5 pb-6">
            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
            </svg>
            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Tekan untuk mengirim
                dokumentasi lapangan</span> atau tarik dan taruh</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, JPEG (MAX. 800x400px)</p>
          </div>
          <input id="dropzone-file" type="file" class="hidden" accept="image/*" />
        </label>
      </div>
      <div id="image-preview"
        class="mt-4 w-full h-64 flex items-center justify-center border-2 border-gray-300 rounded-lg hidden">
        <img id="preview-img" src="" alt="Image Preview" class="object-contain w-full h-full" />
      </div>

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
  const url = window.location.href;
  const id = url.split("/").pop();
  const userData = localStorage.getItem('user');
  const user = userData ? JSON.parse(userData) : null;
  const token = user ? user.token : null;

  $.ajax({
    url: `/api/penugasan/${id}`,
    method: 'GET',
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      'Authorization': `Bearer ${token}`
    },
    success: function({
      data: {
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
      $('#kegiatan').text(kegiatan);
      $('#detail').text(detail_kegiatan);
      $('#tempat').text(tempat);
      $('#tanggal').text(`${tanggal_mulai} - ${tanggal_selesai}`);
      $('#petugas').text(jumlah_petugas);
      $('#kendaraan').text(kendaraan);
    },
    error: function(xhr, status, error) {
      console.error('Error:', error);
    }
  });
  const fileInput = document.getElementById('dropzone-file');
  const previewContainer = document.getElementById('image-preview');
  const previewImg = document.getElementById('preview-img');

  // When a file is selected
  fileInput.addEventListener('change', function(event) {
    const file = event.target.files[0];

    // Check if the file is an image
    if (file && file.type.startsWith('image')) {
      const reader = new FileReader();

      // Set up the file reader to display the image
      reader.onload = function(e) {
        previewImg.src = e.target.result; // Set image source to the selected file
        previewContainer.classList.remove('hidden'); // Show the preview container
      };

      // Read the file as a data URL
      reader.readAsDataURL(file);
    } else {
      // If the file is not an image, hide the preview container
      previewContainer.classList.add('hidden');
      alert("Please select a valid image file.");
    }
  });
});
</script>
@endsection