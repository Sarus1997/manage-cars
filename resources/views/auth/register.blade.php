<!DOCTYPE html>
<html>

<head>
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">

  <h3>Register</h3>
  @if ($errors->any())
  <div class="alert alert-danger">{{ $errors->first() }}</div>
  @endif

  <form method="POST" action="/register">
    @csrf
    <div class="mb-2">
      <input type="text" name="name" class="form-control" placeholder="Full Name" required>
    </div>
    <div class="mb-2">
      <input type="email" name="email" class="form-control" placeholder="Email" required>
    </div>
    <div class="mb-2">
      <input type="password" name="password" class="form-control" placeholder="Password" required>
    </div>
    <button type="submit" class="btn btn-success">Register</button>
  </form>

  <hr>
  <p>มีบัญชีแล้ว? <a href="/login">Login</a></p>

</body>

</html>
