<script>
$(document).ready(function() {
  // Ambil data user dari localStorage
  const userData = localStorage.getItem('user');

  // Pastikan userData ada dan di-parse menjadi objek
  const user = userData ? JSON.parse(userData) : null;
  const token = user ? user.token : null;

  $.ajax({
    url: '/api/users',
    method: 'GET',
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      'Authorization': `Bearer ${token}`
    },
    success: function({
      data: users
    }) {
      users.forEach(user => {
        const tableRow =
          `<x-detail-giat-user-table-row id=${user.id} nama="${user.nama}" nip="${user.NIP}" jabatan="${user.jabatan}" />`;
        $('#table-body-giat-user').append(tableRow);
      });
    },
    error: function(xhr, status, error) {
      console.error('Error:', error);
    }
  });
});
</script>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
  <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
      <tr>

        <th scope="col" class="px-6 py-3">
          Nama
        </th>
        <th scope="col" class="px-6 py-3">
          NIP
        </th>
        <th scope="col" class="px-6 py-3">
          Jabatan
        </th>
      </tr>
    </thead>
    <tbody id="table-body-giat-user">

    </tbody>
  </table>
</div>