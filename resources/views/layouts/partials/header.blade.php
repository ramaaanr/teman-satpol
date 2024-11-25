<script>
document.addEventListener("DOMContentLoaded", function() {
  const userData = localStorage.getItem('user');

  // Pastikan userData ada dan di-parse menjadi objek
  const user = userData ? JSON.parse(userData) : null;
  const token = user ? user.token : null;
  $('#user-nama').text(user.nama);
  $('#user-jabatan').text(user.role);
  const navLinks = document.querySelectorAll('nav a');
  const currentPath = window.location.pathname;
  const pathParts = currentPath.split('/');
  if (pathParts[2] !== undefined) {
    $('#backButton').on('click', () => {
      window.history.back();
    })
  } else {
    $('#backButton').addClass('hidden')
  }
  navLinks.forEach(link => {
    // Remove any existing active class
    link.classList.remove('text-gray-100', 'bg-gray-700', 'bg-opacity-25');
    // Get the current URL path
    // Check if the link's href matches the current path
    if (link.getAttribute('href').split('/').pop() === pathParts[1]) {
      link.classList.add('text-gray-100', 'bg-gray-900', 'font-bold', 'bg-opacity-25');
    } else {
      link.classList.add('font-semibold', 'hover:bg-gray-700', 'hover:bg-opacity-25',
        'hover:text-gray-100');
    }
  });

  $('#keluar-button').on('click', () => {
    localStorage.clear();
    $.ajax({
      url: '/api/users/logout',
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'Authorization': `Bearer ${token}`
      },
      success: () => {
        window.location.reload();
      },
      error: () => {}
    })
  })
});
</script>


<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">
  <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false"
    class="fixed inset-0 z-20 transition-opacity bg-zinc opacity-50 lg:hidden"></div>
  <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
    class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-[#07243F] lg:translate-x-0 lg:static lg:inset-0">
    <div class="flex items-center justify-center mt-8">
      <div class="flex items-center justify-center w-full">
        <img width="180" src="/logo.png" alt="ramadan" />
      </div>
    </div>
    <hr class="border border-gray-600 mt-6 mx-4">
    <nav class="mt-6">
      <a class="flex items-center px-6 py-2 mt-4 text-lime-50 bg-gray-700 bg-opacity-25" href="/dashboard">
        <span class="material-symbols-outlined">
          home
        </span>
        <span class="mx-3">Dashboard</span>
      </a>
      @if ($role === 'giat-admin')
      <a class="flex items-center px-6 py-2 mt-4 text-lime-50 font-semibold hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
        href="/data-giat">
        <span class="material-symbols-outlined">
          event
        </span>
        <span class="mx-3">Data Giat</span>
      </a>

      <a class="flex items-center px-6 py-2 mt-4 text-lime-50 font-semibold hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
        href="/tambah-giat">
        <span class="material-symbols-outlined">
          add_circle
        </span>
        <span class="mx-3">Tambah Giat</span>
      </a>
      @elseif($role === 'super-admin')
      <a class="flex items-center px-6 py-2 mt-4 text-lime-50 font-semibold hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
        href="/laporan-bidang">
        <span class="material-symbols-outlined">
          assessment
        </span>
        <span class="mx-3">Laporan Bidang</span>
      </a>

      <a class="flex items-center px-6 py-2 mt-4 text-lime-50 font-semibold hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
        href="/laporan-kepegawaian">
        <span class="material-symbols-outlined">
          supervisor_account
        </span>
        <span class="mx-3">Laporan Kepegawaian</span>
      </a>
      @elseif($role === 'approval')
      <a class="flex items-center px-6 py-2 mt-4 text-lime-50 font-semibold hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
        href="/review-kegiatan">
        <span class="material-symbols-outlined">
          rate_review
        </span>
        <span class="mx-3">Review Kegiatan</span>
      </a>

      @elseif($role === 'staff')
      <a class="flex items-center px-6 py-2 mt-4 text-lime-50 font-semibold hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
        href="/e-learning">
        <span class="material-symbols-outlined">
          school
        </span>
        <span class="mx-3">E-Learning</span>
      </a>
      @endif


      <a class="flex items-center px-6 py-2 mt-4  text-lime-50 font-semibold hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
        href="https://kinerja.bkn.go.id/login" target="_blank">
        <img src="/kinerja.png" width="24px" alt="" srcset="">
        <span class="mx-3">E-Kinerja</span>
      </a><a
        class="flex items-center px-6 py-2 mt-4 text-lime-50 font-semibold hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
        href="/kegiatan">
        <span class="material-symbols-outlined">
          gavel
        </span>
        <span class="mx-3">Kegiatan</span>
      </a>

    </nav>


  </div>
  <div class="flex flex-col flex-1 overflow-hidden">
    <header class="flex items-center justify-between px-6 py-4 bg-[#083054] ">
      <div class="flex items-center">
        <button @click="sidebarOpen = true" class="text-lime-50 font-semibold focus:outline-none lg:hidden">
          <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round"></path>
          </svg>
        </button>
      </div>

      <div class="flex pl-4 w-full items-center text-white ">
        <div>
          <div id="backButton" class="flex items-center hover:cursor-pointer hover:text-yellow-200">
            <span class='mr-1 !text-sm material-symbols-outlined'>
              arrow_back
            </span>
            <p class="text-xs">Kembali</p>
          </div>
          <p class="title-page font-bold text-2xl  w-96">@yield('title', 'My Application')</p>
        </div>
        <div class="actions-header w-full flex justify-end">

          <div class="flex items-center gap-2 mr-4">
            <div class="relative w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
              <svg class="absolute w-12 h-12 text-gray-400 -left-1" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd">
                </path>
              </svg>
            </div>
            <div class="font-medium   dark:text-white">
              <div id="user-nama"></div>
              <div id="user-jabatan" class="text-sm text-gray-200 dark:text-gray-200"></div>
            </div>

          </div>

          <button id="keluar-button" type="button"
            class="focus:outline-none text-white bg-yellow-300 hover:bg-yellow-400 focus:ring-4 focus:ring-yellow-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-700">Keluar</button>
        </div>

      </div>
    </header>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">