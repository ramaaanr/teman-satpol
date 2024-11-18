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