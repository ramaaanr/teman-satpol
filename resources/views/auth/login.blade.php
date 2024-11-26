<!-- resources/views/home.blade.php -->
@extends('layouts.guest-app')

@section('title', 'Selamat Datang Teman Satpol')

@section('content')

<div class="relative flex flex-col justify-between items-center px-6 lg:px-8 py-5 min-h-screen">

  <!-- Background gradient -->
  <div class="absolute inset-0  bg-gradient-to-b from-[#449BEA] to-[#051F37] -z-10"></div>

  <!-- Image as second background layer -->
  <div class="absolute inset-0 bg-cover bg-center bg-no-repeat -z-5"
    style="background-image: url('/hero-login.jpg'); opacity: 0.1;"></div>

  <!-- Content div -->
  <div class="main-content mx-auto h-[600px] items-center relative z-30 flex space-x-16 ">
    <form
      class="login form-content space-y-8 px-8 py-12 rounded-xl bg-zinc-900 bg-opacity-20 drop-shadow-md backdrop-filter backdrop-blur-sm ">
      <p class="text-white text-lg font-semibold">Silahkan Masuk Menggunakan Akun Kepegawaian</p>
      <div class="relative">
        <input type="text" id="nip" name="NIP"
          class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-sky-600 focus:outline-none focus:ring-0 focus:border-sky-600 peer"
          placeholder=" " value="" />
        <label for="nip"
          class="absolute text-sm text-white dark:text-gray-400 duration-300 transform -translate-y-2 scale-75 top-2 z-10 origin-[0]  dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-2 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
          NIP</label>
        <p id="nip-error" class="text-sm text-red-500 mt-2 hidden">NIP hanya boleh berisi angka dan titik.</p>
      </div>

      <div class="relative">
        <input type="password" id="password" name="password"
          class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-sky-600 focus:outline-none focus:ring-0 focus:border-sky-600 peer"
          placeholder=" " value="" />
        <label for="password"
          class="absolute text-sm text-white dark:text-gray-400 duration-300 transform -translate-y-2 scale-75 top-2 z-10 origin-[0]  dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-2 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
          password</label>
      </div>
      <button id="login-button" type="submit"
        class="text-gray-900 w-full bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Masuk</button>
      <button id="loading-button" disabled type="button"
        class="text-gray-900 hidden w-full bg-white hover:bg-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800  items-center justify-center">
        <svg aria-hidden="true" role="status" class="inline w-4 h-4 me-3 text-white animate-spin" viewBox="0 0 100 101"
          fill="none" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
            fill="#C3C5C7FF" />
          <path
            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
            fill="#E5E7EB"" />
                    </svg>
                    Loading...
                </button>
            </form>
            <div class=" hero-content flex flex-col items-center">
            <img width="450px" src="/logo.png" alt="">
            <p class="text-white mt-4">Aplikasi pengelolaan data kepegawian pada Satpol PP Kota Banjarbaru</p>
  </div>

</div>
<footer class=" w-full justify-center space-x-2 flex h-fit items-center">
  <img src="/logo_kemendagri.svg" width="20px" alt="">
  <p class="text-sm text-white">©️ 2024 - SATPOL PP KOTA BANJARBARU</p>
  <img src="/logo_satpolpp.png" width="20px" alt="">
</footer>
<script>
$(document).ready(function() {
  $('#nip').on('input', function() {
    const nipValue = $(this).val();
    const nipError = $('#nip-error');

    // Cek apakah input hanya berisi angka dan titik
    if (/^[0-9.]*$/.test(nipValue)) {
      nipError.addClass('hidden'); // Sembunyikan pesan error
      $(this).removeClass('border-red-500');
      $(this).addClass('border-gray-300');
    } else {
      nipError.removeClass('hidden'); // Tampilkan pesan error
      $(this).removeClass('border-gray-300');
      $(this).addClass('border-red-500');
    }
  });
  $('.login').on('submit', function(e) {
    $('#login-button').addClass("hidden")
    $('#login-button').removeClass("inline-flex")
    $('#loading-button').removeClass("hidden")
    $('#login-button').addClass("inline-flex")
    e.preventDefault(); // Menghentikan submit tradisional

    // Ambil nilai dari input
    const nip = $('#nip').val();
    const password = $('#password').val();

    // Lakukan AJAX menggunakan jQuery
    $.ajax({
      url: '/api/users/login',
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json' // Tambahkan header ini
      },
      data: JSON.stringify({
        NIP: nip,
        password: password
      }),
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
        status,
        message,
        data
      }) {
        if (status) {
          // Jika berhasil
          Swal.fire({
            icon: 'success',
            title: 'Login Berhasil',
            text: message,
            confirmButtonText: 'OK'
          }).then(() => {
            localStorage.setItem('user', JSON.stringify(data));
            window.location.href = '/dashboard';
          });
        } else {
          // Jika gagal
          Swal.fire({
            icon: 'error',
            title: 'Login Gagal',
            text: message,
            confirmButtonText: 'Coba Lagi'
          });
        }
      },
      error: function(error) {
        // Jika ada error dalam proses request
        console.error('Error:', error);
        Swal.fire({
          icon: 'error',
          title: 'Terjadi Kesalahan',
          text: 'Silakan coba lagi nanti.',
          confirmButtonText: 'OK'
        });
      }
    });
    $('#login-button').removeClass("hidden")
    $('#login-button').addClass("inline-flex")
    $('#loading-button').addClass("hidden")
    $('#login-button').removeClass("inline-flex")
  });
});
</script>
@endsection