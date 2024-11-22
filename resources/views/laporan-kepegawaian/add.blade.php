<!-- Add Data Modal -->
<div id="addModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
  <div class="relative top-20 mx-auto p-5 border w-1/3 shadow-lg rounded-md bg-white">
    <h2 class="text-xl font-bold mb-4">Tambah Data Pegawai</h2>
    <form id="addForm" class="space-y-2">
      <x-input type="text" name="nama" value="" label="Nama Pegawai" />
      <x-input type="text" name="NIP" value="" label="Nomor Induk Pegawai (NIP)" />
      <label for="jabatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jabatan</label>
      <select id="jabatan" name="jabatan"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option value="KEPALA SATPOL PP">KEPALA SATPOL PP</option>
        <option value="SEKRETARIS">SEKRETARIS</option>
        <option value="POL PP MADYA">POL PP MADYA</option>
        <option value="KEPALA BIDANG PENEGAKAN PER UU DAERAH">KEPALA BIDANG PENEGAKAN PER UU DAERAH</option>
        <option value="KEPALA BIDANG SUMBER DAYA APARATUR">KEPALA BIDANG SUMBER DAYA APARATUR</option>
        <option value="KEPALA BIDANG KETERTIBAN UMUM DAN KETENTRAMAN MASYARAKAT">KEPALA BIDANG KETERTIBAN UMUM DAN
          KETENTRAMAN MASYARAKAT</option>
        <option value="KEPALA BIDANG PERLINDUNGAN MASYARAKAT">KEPALA BIDANG PERLINDUNGAN MASYARAKAT</option>
        <option value="KEPALA UPT PEMADAM KEBAKARAN">KEPALA UPT PEMADAM KEBAKARAN</option>
        <option value="KEPALA SUB BAGIAN KEUANGAN">KEPALA SUB BAGIAN KEUANGAN</option>
        <option value="KEPALA SEKSI TEKNIS FUNGSIONAL">KEPALA SEKSI TEKNIS FUNGSIONAL</option>
        <option value="KEPALA SEKSI PENYELIDIKAN DAN PENYIDIKAN">KEPALA SEKSI PENYELIDIKAN DAN PENYIDIKAN</option>
        <option value="KEPALA SEKSI PEMBINAAN PENGAWASAN DAN PENYULUHAN">KEPALA SEKSI PEMBINAAN, PENGAWASAN DAN
          PENYULUHAN</option>
        <option value="KEPALA SEKSI PELATIHAN DASAR">KEPALA SEKSI PELATIHAN DASAR</option>
        <option value="POL PP MUDA">POL PP MUDA</option>
        <option value="KEPALA SEKSI PERLINDUNGAN MASYARAKAT">KEPALA SEKSI PERLINDUNGAN MASYARAKAT</option>
        <option value="KEPALA SUB BAGIAN PERENCANAAN">KEPALA SUB BAGIAN PERENCANAAN</option>
        <option value="KEPALA SEKSI OPERASI DAN PENGENDALIAN">KEPALA SEKSI OPERASI DAN PENGENDALIAN</option>
        <option value="KEPALA SEKSI KERJASAMA">KEPALA SEKSI KERJASAMA</option>
        <option value="KEPALA SUB BAGIAN UMUM DAN KEPEGAWAIAN">KEPALA SUB BAGIAN UMUM DAN KEPEGAWAIAN</option>
        <option value="KEPALA SUB BAGIAN TATA USAHA UPT PEMADAM KEBAKARAN">KEPALA SUB BAGIAN TATA USAHA UPT PEMADAM
          KEBAKARAN</option>
        <option value="KEPALA SEKSI BINA POTENSI MASYARAKAT">KEPALA SEKSI BINA POTENSI MASYARAKAT</option>
        <option value="PETUGAS PENINDAKAN">PETUGAS PENINDAKAN</option>
        <option value="BENDAHARA">BENDAHARA</option>
        <option value="POL PP PERTAMA">POL PP PERTAMA</option>
        <option value="PENYUSUN RENCANA KEBUTUHAN RUMAH TANGGA DAN PERLENGKAPAN">PENYUSUN RENCANA KEBUTUHAN RUMAH TANGGA
          DAN PERLENGKAPAN</option>
        <option value="PENGENDALI TEKNIS KEAMANAN">PENGENDALI TEKNIS KEAMANAN</option>
        <option value="ANALIS PENGEMBANGAN SUMBER DAYA MANUSIA APARATUR">ANALIS PENGEMBANGAN SUMBER DAYA MANUSIA
          APARATUR</option>
        <option value="PENGADMINISTRASI UMUM">PENGADMINISTRASI UMUM</option>
        <option value="POLISI PAMONG PRAJA MAHIR">POLISI PAMONG PRAJA MAHIR</option>
        <option value="PENATA LAPORAN KEUANGAN">PENATA LAPORAN KEUANGAN</option>
        <option value="POL PP TERAMPIL">POL PP TERAMPIL</option>
        <option value="PENYUSUN KEBUTUHAN BARANG INVENTARIS">PENYUSUN KEBUTUHAN BARANG INVENTARIS</option>
        <option value="POL PP PELAKSANA">POL PP PELAKSANA</option>
        <option value="PRANATA KOMPUTER PELAKSANA">PRANATA KOMPUTER PELAKSANA</option>
        <option value="VERIFIKATOR KEUANGAN">VERIFIKATOR KEUANGAN</option>
        <option value="POLISI PAMONG PRAJA PEMULA">POLISI PAMONG PRAJA PEMULA</option>
        <option value="PRANATA TRANTIBUM">PRANATA TRANTIBUM</option>
        <option value="OPERATOR LAYANAN OPERASIONAL">OPERATOR LAYANAN OPERASIONAL</option>
        <option value="PENATA LAYANAN OPERASIONAL">PENATA LAYANAN OPERASIONAL</option>
        <option value="PENGADMINISTRASI PERKANTORAN">PENGADMINISTRASI PERKANTORAN</option>

      </select>
      <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
      <select id="role" name="role"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option value="giat-admin">Admin Giat</option>
        <option value="approval">Approval</option>
        <option value="staff">Staff</option>
      </select>
      <x-input type="password" name="password" value="" label="Password" />

      <div class="flex justify-end">
        <button type="button" id="addModalClose" class="bg-gray-500 text-white px-4 py-2 rounded-md">Tutup</button>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md ml-2">Tambah</button>
      </div>
    </form>
  </div>
</div>

<!-- Button to Open Modal -->
<!-- (Add a button to trigger the modal in your main HTML) -->

<script>
// Show Modal on Button Click
$('#btn-add').on('click', function() {
  $('#addModal').removeClass('hidden');
});

// Close Modal
$('#addModalClose').on('click', function() {
  $('#addModal').addClass('hidden');
});

// AJAX Form Submission
$('#addForm').on('submit', function(e) {
  e.preventDefault(); // Prevent default form submission

  $.ajax({
    url: '/api/users',
    method: 'POST',
    data: $(this).serialize(),
    success: function(response) {
      Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        showCloseButton: true,
        text: 'Data berhasil ditambahkan!'
      }).then(() => {
        $('#addModal').addClass('hidden'); // Close modal
        $('#addForm')[0].reset(); // Reset form fields
        // Refresh the data table (use your specific table refresh function here)
        location.reload(); // Refresh the page to show the updated data
      });
    },
    error: function() {
      Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: 'Terjadi kesalahan saat menambahkan data!'
      });
    }
  });
});
</script>