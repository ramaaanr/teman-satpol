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
          <input name="dokumen_lapangan" id="dropzone-file" type="file" class="hidden" accept="image/*" />
        </label>
      </div>
      <div id="image-preview"
        class="mt-4 w-full h-64 flex items-center justify-center border-2 border-gray-300 rounded-lg hidden">
        <img id="preview-img" src="" alt="Image Preview" class="object-contain w-full h-full" />
      </div>

    </div>
  </div>
  <input type="hidden" id="id_user" name="id_user">
  <input type="hidden" id="id_giat" name="id_giat">
  <input type="hidden" id="status" value="Bertugas" name="status">
  <div class="action-container w-full flex mt-4 space-x-4">
    <div class="button-container w-1/4">
      <x-button color="gray" text="Ajukan" type="submit" />
    </div>
    <a href="/kegiatan" class="button-container w-1/4">
      <x-button color="light" text="Batal" />
    </a>
  </div>
</form>

<script>
const baseUrl = `${window.location.protocol}//${window.location.host}`;
const fileInput = document.getElementById('dropzone-file');
const previewContainer = document.getElementById('image-preview');
const previewImg = document.getElementById('preview-img');
const url = window.location.href;
const idPenugasan = url.split("/").pop();
const userData = localStorage.getItem('user');
const user = userData ? JSON.parse(userData) : null;
const token = user ? user.token : null;
let imagePreview;
console.log(idPenugasan);
$.ajax({
  url: `/api/penugasan/${idPenugasan}`,
  method: 'GET',
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
    'Authorization': `Bearer ${token}`
  },
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
    Swal.close();
    console.log(dokumen_lapangan);
    imagePreview = !dokumen_lapangan ? '' : `${baseUrl}/${dokumen_lapangan.replace("public/", "")}`;
    console.log(imagePreview);
    if (imagePreview) {
      previewImg.src = imagePreview // Set image source to the selected file
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
  },
  error: function(xhr, status, error) {
    console.error('Error:', error);
  }
});



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
$('#form-kegiatan').submit(function(event) {
  event.preventDefault();

  const form = $('#form-kegiatan')[0]; // Ambil elemen form
  const formData = new FormData(form); // Buat FormData dari form

  // Buat array untuk item
  let index = 0;
  $('.checkbox-item').each(function() {
    if ($(this).is(':checked')) {
      formData.append(`item[${index}]`, $(this).val());
      index++;
    }
  });

  // Debugging untuk memastikan format data benar
  for (let pair of formData.entries()) {
    console.log(pair[0], pair[1]);
  }

  // Kirim data menggunakan AJAX
  $.ajax({
    url: '/api/penugasan/' + idPenugasan + '?_method=PATCH',
    type: 'POST',
    data: formData,
    processData: false,
    contentType: false,
    success: function(response) {
      Swal.fire({
        icon: response.status ? 'success' : 'error',
        title: response.status ? 'Berhasil' : 'Gagal',
        text: response.message,
      }).then(() => {
        window.location.href = '/kegiatan'
      });
    },
    error: function(xhr) {
      Swal.fire({
        icon: 'error',
        title: 'Kesalahan',
        text: 'Terjadi kesalahan saat mengunggah data.',
      });
    }
  });
});
</script>

@endsection