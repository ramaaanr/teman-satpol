<!-- resources/views/home.blade.php -->
@extends('layouts.user-app')

@section('title', 'Halaman Utama')

@section('content')

<div class="w-full min-h-[550px]  text-zinc-700 rounded-md p-6 flex flex-col items-start bg-white">
  <div class="flex w-full  space-x-3">
    <div
      class="flex flex-col w-full items-start justify-center max-w-sm p-4 bg-zinc-700 text-white text-2xl font-bold border border-gray-200 rounded-lg shadow hover:-translate-x-1 hover:shadow-lg hover:border-gray-300 transition-all ease-in-out">
      <div class="flex items-center space-x-1">
        <span class="material-symbols-outlined text-white ">
          person_celebrate
        </span>
        <p id="greetings"></p>
      </div>
      <p class="text-gray-500 dark:text-gray-400 text-sm"> <a href="/kegiatan"
          class="inline-flex items-center font-medium text-yellow-200 dark:text-blue-500 hover:underline">
          Isi Kegiatan Anda
          <svg class="w-4 h-4 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M1 5h12m0 0L9 1m4 4L9 9" />
          </svg>
        </a></p>
    </div>

    <div
      class="flex w-full min-h-[125px] items-center max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow hover:-translate-x-1 hover:shadow-lg hover:border-gray-300 transition-all ease-in-out">
      <div class="flex p-2 bg-zinc-700 rounded-full w-fit h-fit mr-2">
        <span class="material-symbols-outlined text-white " style="font-size: 36px;">
          person
        </span>
      </div>
      <div class="">
        <p class="font-normal text-xs dark:text-gray-400 text-zinc-400">Nama</p>
        <h5 id="nama" class="mb-2 text-md font-bold tracking-tight leading-none text-zinc-700 dark:text-white">
        </h5>
      </div>
    </div>


    <div
      class="flex w-full min-h-[125px] items-center max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow hover:-translate-x-1 hover:shadow-lg hover:border-gray-300 transition-all ease-in-out">
      <div class="flex p-2 bg-zinc-700 rounded-full w-fit h-fit mr-2">
        <span class="material-symbols-outlined text-white " style="font-size: 36px;">
          badge
        </span>
      </div>
      <div class="">
        <p class="font-normal text-xs dark:text-gray-400 text-zinc-400">Jabatan</p>
        <h5 id="jabatan" class="mb-2 text-md font-bold tracking-tight leading-none text-zinc-700 dark:text-white">
        </h5>
      </div>
    </div>


    <div
      class="flex w-full min-h-[125px] items-center max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow hover:-translate-x-1 hover:shadow-lg hover:border-gray-300 transition-all ease-in-out">
      <div class="flex p-2 bg-zinc-700 rounded-full w-fit h-fit mr-2">
        <span class="material-symbols-outlined text-white " style="font-size: 36px;">
          key
        </span>
      </div>
      <div class="">
        <p class="font-normal text-xs dark:text-gray-400 text-zinc-400">Role</p>
        <h5 id="role" class="mb-2 text-md font-bold tracking-tight leading-none text-zinc-700 dark:text-white">
        </h5>
      </div>
    </div>
  </div>

  <div class="flex w-full mt-4  space-x-3">

    <div
      class="w-full h-full    p-4 bg-white border border-gray-200 rounded-lg shadow hover:-translate-x-1 hover:shadow-lg hover:border-gray-300 transition-all ease-in-out">
      <div class="font-normal flex dark:text-gray-400 text-white bg-zinc-700 rounded-md w-fit py-2 px-4 mb-4">
        <span class="material-symbols-outlined text-white mr-2">
          event
        </span>
        <p>
          Data Item
          Perjam
        </p>
      </div>
      <div class="table-container  w-full px-8">
        <table id="durasiTable">
          <thead>
            <tr>
              <th>Deskripsi</th>
              <th>Total Durasi (jam)</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
    <div class="flex flex-col space-y-2">
      <div
        class="w-full h-full    p-4 bg-white border border-gray-200 rounded-lg shadow hover:-translate-x-1 hover:shadow-lg hover:border-gray-300 transition-all ease-in-out">
        <div class="font-normal flex dark:text-gray-400 text-white bg-zinc-700 rounded-md w-fit py-2 px-4 mb-4">
          <span class="material-symbols-outlined text-white mr-2">
            gavel
          </span>
          <p>
            Jumlah Kegiatan
          </p>
        </div>
        <div class="jumlah-kegiatan-container grid grid-cols-2 space-y-2  w-full ">
          <div class="flex items-center">
            <p class="w-20">Ditugaskan</p>
            <p class="ml-2 rounded-md py-0.5 px-2 text-white bg-yellow-200" id="ditugaskan"></p>
          </div>
          <div class="flex items-center">
            <p class="w-20">Bertugas</p>
            <p class="ml-2 rounded-md py-0.5 px-2 text-white bg-blue-200" id="bertugas"></p>
          </div>
          <div class="flex items-center">
            <p class="w-20">Disetujui</p>
            <p class="ml-2 rounded-md py-0.5 px-2 text-white bg-green-200" id="disetujui"></p>
          </div>
          <div class="flex items-center">
            <p class="w-20">Ditolak</p>
            <p class="ml-2 rounded-md py-0.5 px-2 text-white bg-red-200" id="ditolak"></p>
          </div>
        </div>
      </div>
      <div
        class="w-full h-full  p-4 bg-white border border-gray-200 rounded-lg shadow hover:-translate-x-1 hover:shadow-lg hover:border-gray-300 transition-all ease-in-out">
        <div class="font-normal flex dark:text-gray-400 text-white bg-zinc-700 rounded-md w-fit py-2 px-4 mb-4">
          <span class="material-symbols-outlined text-white mr-2">
            pie_chart
          </span>
          <p>
            Visualisasi Item
            Perjam
          </p>
        </div>
        <div class="chart-container  w-full px-8">
          <canvas class="" id="myPieChart"></canvas>
        </div>
      </div>
    </div>

  </div>

