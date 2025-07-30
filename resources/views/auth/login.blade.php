<!DOCTYPE html>
<html>

<head>
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">

  <h3>Login</h3>
  @if ($errors->any())
  <div class="alert alert-danger">{{ $errors->first() }}</div>
  @endif
  @if (session('msg'))
  <div class="alert alert-info">{{ session('msg') }}</div>
  @endif

  <form method="POST" action="/login">
    @csrf
    <div class="mb-2">
      <input type="email" name="email" class="form-control" placeholder="Email" required>
    </div>
    <div class="mb-2">
      <input type="password" name="password" class="form-control" placeholder="Password" required>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
  </form>

  <hr>
  <h5>Reset Password</h5>
  <form method="POST" action="/reset-password">
    @csrf
    <input type="email" name="email" class="form-control mb-2" placeholder="Enter email">
    <button type="submit" class="btn btn-warning">Reset</button>
  </form>

  <hr>
  <p>ยังไม่มีบัญชี? <a href="/register">สมัครสมาชิก</a></p>

</body>

</html>
