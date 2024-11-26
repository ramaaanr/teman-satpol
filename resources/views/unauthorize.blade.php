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

    <div class=" hero-content flex flex-col items-center">
      <img width="450px" src="/logo.png" alt="">
      <p class="text-white mt-4">Akun anda tidak diberikan akses untuk halaman ini!!!</p>
      <div id="backButton" class="flex items-center hover:cursor-pointer text-white hover:text-yellow-200">
        <span class='mr-1 !text-sm material-symbols-outlined'>
          arrow_back
        </span>
        <p class="text-xs">Kembali</p>
      </div>
    </div>

  </div>
  <footer class=" w-full justify-center space-x-2 flex h-fit items-center">
    <img src="/logo_kemendagri.svg" width="20px" alt="">
    <p class="text-sm text-white">©️ 2024 - SATPOL PP KOTA BANJARBARU</p>
    <img src="/logo_satpolpp.png" width="20px" alt="">
  </footer>
  <script>
  $('#backButton').on('click', () => {
    window.history.back();
  })
  $(document).ready(function() {
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