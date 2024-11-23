<!-- resources/views/home.blade.php -->
@extends('layouts.user-app')

@section('title', 'Laporan Kepegawaian')

@section('content')

<div class="w-full min-h-[550px]  text-zinc-700 rounded-md p-6 flex flex-col items-start bg-white">
  <div class="flex w-full  space-x-3">


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
      class="w-full h-fit    p-4 bg-white border border-gray-200 rounded-lg shadow hover:-translate-x-1 hover:shadow-lg hover:border-gray-300 transition-all ease-in-out">
      <div class="flex space-x-2">
        <div class="font-normal flex dark:text-gray-400 text-white bg-zinc-700 rounded-md w-fit py-2 px-4 mb-4">
          <span class="material-symbols-outlined text-white mr-2">
            event
          </span>
          <p>
            Data Item
            Perjam
          </p>
        </div>
        <button id="print-button"
          class="text-white w-[170px]  bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-zinc-300 font-medium rounded-lg text-sm px-2 h-fit py-2 text-center inline-flex items-center dark:bg-zinc-600 dark:hover:bg-zinc-700 dark:focus:ring-zinc-800"
          type="button">
          <span class='material-symbols-outlined text-zinc-700 mr-2'>
            print
          </span>
          <span class="text-zinc-700 font-medium">Cetak Data </span>
        </button>
      </div>
      <div class="table-container  w-full px-8">
        <table id="durasiTable">
          <thead>
            <tr>
              <th>Deskripsi</th>
              <th>Volume Kegiatan</th>
              <th>Total Durasi (jam)</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
    <div class="space-y-4 w-full">
      <div class="w-full flex flex-col space-y-2">
        <div
          class="w-full h-fit  p-4 bg-white border border-gray-200 rounded-lg shadow hover:-translate-x-1 hover:shadow-lg hover:border-gray-300 transition-all ease-in-out">
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
        <div
          class="w-full h-fit    p-4 bg-white border border-gray-200 rounded-lg shadow hover:-translate-x-1 hover:shadow-lg hover:border-gray-300 transition-all ease-in-out">
          <div class="font-normal flex dark:text-gray-400 text-white bg-zinc-700 rounded-md w-fit py-2 px-4 mb-4">
            <span class="material-symbols-outlined text-white mr-2">
              gavel
            </span>
            <p>
              Riwayat Giat
            </p>
          </div>
          <div class="table-container  w-full px-8">
            <table id="riwayatTable">
              <thead>
                <tr>
                  <th>Kegiatan</th>
                  <th>Tanggal</th>
                  <th>Durasi</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>

      </div>
    </div>


  </div>

</div>
<script src="https://cdn.sheetjs.com/xlsx-0.20.3/package/dist/xlsx.full.min.js"></script>

<script type="module">
$(document).ready(function() {
  document.getElementById("print-button").addEventListener('click', function() {
    var wb = XLSX.utils.table_to_book(document.getElementById("durasiTable"));
    XLSX.writeFile(wb, "DurasiPerItem.xlsx");
  });
  const userData = localStorage.getItem('user');

  const user = userData ? JSON.parse(userData) : null;
  const token = user ? user.token : null;
  const url = window.location.href;

  const id = url.split("/").pop();

  $.ajax({
    url: `/api/laporan_bidang?id_user=${id}`,
    method: "GET",
    headers: {
      "Authorization": `Bearer ${token}`,
      "Content-Type": "application/json",
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
        jabatan,
        nama,
        riwayat_giat,
        role,
        data_item
      }
    }) {
      Swal.close();
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

      $('#durasiTable').DataTable({
        data: data_item,
        columns: [{
            data: 'deskripsi',
            title: 'Deskripsi'
          },
          {
            data: 'volume',
            title: 'Volume Kegiatan'
          },
          {
            data: 'total_durasi',
            title: 'Total Durasi (jam)'
          }
        ],
        pageLength: 25,
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
      $('#riwayatTable').DataTable({
        data: riwayat_giat,
        columns: [{
            data: 'kegiatan',
            title: 'Kegiatan'
          },
          {
            data: 'tanggal',
            title: 'Tanggal'
          },
          {
            data: 'durasi',
            title: 'Durasi (/jam)'
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

      const labels = data_item.map(item => item.deskripsi);
      const data = data_item.map(item => item.total_durasi);
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
              position: "bottom", // Letakkan legend di sebelah kiri
              labels: {
                font: {
                  size: 10, // Ukuran font legend
                },
                boxWidth: 10, // Lebar kotak warna legend
                boxHeight: 10, // Tinggi kotak warna legend
                padding: 5, // Jarak antar label di legend
              },
            },
            tooltip: {
              enabled: true, // Tooltip tetap aktif
            },
          },

        }
      });
    },
  });
});
</script>

@endsection