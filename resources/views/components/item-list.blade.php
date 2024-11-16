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
    let itemPenugasan = [];

    $.ajax({
      url: `/api/detail_items?id_penugasan=${id}`,
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'Authorization': `Bearer ${token}`
      },
      success: function({
        data
      }) {
        itemPenugasan = data;
      },
      error: function(xhr, status, error) {
        console.error('Error:', error);
      }
    }).then(() => {
      $.ajax({
        url: '/api/items',
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'Authorization': `Bearer ${token}`
        },
        success: function(items) {
          // Iterasi setiap item yang diterima dari respons
          items.forEach(({
            id,
            deskripsi
          }) => {
            let checked = false;

            // Periksa apakah id_item ada dalam itemPenugasan
            itemPenugasan.some(({
              item: {
                id_item
              }
            }) => {
              if (id === id_item) {
                checked = true; // Set checked menjadi true jika cocok
                return true; // Hentikan iterasi lebih lanjut
              }
            });
            let itemElement =
              `<x-check-item id="${id}" deskripsi="${deskripsi}" checked="" />`;
            if (checked) {
              itemElement =
                `<x-check-item id="${id}" deskripsi="${deskripsi}" checked="checked" />`;
            }
            // // Buat elemen HTML dengan atribut checked sesuai kondisi

            $('#item-container').append(itemElement);
          });
        },
        error: function(xhr, status, error) {
          console.error('Error:', error);
        }
      });
    });
  })
  </script>
</div>