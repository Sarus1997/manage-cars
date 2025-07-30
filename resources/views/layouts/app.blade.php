<!-- ตัวอย่างใน layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'ระบบ')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>



<body>

  <main>
    @yield('content')
  </main>

</body>

</html>