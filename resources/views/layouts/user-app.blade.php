<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Teman Satpol</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- Include jQuery and DataTables JS -->
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <!-- Include DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>


<body>
  <!-- Header -->
  @include('layouts.partials.header')

  <!-- Main Content -->
  <main class="p-4">
    @yield('content')
  </main>

  <!-- Footer -->
  @include('layouts.partials.footer')


</body>

</html>