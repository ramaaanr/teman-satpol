<!-- resources/views/home.blade.php -->
@extends('layouts.user-app')

@section('title', 'Halaman Utama')

@section('content')

<div class="w-full min-h-[550px]  text-zinc-700 rounded-md p-6 flex flex-col items-start bg-white">
  <div class="flex w-full  space-x-2">

    <div id="greetings"
      class="flex  w-2/5 items-center max-w-sm p-6 bg-zinc-700 text-white text-2xl font-bold border border-gray-200 rounded-lg shadow hover:-translate-x-1 hover:shadow-lg hover:border-gray-300 transition-all ease-in-out">
      Selamat Pagi!
    </div>

    <div
      class="flex w-1/5 min-h-[125px] items-center max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:-translate-x-1 hover:shadow-lg hover:border-gray-300 transition-all ease-in-out">
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
      class="flex w-1/5 min-h-[125px] items-center max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:-translate-x-1 hover:shadow-lg hover:border-gray-300 transition-all ease-in-out">
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
      class="flex w-1/5 min-h-[125px] items-center max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:-translate-x-1 hover:shadow-lg hover:border-gray-300 transition-all ease-in-out">
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
  <!-- <div class=" w-full h-full space-x-6">
    <div class="w-full h-full flex space-y-5">
      <a href="#"
        class="flex items-center max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:-translate-x-1 hover:shadow-lg hover:border-gray-300 transition-all ease-in-out">
        <div class="flex p-2 bg-zinc-700 rounded-full w-fit h-fit mr-2">
          <span class="material-symbols-outlined text-white " style="font-size: 36px;">
            event_available
          </span>
        </div>
        <div class="">
          <p class="font-normal dark:text-gray-400 text-zinc-400">Giat</p>
          <h5 id="total-giat" class="mb-2 text-5xl font-bold tracking-tight text-zinc-700 dark:text-white"></h5>
          <p class="font-normal text-xs dark:text-gray-400 text-zinc-400 ml-2">/giat</p>

        </div>
      </a>

      <a href="#"
        class="flex items-center max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:-translate-x-1 hover:shadow-lg hover:border-gray-300 transition-all ease-in-out">
        <div class="flex p-2 bg-zinc-700 rounded-full w-fit h-fit mr-2">
          <span class="material-symbols-outlined text-white " style="font-size: 36px;">
            gavel
          </span>
        </div>
        <div class="">
          <p class="font-normal dark:text-gray-400 text-zinc-400">Penugasan</p>
          <h5 id="total-kegiatan" class="mb-2 text-5xl font-bold tracking-tight text-zinc-700 dark:text-white"></h5>
          <p class="font-normal text-xs dark:text-gray-400 text-zinc-400 ml-2">/penugasan</p>

        </div>
      </a>
    </div>
    <div
      class="w-full h-full    p-4 bg-white border border-gray-200 rounded-lg shadow hover:-translate-x-1 hover:shadow-lg hover:border-gray-300 transition-all ease-in-out">
      <div class="font-normal flex dark:text-gray-400 text-white bg-zinc-700 rounded-md w-fit py-2 px-4 mb-4">
        <span class="material-symbols-outlined text-white mr-2">
          pie_chart
        </span>
        <p>
          Visualisasi Item
          Perjam
        </p>
      </div>
      <div class="chart-container h-[390px] w-full px-8">
      </div>
    </div>
  </div> -->


  <!-- <div class="relative mt-4 overflow-x-auto  sm:rounded-lg w-full bg-white border border-gray-200 rounded-lg shadow  ">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th scope="col" class="px-6 py-3 w-3/4">
            Item
          </th>
          <th scope="col" class="px-6 py-3 w-1/4">
            Durasi/Jam
          </th>
        </tr>
      </thead>
      <tbody id="table-body-item">
      </tbody>
    </table>
  </div> -->
</div>

<script type="module">
$(document).ready(function() {
  const userData = localStorage.getItem('user');

  const user = userData ? JSON.parse(userData) : null;
  const token = user ? user.token : null;
  const id = user ? user.id : null;
  $.ajax({
    url: `/api/laporan_bidang?id_user=${id}}`,
    method: "GET",
    headers: {
      "Authorization": `Bearer ${token}`,
      "Content-Type": "application/json",
    },
    success: function(response) {
      console.log(response);
    },
  });
});
// $(document).ready(function() {