</div>

<script type="module">
$(document).ready(function() {
  const userData = localStorage.getItem('user');

  const user = userData ? JSON.parse(userData) : null;
  const token = user ? user.token : null;
  const id = user ? user.id : null;
  $.ajax({
    url: `/api/dashboard-staff/${id}}`,
    method: "GET",
    headers: {
      "Authorization": `Bearer ${token}`,
      "Content-Type": "application/json",
    },
    success: function({
      data: {
        jabatan,
        nama,
        penugasan: {
          ditugaskan,
          bertugas,
          ditolak,
          disetujui,
        },
        role,
        durasi_item
      }
    }) {

      const getGreeting = () => {
        const now = new Date();
        const hour = now.getHours(); // Mendapatkan jam saat ini

        if (hour >= 5 && hour < 12) {
          return "Selamat Pagi!";
        } else if (hour >= 12 && hour < 15) {
          return "Selamat Siang!";
        } else if (hour >= 15 && hour < 18) {
          return "Selamat Sore!";
        } else {
          return "Selamat Malam!";
        }
      };

      // Menentukan sapaan berdasarkan jam sekarang
      const greetings = getGreeting();
      $('#greetings').text(greetings);
      $('#nama').text(nama);
      $('#jabatan').text(jabatan);
      $('#role').text(role);
      $('#ditugaskan').text(ditugaskan);
      $('#bertugas').text(bertugas);
      $('#disetujui').text(disetujui);
      $('#ditolak').text(ditolak);

      $('#durasiTable').DataTable({
        data: durasi_item,
        columns: [{
            data: 'deskripsi',
            title: 'Deskripsi'
          },
          {
            data: 'total_durasi',
            title: 'Total Durasi (jam)'
          }
        ],
        paging: true,
        searching: true,
        ordering: true,
        responsive: true,
        language: {
          search: "Cari:",
          lengthMenu: "Tampilkan _MENU_ data per halaman",
          info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
          paginate: {
            first: "Pertama",
            last: "Terakhir",
            next: "Berikutnya",
            previous: "Sebelumnya"
          }
        }
      });

      const labels = durasi_item.map(item => item.deskripsi);
      const data = durasi_item.map(item => item.total_durasi);
      const canvas = document.getElementById("myPieChart");
      const ctx = canvas.getContext("2d");
      // Fungsi untuk membuat warna dinamis
      const generateColors = (count) => {
        const colors = [];
        for (let i = 0; i < count; i++) {
          const r = Math.floor(Math.random() * 256);
          const g = Math.floor(Math.random() * 256);
          const b = Math.floor(Math.random() * 256);
          colors.push(`rgba(${r}, ${g}, ${b}, 0.7)`);
        }
        return colors;
      };

      const backgroundColors = generateColors(data.length);
      const borderColors = backgroundColors.map(color => color.replace('0.7', '1'));

      // Konfigurasi Chart.js Pie Chart
      const chart = new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: labels,
          datasets: [{
            label: 'Durasi Per Item (jam)',
            data: data,
            backgroundColor: backgroundColors,
            borderColor: borderColors,
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: {
              position: 'bottom',
            },
            tooltip: {
              enabled: true,
            }
          }
        }
      });
    },
  });
});
</script>

@endsection