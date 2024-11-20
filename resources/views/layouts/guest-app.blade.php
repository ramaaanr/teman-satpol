<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'My Application')</title>
  <!-- <script src="/build/assets/app-B4uPvtxE.js"></script> -->
  <!-- <link rel="stylesheet" href="/build/assets/app-DnB_b2nK.css"> -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Include jQuery and DataTables JS -->
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <!-- Include DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
</head>

<body>
  <!-- Header -->

  <!-- Main Content -->
  <main>
    @yield('content')
  </main>

  <!-- Footer -->


</body>

</html>