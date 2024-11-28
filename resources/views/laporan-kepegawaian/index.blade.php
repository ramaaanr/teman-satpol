<!-- resources/views/home.blade.php -->
@extends('layouts.user-app')

@section('title', 'Laporan Kepegawaian')

@section('content')

<div class="w-full min-h-[550px] bg-white text-zinc-700 rounded-md p-6 flex flex-col items-start">
  <div class="flex items-center w-full ">
    <button id="btn-add"
      class="add-container bg-zinc-700 flex text-sm space-x-2 rounded-md px-2 py-1 h-fit text-white hover:green-700">
      <span class="material-symbols-outlined text-sm">
        add
      </span> <span>Tambah Pegawai</span>
    </button>
  </div>
  <div class="flex flex-col w-full">
    <div class="-my-2 w-full overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
      <div
        class="inline-block mt-4 min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
        <table id="usersTable" class="min-w-full p-4 divide-y divide-gray-200">
          <thead>
            <tr>
              <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Nama
              </th>
              <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                NIP
              </th>
              <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Jabatan
              </th>
              <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Role
              </th>
              <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Aksi </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <!-- Data will be populated here by DataTable -->
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>

@include("laporan-kepegawaian.add")
@include("laporan-kepegawaian.edit")

<script>
$(document).ready(function() {
  $('#usersTable').DataTable({
    ajax: {
      url: '/api/users', // URL to fetch data from
      dataSrc: 'data' // Indicate that data is a flat array
    },
    pageLength: 100,
    columns: [{
        data: 'nama'
      },
      {
        data: 'NIP'
      },
      {
        data: 'jabatan'
      },
      {
        data: 'role'
      },
      {
        data: null,
        render: function(data, type, row) {
          return row.role !== 'super-admin' ? `
            <div class="flex space-x-1">
              <a class="detail-btn bg-green-500 text-white px-2 py-1 rounded" href="/laporan-kepegawaian/${row.id}">
                <span class="material-symbols-outlined">info</span>
              </a>
              <button class="edit-btn bg-blue-500 text-white px-2 py-1 rounded" data-id="${row.id}"
data-NIP="${row.NIP}"
data-nama="${row.nama}"
data-jabatan="${row.jabatan}"
data-role="${row.role}">
                <span class="material-symbols-outlined">edit</span>
              </button>
              
            </div>` : `<a class="detail-btn bg-green-500 text-white px-2 py-1 flex items-center w-fit rounded" href="/laporan-kepegawaian/${row.id}">
                <span class="material-symbols-outlined">info</span>
              </a>`;
        }
      }
    ]
  });

  $('#usersTable tbody').on('click', '.delete-btn', function() {
    var id = $(this).data('id');
    Swal.fire({
      title: 'Yakin ingin menghapus MDT ini?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: '/api/users/' + id, // Include id in the URL
          type: 'DELETE',
          success: function(response) {
            if (response.success) {
              $('#usersTable').DataTable().ajax.reload(); // Reload DataTable data
              Swal.fire('Deleted!', 'Pegawai berhasil dihapus.', 'success');
            } else {
              Swal.fire('Error', 'Terjadi kesalahan saat menghapus Pegawai', 'error');
            }
          },
          error: function() {
            Swal.fire('Error', 'Gagal menghubungi server', 'error');
          }
        });
      }
    });
  });
});
</script>


@endsection