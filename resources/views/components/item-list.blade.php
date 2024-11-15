<div class="">
  <p class="text-gray-500 font-md mt-2 text-xs">Kegiatan</p>
  <div id="item-container" class="p-4 mt-2 border broder-gray-500  rounded-md ">

  </div>
  <script>
  $(document).ready(function() {
    const url = window.location.href;
    const id = url.split("/").pop();
    const userData = localStorage.getItem('user');
    const user = userData ? JSON.parse(userData) : null;
    const token = user ? user.token : null;
    $.ajax({
      url: '/api/items',
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'Authorization': `Bearer ${token}`
      },
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