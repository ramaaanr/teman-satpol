<div
  class="w-full cursor-pointer text-zinc-700 bg-white rounded-lg shadow-md border border-gray-100 p-6 transition-all ease-in-out hover:-translate-x-0.5  hover:shadow-lg ">

  <div class="detail-1 flex">
    <div class="header-detail w-full">
      <p class="font-bold text-3xl">{{$kegiatan}}</p>
      <p class=" text-md text-zinc-500">{{$detailKegiatan}}</p>
    </div>
    <div class="actions-detail flex items-center">
      <div class="text-4xl font-bold petugas-total-actions flex items-center mr-2">
        <p class="text-4xl font-bold total-dikerjakan text-gray-300">{{$jumlahSelesai}}</p>
        <p class="text-4xl font-bold ">/</p>
        <p class="text-4xl font-bold total-target text-yellow-300 mr-1">{{$jumlahDitugaskan}}</p>
        <p class="text-sm font-semibold  leading-none">Mengisi Giat</p>
      </div>
      <a href="/data-giat/{{$id}}" class="mr-2">
        <x-button text="Detail" color='gray' />
      </a> <a href="/data-giat/edit/{{$id}}">
        <x-button text="Edit" color='light' />
      </a>
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
      <p class="text-sm text-gray-700">{{$tanggalMulai}} - {{$tanggalSelesai}}</p>
    </div>
  </div>
  <div class="detail-3 mt-2 flex">
    <div class="detail-content flex items-start w-1/2">
      <span class="material-symbols-outlined mr-1 text-gray-300">
        lock_clock
      </span>
      <p class="text-sm text-gray-700">{{$aksesMulai}} - {{$aksesSelesai}}</p>
    </div>
    <div class="detail-content flex items-start w-1/4">
      <span class="material-symbols-outlined mr-1 text-gray-300">
        groups
      </span>
      <p class="text-sm text-gray-700">{{$jumlahDitugaskan}} petugas</p>
    </div>
    <div class="detail-content flex items-start w-1/4">
      <span class="material-symbols-outlined mr-1 text-gray-300">
        airport_shuttle
      </span>
      <p class="text-sm text-gray-700">{{$kendaraan}}</p>
    </div>
  </div>
</div>