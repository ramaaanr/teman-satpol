<div
  class="w-full text-zinc-700 bg-white rounded-lg shadow-md border border-gray-100 p-6 transition-all ease-in-out hover:-translate-x-1 hover:shadow-lg ">

  <div class="detail-1 flex">
    <div class="header-detail w-full">
      <div class="flex items-center">
        <p class="font-bold text-3xl mr-2 ">{{ $kegiatan }}</p>
        <span class="font-medium me-2 rounded-full h-fit bg-{{$color}}-100 text-{{$color}}-800 text-xs mt-1 py-1 px-3">
          {{ $status }}
        </span>
      </div>
      <p class=" text-md text-zinc-500">{{ $detail }}</p>
    </div>
  </div>

  <div class="detail-2 mt-2 flex">
    <div class="detail-content flex items-start w-full">
      <span class="material-symbols-outlined mr-1 text-gray-300">
        location_on
      </span>
      <p class="text-sm text-gray-700">{{ $tempat }}</p>
    </div>
    <div class="detail-content flex items-start w-full">
      <span class="material-symbols-outlined mr-1 text-gray-300">
        calendar_month
      </span>
      <p class="text-sm text-gray-700">{{ $tanggal }}</p>
    </div>
  </div>
  <div class="detail-3 mt-2 flex items-center">

    <x-button disabled text="Isi Kegiatan" color='light' width="full" />
    <div class="detail-content flex items-start w-1/4">
      <span class="material-symbols-outlined mr-1 text-gray-300">
        groups
      </span>
      <p class="text-sm text-gray-700">{{ $petugas }} petugas</p>
    </div>
    <div class="detail-content flex items-start w-1/4">
      <span class="material-symbols-outlined mr-1 text-gray-300">
        airport_shuttle
      </span>
      <p class="text-sm text-gray-700">{{ $kendaraan }}</p>
    </div>
  </div>

</div>