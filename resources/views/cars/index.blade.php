<!DOCTYPE html>
<html>

<head>
  <title>Cars</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="container mt-4">

  <h3>Car Inventory</h3>

  <form id="addCarForm">
    @csrf
    <input type="text" name="brand" placeholder="Brand" required>
    <input type="text" name="model" placeholder="Model" required>
    <input type="number" name="price" placeholder="Price" required>
    <input type="text" name="color" placeholder="Color">
    <input type="number" name="year" placeholder="Year">
    <button class="btn btn-success">Add</button>
  </form>

  <table class="table mt-3" id="carTable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Brand</th>
        <th>Model</th>
        <th>Price</th>
        <th>Color</th>
        <th>Year</th>
        <th>Status</th>
        <th>Action</th>
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
        <td><button class="btn btn-danger btn-sm deleteCar">Delete</button></td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <script>
    $('#addCarForm').submit(function(e) {
      e.preventDefault();
      $.post('/cars/store', $(this).serialize(), function(res) {
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
                        <td><button class="btn btn-danger btn-sm deleteCar">Delete</button></td>
                    </tr>
                `);
        $('#addCarForm')[0].reset();
      });
    });

    $(document).on('click', '.deleteCar', function() {
      let tr = $(this).closest('tr');
      let id = tr.data('id');
      $.ajax({
        url: '/cars/delete/' + id,
        type: 'DELETE',
        data: {
          _token: "{{ csrf_token() }}"
        },
        success: function() {
          tr.remove();
        }
      });
    });
  </script>

</body>

</html>
