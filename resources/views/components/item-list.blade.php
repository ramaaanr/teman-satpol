<div class="">
  <p class="text-gray-500 font-md mt-2 text-xs">Kegiatan</p>
  <div id="item-container" class="p-4 mt-2 border broder-gray-500  rounded-md ">


  </div>
  <script>
  $(document).ready(function() {
    $.ajax({
      url: '/samples/data-item.json',
      method: 'GET',
      success: function(
        items
      ) {
        items.forEach(({
          id,
          deskripsi
        }) => {
          let itemElement = `<x-check-item id="${id}" deskripsi="${deskripsi}" />`;
          $('#item-container').append(itemElement)
        });
      },
      error: function(xhr, status, error) {
        console.error('Error:', error);
      }
    });
  });
  </script>
</div>