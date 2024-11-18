<!-- resources/views/home.blade.php -->
@extends('layouts.user-app')

@section('title', 'Review Kegiatan')

@section('content')
<div class="w-full text-zinc-700 bg-white rounded-lg shadow-md border border-gray-100 p-6  ">

  <div class="detail-1 flex">
    <div class="header-detail w-full">
      <p id="kegiatan" class="font-bold text-3xl"></p>
      <p id="detail" class=" text-md text-zinc-500"></p>
    </div>
    <div class="actions-detail flex items-center space-x-4">
      <p class="flex space-x-1">
        <span class="text-yellow-300 font-semibold">120</span>
        <span class="text-zinc-700 font-semibold">Ditugaskan</span>
      </p>
      <p class="flex space-x-1">
        <span class="text-blue-500 font-semibold">12</span>
        <span class="text-zinc-700 font-semibold">Mengajukan</span>
      </p>
      <p class="flex space-x-1">
        <span class="text-green-500 font-semibold">5</span>
        <span class="text-zinc-700 font-semibold">Diterima</span>
      </p>
      <p class="flex space-x-1">
        <span class="text-red-500 font-semibold">2</span>
        <span class="text-zinc-700 font-semibold">Ditolak</span>
      </p>

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
      <p class="text-sm text-gray-700" id="tanggal"></p>
    </div>
  </div>
  <hr class="border border-gray-300 my-4">
  <p class="text-sm text-zinc-400">Diperintahkan Kepada</p>
  <x-review-kegiatan-user-table />
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
    url: `/api/giat/${id}`,
    method: 'GET',
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      'Authorization': `Bearer ${token}`
    },
    success: function({
      Data: {
        kegiatan,
        detail_kegiatan,
        tempat,
        tanggal_mulai,
        tanggal_selesai,
        jumlah_petugas,
        kendaraan,
        penugasans,
      }
    }) {
      $('#kegiatan').text(kegiatan);
      $('#detail').text(detail_kegiatan);
      $('#tempat').text(tempat);
      $('#tanggal').text(`${tanggal_mulai} - ${tanggal_selesai}`);
      $('#petugas').text(jumlah_petugas);
      $('#kendaraan').text(kendaraan);

      $('#pegawaiTable').DataTable({
        data: penugasans,
        columns: [{
            data: 'user.nama'
          },
          {
            data: 'user.NIP'
          },
          {
            data: 'user.jabatan'
          },
          {
            data: 'status',
            render: function(data) {
              let badgeClass = '';
              switch (data) {
                case 'Ditugaskan':
                  badgeClass = 'bg-yellow-300 md';
                  break;
                case 'Bertugas':
                  badgeClass = 'bg-blue-300 md';
                  break;
                case 'Disetujui':
                  badgeClass = 'bg-green-300 md';
                  break;
                case 'Ditolak':
                  badgeClass = 'bg-red-300 md';
                  break;
              }
              return `<span class="px-2 text-white text-xs rounded-lg py-1 ${badgeClass}">${data}</span>`;
            }
          },
          {
            data: 'status',
            render: function(data, type, row) {
              let buttons = "";
              if (data !== 'Ditugaskan') {
                buttons +=
                  `<button id="detail-${row.id}" class="bg-gray-700 text-white px-2 py-1 rounded mr-1">Detail</button>`;
              }
              if (data === 'Bertugas') {
                buttons += `
                <button id="approve-${row.id}" class="bg-green-500 text-white px-2 py-1 rounded mr-1">Disetujui</button>
                <button id="reject-${row.id}" class="bg-red-500 text-white px-2 py-1 rounded">Ditolak</button>
            `;
              } else if (data === 'Disetujui') {
                buttons +=
                  `<button id="reject-${row.id}" class="bg-red-500 text-white px-2 py-1 rounded">Ditolak</button>`;
              } else if (data === 'Ditolak') {
                buttons +=
                  `<button id="approve-${row.id}" class="bg-green-500 text-white px-2 py-1 rounded">Disetujui</button>`;
              }
              return buttons;
            }
          }

        ]
      });
    },
    error: function(xhr, status, error) {
      console.error('Error:', error);
    }
  });

  $(document).on('click', '[id^="approve-"], [id^="reject-"], [id^="detail-"]', function() {
    // Ambil ID tombol
    const buttonId = $(this).attr('id');

    // Ekstrak id_penugasan dan tindakan dari ID tombol
    const [action, id_penugasan] = buttonId.split('-');

    // Debugging
    console.log('Action:', action, 'ID Penugasan:', id_penugasan);

    // Tentukan URL dan method berdasarkan action
    let url = `/api/review_kegiatan/${id_penugasan}`;
    let status = '';
    if (action === 'approve') {
      status = 'Disetujui';
    } else if (action === 'reject') {
      status = 'Ditolak';
    } else if (action === 'detail') {
      window.location.href = `/review-kegiatan/detail/${id}/${id_penugasan}`

      return;
    }

    // AJAX Request
    $.ajax({
      url: url,
      method: 'PATCH',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${token}`
      },
      data: JSON.stringify({
        status: status
      }),
      success: function(response) {
        window.location.reload();
      },
      error: function(xhr, status, error) {
        console.error('Error:', error);
      }
    });
  });

});
</script>
@endsection