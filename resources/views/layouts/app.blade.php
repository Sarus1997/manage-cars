<!-- ตัวอย่างใน layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'ระบบ')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

  <x-nav /> <!-- ✅ เรียก navbar -->

  <main>
    @yield('content')
  </main>

  <x-footer /> <!-- ✅ เรียก footer -->

</body>

</html>
