<!-- resources/views/home.blade.php -->
@extends('layouts.user-app')

@section('title', 'Laporan Bidang')

@section('content')

<div class="w-full min-h-[550px] bg-white text-zinc-700 rounded-md p-6 flex items-start space-x-4">
  <div
    class="p-4 w-2/3 bg-white border border-gray-200 rounded-lg shadow hover:-translate-x-1 hover:shadow-lg hover:border-gray-300 transition-all ease-in-out">
    <div class="font-normal flex dark:text-gray-400 text-white bg-zinc-700 rounded-md w-fit py-2 px-4 mb-4">
      <span class="material-symbols-outlined text-white mr-2">
        event
      </span>
      <p>
        Data Kepegawaian berdasarkan pengguna perjam
      </p>
    </div>
    <table id="totalDurasiTable" class="table-auto w-full text-left text-sm">
      <thead>
        <tr class="bg-gray-100 text-gray-700">
          <th class="px-4 py-2 w-3/4">Nama</th>
          <th class="px-4 py-2 w-1/4">Total Durasi</th>
        </tr>
      </thead>
      <tbody>
        <!-- Data akan dimuat melalui AJAX -->
      </tbody>
    </table>
  </div>

  <div class="flex flex-col w-1/3">
    <div
      class="flex items-center w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:-translate-x-1 hover:shadow-lg hover:border-gray-300 transition-all ease-in-out">
      <div class="flex p-2 bg-zinc-700 rounded-full w-fit h-fit mr-2">
        <span class="material-symbols-outlined text-white " style="font-size: 36px;">
          gavel
        </span>
      </div>
      <div class="">
        <p class="font-normal dark:text-gray-400 text-zinc-400">Deskripsi</p>
        <h5 id="deskripsi" class="mb-2 text-5xl font-bold tracking-tight text-zinc-700 dark:text-white"></h5>
        <p class="font-normal text-xs dark:text-gray-400 text-zinc-400 ml-2">Item Penugasan</p>
      </div>
    </div>

    <div class="w-full mt-2 p-4 bg-white border border-gray-200 rounded-lg shadow">
      <div class="font-normal flex dark:text-gray-400 text-white bg-zinc-700 rounded-md w-fit py-2 px-4 mb-4">
        <span class="material-symbols-outlined text-white mr-2">
          pie_chart
        </span>
        <p>
          Statistik Durasi Pengguna
        </p>
      </div>
      <canvas id="durasiChart" width="400" height="200"></canvas>
    </div>
  </div>


</div>
<script type="module">
$(document).ready(function() {
  const url = window.location.href;
  const id = url.split("/").pop();
  const userData = localStorage.getItem('user');

  const user = userData ? JSON.parse(userData) : null;
  const token = user ? user.token : null;

  // Fungsi untuk mengambil deskripsi
  const fetchDescription = () => {
    $.ajax({
      url: `/samples/laporan_bidang.json?id_item=${id}`, // Endpoint untuk mendapatkan deskripsi
      method: 'GET',
      headers: {
        "Authorization": `Bearer ${token}`,
        "Content-Type": "application/json",
      },
      success: ({
        data: {
          deskripsi,
          total_durasi_pengguna,
        }
      }) => {
        // Memasukkan deskripsi ke dalam elemen dengan id "deskripsi"
        $('#deskripsi').text(deskripsi);

        const table = $('#totalDurasiTable').DataTable({
          processing: true,
          serverSide: false,
          data: total_durasi_pengguna,
          columns: [{
              data: 'nama',
              title: 'Nama',
              className: 'px-4 py-2 w-3/4'
            },
            {
              data: 'total_durasi',
              title: 'Total Durasi (menit)',
              className: 'px-4 py-2 w-1/4',
              render: function(data) {
                return `${data} Jam`; // Format durasi
              }
            }
          ],
        });
        const sortedData = total_durasi_pengguna
          .sort((a, b) => b.total_durasi - a.total_durasi); // Urutkan data berdasarkan total_durasi
        const top10 = sortedData.slice(0, 10); // Ambil top 10
        const otherTotal = sortedData.slice(10)
          .reduce((sum, item) => sum + item.total_durasi, 0); // Jumlahkan sisanya

        const labels = top10.map(item => item.nama).concat('Lainnya');
        const data = top10.map(item => item.total_durasi).concat(otherTotal);

        // Inisialisasi Chart
        const ctx = document.getElementById('durasiChart').getContext('2d');
        new Chart(ctx, {
          type: 'pie', // Ubah ke pie chart
          data: {
            labels: labels,
            datasets: [{
              label: 'Total Durasi (menit)',
              data: data,
              backgroundColor: [
                'rgba(0, 0, 128, 0.8)', // Top 1 - Biru tua
                'rgba(32, 32, 144, 0.8)',
                'rgba(64, 64, 160, 0.8)',
                'rgba(96, 96, 176, 0.8)',
                'rgba(128, 128, 192, 0.8)',
                'rgba(144, 144, 192, 0.8)',
                'rgba(160, 160, 192, 0.8)',
                'rgba(176, 176, 208, 0.8)',
                'rgba(192, 192, 224, 0.8)',
                'rgba(208, 208, 240, 0.8)', // Top 10 - Paling abu-abu biru
                'rgba(255, 99, 132, 0.5)'
              ],
              borderColor: [
                'rgba(0, 0, 128, 1)',
                'rgba(32, 32, 144, 1)',
                'rgba(64, 64, 160, 1)',
                'rgba(96, 96, 176, 1)',
                'rgba(128, 128, 192, 1)',
                'rgba(144, 144, 192, 1)',
                'rgba(160, 160, 192, 1)',
                'rgba(176, 176, 208, 1)',
                'rgba(192, 192, 224, 1)',
                'rgba(208, 208, 240, 1)',
                'rgba(255, 99, 132, 1)'
              ],
              borderWidth: 1
            }]
          },
          options: {
            responsive: true,
            plugins: {
              legend: {
                position: 'top', // Menampilkan legend di atas chart
              },
              tooltip: {
                callbacks: {
                  label: function(context) {
                    return `${context.label}: ${context.raw} Jam`;
                  }
                }
              }
            }
          }
        });
      },
      error: (xhr, status, error) => {
        console.error("Gagal mengambil deskripsi:", error);
        $('#deskripsi').text('Gagal memuat deskripsi.');
      }
    });
  };

  // Panggil fungsi fetchDescription
  fetchDescription();
  // Inisialisasi DataTable

});
</script>

@endsection