//   const monthNames = [
//     "Semuanya", "Januari", "Februari", "Maret", "April", "Mei", "Juni",
//     "Juli", "Agustus", "September", "Oktober", "November", "Desember"
//   ];

//   const url = window.location.href;
//   const id = url.split("/").pop();
//   const userData = localStorage.getItem('user');

//   const user = userData ? JSON.parse(userData) : null;
//   const token = user ? user.token : null;

//   let currentYear = new Date().getFullYear();
//   const startYear = 2020;

//   let currentMonth = 0;

//   const dropDownButton = document.getElementById("dropDownYearButton");
//   const dropDownMenuYear = document.getElementById("dropDownYear");

//   const dropDownMonthButton = document.getElementById("dropDownMonthButton");
//   const dropDownMenuMonth = document.getElementById("dropDownMonth");

//   // Set initial text in the button
//   $('#dropDownYearText').text(currentYear);
//   $('#dropDownMonthText').text(monthNames[currentMonth]);

//   const setData = () => {
//     $.ajax({
//       url: `/api/laporan_bidang?tahun=${currentYear}&bulan=${currentMonth}`,
//       method: "GET",
//       headers: {
//         "Authorization": `Bearer ${token}`,
//         "Content-Type": "application/json",
//       },
//       success: function({
//         data: {
//           total_giat,
//           total_users,
//           total_kegiatan,
//           statistik_item
//         }
//       }) {
//         $('#total-giat').text(total_giat);
//         $('#total-user').text(total_users);
//         $('#total-kegiatan').text(total_kegiatan);

//         // Buat array untuk total_durasi dan deskripsi
//         const totalDurasi = statistik_item.map((item) => item.total_durasi);
//         const deskripsi = statistik_item.map((item) => item.deskripsi);
//         const allZeros = totalDurasi.every(value => value === 0);
//         $('#table-body-item').html('')
//         statistik_item.forEach(({
//           id,
//           deskripsi,
//           total_durasi
//         }) => {

//           const tableRow = `
//             <tr class="hover:bg-gray-50 border-b dark:border-gray-700">
//           <td class="px-6 py-4 hover:underline">
//             <a href="laporan-bidang/${id}">${deskripsi}</a>
//           </td>
//           <td class="px-6 py-4">
//           ${Math.round(total_durasi)}
//           </td>
//         </tr>
//           `
//           $('#table-body-item').append(tableRow);
//         });

//         if (allZeros) {
//           // Hilangkan elemen chart
//           $('.chart-container').html(`
//       <img class="mx-auto" width="430px" src="/pie_chart.svg" alt="">
//           <div class="text-center mt-4 text-zinc-700 font-bold">
//             <p>Data tidak tersedia untuk ditampilkan.</p>
//           </div>
//         `);
//           // Tampilkan alert
//         } else {
//           // Kosongkan canvas sebelum membuat chart baru
//           $('.chart-container').html(`
//         <canvas class="" id="myPieChart"></canvas>
//         `);;
//           const canvas = document.getElementById("myPieChart");
//           const ctx = canvas.getContext("2d");


//           // Data untuk Pie Chart
//           const data = {
//             labels: deskripsi,
//             datasets: [{
//               label: "Item Kegiatan",
//               data: totalDurasi,
//               backgroundColor: [
//                 "rgba(128, 128, 128, 0.6)", // Abu-abu terang
//                 "rgba(169, 169, 169, 0.6)", // Abu-abu medium
//                 "rgba(192, 192, 192, 0.6)", // Abu-abu silver
//                 "rgba(211, 211, 211, 0.6)", // Abu-abu terang
//                 "rgba(112, 128, 144, 0.6)", // Slate gray
//                 "rgba(119, 136, 153, 0.6)", // Light slate gray
//                 "rgba(70, 130, 180, 0.6)", // Steel blue
//                 "rgba(95, 158, 160, 0.6)", // Cadet blue
//                 "rgba(100, 149, 237, 0.6)", // Cornflower blue
//                 "rgba(0, 191, 255, 0.6)", // Deep sky blue
//                 "rgba(30, 144, 255, 0.6)", // Dodger blue
//                 "rgba(65, 105, 225, 0.6)", // Royal blue
//                 "rgba(70, 130, 180, 0.6)", // Steel blue
//                 "rgba(240, 248, 255, 0.6)", // Alice blue
//                 "rgba(135, 206, 250, 0.6)", // Light sky blue
//                 "rgba(176, 196, 222, 0.6)", // Light steel blue
//                 "rgba(173, 216, 230, 0.6)", // Light blue
//                 "rgba(25, 25, 112, 0.6)", // Midnight blue
//               ],

