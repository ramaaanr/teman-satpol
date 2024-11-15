<table id="pegawaiTable" class="w-full">
  <thead>
    <tr>
      <th>Nama</th>
      <th>NIP</th>
      <th>Jabatan</th>
      <th>Status</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>

<script>
$(document).ready(function() {
  // Initialize DataTable with AJAX request
  $('#pegawaiTable').DataTable({
    ajax: {
      url: '/samples/user-ditugaskan.json', // URL untuk file JSON
      dataSrc: '' // Menggunakan root array dari file JSON
    },
    columns: [{
        data: 'nama'
      },
      {
        data: 'nip'
      },
      {
        data: 'jabatan'
      },
      {
        data: 'status',
        render: function(data) {
          let badgeClass = '';
          switch (data) {
            case 'ditugaskan':
              badgeClass = 'bg-yellow-300 md';
              break;
            case 'bertugas':
              badgeClass = 'bg-blue-300 md';
              break;
            case 'disetujui':
              badgeClass = 'bg-green-300 md';
              break;
            case 'ditolak':
              badgeClass = 'bg-red-300 md';
              break;
          }
          return `<span class="px-2 text-white text-xs rounded-lg py-1 ${badgeClass}">${data}</span>`;
        }
      },
      {
        data: 'status',
        render: function(data, type, row) {
          let buttons = `<button class="bg-gray-700 text-white px-2 py-1 rounded mr-1">Detail</button>`;
          if (data === 'bertugas') {
            buttons += `
                                <button class="bg-green-500 text-white px-2 py-1 rounded mr-1">Disetujui</button>
                                <button class="bg-red-500 text-white px-2 py-1 rounded">Ditolak</button>
                            `;
          } else if (data === 'disetujui') {
            buttons += `<button class="bg-red-500 text-white px-2 py-1 rounded">Ditolak</button>`;
          } else if (data === 'ditolak') {
            buttons += `<button class="bg-green-500 text-white px-2 py-1 rounded">Disetujui</button>`;
          }
          return buttons;
        }
      }
    ]
  });
});
</script>