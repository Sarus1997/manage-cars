<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Car Inventory</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>

<style>
  body {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
  }

  .navbar {
    background: rgba(255, 255, 255, 0.95) !important;
    backdrop-filter: blur(10px);
    box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
  }

  .main-content {
    flex: 1;
    padding: 2rem 0;
  }

  .welcome-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(15px);
    border: none;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .welcome-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
  }

  .card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
    border-radius: 20px 20px 0 0 !important;
    padding: 1.5rem;
  }

  .menu-item {
    border: none !important;
    padding: 1rem 1.5rem;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
  }

  .menu-item:hover {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    transform: translateX(10px);
  }

  .menu-item:hover a {
    color: white !important;
  }

  .menu-item a {
    text-decoration: none;
    color: #333;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .menu-item:last-child:hover {
    background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
  }

  .footer {
    background: rgba(0, 0, 0, 0.8);
    backdrop-filter: blur(10px);
    color: white;
    padding: 2rem 0;
    margin-top: auto;
  }

  .footer-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
  }

  .footer-links a {
    color: #ccc;
    text-decoration: none;
    margin: 0 15px;
    transition: color 0.3s ease;
  }

  .footer-links a:hover {
    color: #667eea;
  }

  .social-icons a {
    color: #ccc;
    font-size: 1.2rem;
    margin: 0 10px;
    transition: all 0.3s ease;
  }

  .social-icons a:hover {
    color: #667eea;
    transform: translateY(-2px);
  }

  .brand-logo {
    font-weight: bold;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  @media (max-width: 768px) {
    .footer-content {
      flex-direction: column;
      text-align: center;
      gap: 1rem;
    }

    .navbar-brand {
      font-size: 1.1rem;
    }
  }
</style>

<x-nav />

<body class="bg-light">
  <br>
  <br>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="card shadow">
          <div class="card-body">
            <h3 class="mb-4 text-center text-primary"><i class="bi bi-car-front-fill"></i> Car Inventory</h3>

            <form id="addCarForm" class="row g-3">
              @csrf
              <input type="hidden" id="carId" name="id">
              <div class="col-md-4">
                <input type="number" name="custom_id" class="form-control" placeholder="Custom ID (optional)" />
              </div>
              <div class="col-md-4">
                <input type="text" name="brand" class="form-control" placeholder="Brand" required />
              </div>
              <div class="col-md-4">
                <input type="text" name="model" class="form-control" placeholder="Model" required />
              </div>
              <div class="col-md-4">
                <input type="number" name="price" class="form-control" placeholder="Price" required />
              </div>
              <div class="col-md-4">
                <input type="text" name="color" class="form-control" placeholder="Color" />
              </div>
              <div class="col-md-4">
                <input type="number" name="year" class="form-control" placeholder="Year" />
              </div>
              <div class="col-12 text-end">
                <button type="submit" class="btn btn-success">
                  <i class="bi bi-plus-circle"></i> Add
                </button>
              </div>
            </form>

            <hr class="my-4">

            <div class="table-responsive">
              <table class="table table-bordered table-hover align-middle" id="carTable">
                <thead class="table-light text-center">
                  <tr>
                    <th>ID</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Price</th>
                    <th>Color</th>
                    <th>Year</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($cars as $c)
                  <tr data-id="{{ $c['id'] }}">
                    <td>{{ $c['id'] }}</td>
                    <td>{{ $c['brand'] }}</td>
                    <td>{{ $c['model'] }}</td>
                    <td>{{ $c['price'] }}</td>
                    <td>{{ $c['color'] }}</td>
                    <td>{{ $c['year'] }}</td>
                    <td>{{ $c['status'] }}</td>
                    <td class="text-center">
                      <button class="btn btn-sm btn-primary editCar">
                        <i class="bi bi-pencil-square"></i>
                      </button>
                    </td>
                    <td class="text-center">
                      @if($user['role'] === 'admin')
                      <button class="btn btn-sm btn-danger deleteCar">
                        <i class="bi bi-trash"></i>
                      </button>
                      @else
                      <span class="text-muted">No permission</span>
                      @endif
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <x-footer />

  <script>
    const isAdmin = @json($user['role'] === 'admin');
    const isUser = @json($user['role'] === 'user');
    let editing = false;

    function resetForm() {
      $('#addCarForm')[0].reset();
      $('#carId').val('');
      editing = false;
      $('#addCarForm button[type="submit"]')
        .html('<i class="bi bi-plus-circle"></i> Add')
        .removeClass('btn-warning')
        .addClass('btn-success');
    }

    if (isAdmin || isUser) {
      $('#addCarForm').submit(function(e) {
        e.preventDefault();
        const formData = $(this).serialize();
        const carId = $('#carId').val();

        if (editing) {
          $.ajax({
            url: '/cars/update/' + carId,
            type: 'PUT',
            data: formData,
            success: function(res) {
              const car = res.car;
              const tr = $(`#carTable tbody tr[data-id="${car.id}"]`);
              tr.html(`
                <td>${car.id}</td>
                <td>${car.brand}</td>
                <td>${car.model}</td>
                <td>${car.price}</td>
                <td>${car.color}</td>
                <td>${car.year}</td>
                <td>${car.status}</td>
                <td class="text-center"><button class="btn btn-sm btn-primary editCar"><i class="bi bi-pencil-square"></i></button></td>
                <td class="text-center"><button class="btn btn-sm btn-danger deleteCar"><i class="bi bi-trash"></i></button></td>
              `);
              resetForm();
            }
          });
        } else {
          $.post('/cars/store', formData, function(res) {
            const car = res.car;
            $('#carTable tbody').append(`
              <tr data-id="${car.id}">
                <td>${car.id}</td>
                <td>${car.brand}</td>
                <td>${car.model}</td>
                <td>${car.price}</td>
                <td>${car.color}</td>
                <td>${car.year}</td>
                <td>${car.status}</td>
                <td class="text-center"><button class="btn btn-sm btn-primary editCar"><i class="bi bi-pencil-square"></i></button></td>
                <td class="text-center"><button class="btn btn-sm btn-danger deleteCar"><i class="bi bi-trash"></i></button></td>
              </tr>
            `);
            resetForm();
          });
        }
      });

      $(document).on('click', '.editCar', function() {
        let tr = $(this).closest('tr');
        let id = tr.data('id');
        $('#carId').val(id);
        $('#addCarForm input[name="brand"]').val(tr.find('td:eq(1)').text());
        $('#addCarForm input[name="model"]').val(tr.find('td:eq(2)').text());
        $('#addCarForm input[name="price"]').val(tr.find('td:eq(3)').text());
        $('#addCarForm input[name="color"]').val(tr.find('td:eq(4)').text());
        $('#addCarForm input[name="year"]').val(tr.find('td:eq(5)').text());

        editing = true;
        $('#addCarForm button[type="submit"]')
          .html('<i class="bi bi-save"></i> Save')
          .removeClass('btn-success')
          .addClass('btn-warning');
      });
    } else {
      $('#addCarForm').on('submit', function(e) {
        e.preventDefault();
        alert('คุณไม่มีสิทธิ์เพิ่มรถ');
      });
    }
  </script>
</body>

</html>