//               borderColor: [
//                 "rgba(128, 128, 128, 1)", // Abu-abu terang
//                 "rgba(169, 169, 169, 1)", // Abu-abu medium
//                 "rgba(192, 192, 192, 1)", // Abu-abu silver
//                 "rgba(211, 211, 211, 1)", // Abu-abu terang
//                 "rgba(112, 128, 144, 1)", // Slate gray
//                 "rgba(119, 136, 153, 1)", // Light slate gray
//                 "rgba(70, 130, 180, 1)", // Steel blue
//                 "rgba(95, 158, 160, 1)", // Cadet blue
//                 "rgba(100, 149, 237, 1)", // Cornflower blue
//                 "rgba(0, 191, 255, 1)", // Deep sky blue
//                 "rgba(30, 144, 255, 1)", // Dodger blue
//                 "rgba(65, 105, 225, 1)", // Royal blue
//                 "rgba(70, 130, 180, 1)", // Steel blue
//                 "rgba(240, 248, 255, 1)", // Alice blue
//                 "rgba(135, 206, 250, 1)", // Light sky blue
//                 "rgba(176, 196, 222, 1)", // Light steel blue
//                 "rgba(173, 216, 230, 1)", // Light blue
//                 "rgba(25, 25, 112, 1)", // Midnight blue
//               ],

//               borderWidth: 1,
//             }, ],
//           };

//           // Konfigurasi Chart
//           const config = {
//             type: "doughnut", // Jenis chart
//             data: data,
//             options: {

//               maintainAspectRatio: false, // Izinkan chart merespons container
//               responsive: true,
//               plugins: {
//                 legend: {
//                   position: "right", // Letakkan legend di sebelah kiri
//                   labels: {
//                     font: {
//                       size: 10, // Ukuran font legend
//                     },
//                     boxWidth: 10, // Lebar kotak warna legend
//                     boxHeight: 10, // Tinggi kotak warna legend
//                     padding: 5, // Jarak antar label di legend
//                   },
//                 },
//                 tooltip: {
//                   enabled: true, // Tooltip tetap aktif
//                 },
//               },

//             },
//           };

//           // Render Chart
//           new Chart(ctx, config); // Pastikan menggunakan 'new'
//         }
//       },
//       error: function(xhr, status, error) {
//         console.error("Error retrieving data:", error);
//       }
//     });
//   }

//   for (let year = currentYear; year >= startYear; year--) {
//     const listItem = document.createElement("li");
//     const link = document.createElement("a");
//     link.href = "#";
//     link.className =
//       `block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white `;
//     link.textContent = year;

//     // Add event listener to update button text and perform AJAX
//     link.addEventListener("click", function(e) {
//       e.preventDefault();
//       $('#dropDownYearText').text(year);
//       console.log(year);
//       // Perform AJAX GET request
//       currentYear = year;
//       setData()
//     });

//     listItem.appendChild(link);
//     dropDownMenuYear.querySelector("ul").appendChild(listItem);
//   }
//   for (let month = 0; month <= 12; month++) {
//     const listItem = document.createElement("li");
//     const link = document.createElement("a");
//     link.href = "#";
//     link.className =
//       `block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white `;
//     link.textContent = monthNames[month];

//     // Add event listener to update button text and perform AJAX
//     link.addEventListener("click", function(e) {
//       e.preventDefault();
//       $('#dropDownMonthText').text(monthNames[month]);
//       console.log(month);
//       // Perform AJAX GET request
//       currentMonth = month;

//       setData()
//     });

//     listItem.appendChild(link);
//     dropDownMenuMonth.querySelector("ul").appendChild(listItem);
//   }
//   setData();
// });
</script>

@endsection