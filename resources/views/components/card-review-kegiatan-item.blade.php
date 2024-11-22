<div
  class="w-full text-zinc-700 bg-white rounded-lg shadow-md border border-gray-100 p-6 transition-all ease-in-out hover:-translate-x-1 hover:shadow-lg ">

  <div class="detail-1 flex">
    <div class="header-detail w-full">
      <p class="font-bold text-3xl">{{$kegiatan}}</p>
      <p class=" text-md text-zinc-500">{{$detailKegiatan}}</p>
    </div>
    <div class="actions-detail flex items-center space-x-4">
      <p class="flex space-x-1">
        <span class="text-yellow-300 font-semibold">{{$jumlahDitugaskan}}</span>
        <span class="text-zinc-700 font-semibold">Ditugaskan</span>
      </p>
      <p class="flex space-x-1">
        <span class="text-blue-500 font-semibold">{{$jumlahBertugas}}</span>
        <span class="text-zinc-700 font-semibold">Mengajukan</span>
      </p>
      <p class="flex space-x-1">
        <span class="text-green-500 font-semibold">{{$jumlahSelesai}}</span>
        <span class="text-zinc-700 font-semibold">Diterima</span>
      </p>
      <p class="flex space-x-1">
        <span class="text-red-500 font-semibold">{{$jumlahDitolak}}</span>
        <span class="text-zinc-700 font-semibold">Ditolak</span>
      </p>

    </div>
  </div>

  <div class="detail-2 mt-2 flex">
    <div class="detail-content flex items-start w-full">
      <span class="material-symbols-outlined mr-1 text-gray-300">
        location_on
      </span>
      <p class="text-sm text-gray-700">{{$tempat}}</p>
    </div>
    <div class="detail-content flex items-start w-full">
      <span class="material-symbols-outlined mr-1 text-gray-300">
        calendar_month
      </span>
      <p class="text-sm text-gray-700">{{$tanggal}}</p>
    </div>
  </div>
  <a href="/review-kegiatan/detail/{{$id}}" class="w-full">
    <button type="button"
      class="text-white w-full bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 mt-4">Review
      Kegiatan</button>
  </a>
</div>