<!DOCTYPE html>
<html>

<head>
    <title>Loan Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="container mt-4">

    <h3>Loan Calculator</h3>
    <div class="mb-2">
        <input type="number" id="amount" class="form-control" placeholder="ยอดจัด">
    </div>
    <div class="mb-2">
        <input type="number" id="rate" class="form-control" placeholder="ดอกเบี้ย % ต่อปี">
    </div>
    <div class="mb-2">
        <input type="number" id="terms" class="form-control" placeholder="จำนวนงวด">
    </div>
    <button id="calcBtn" class="btn btn-primary">คำนวณ</button>
    <button id="clearBtn" class="btn btn-secondary" style="display:none">เคลียร์</button>

    <table class="table mt-3" id="resultTable">
        <thead>
            <tr>
                <th>งวด</th>
                <th>ยอดผ่อน</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <script>
        function validateInput(id) {
            let val = $(id).val();
            if (val < 0 || isNaN(val)) {
                alert("กรุณาใส่ตัวเลขที่ถูกต้อง");
                $(id).val('');
            }
        }

        $('#amount').on('input', function() {
            validateInput(this);
        });
        $('#rate').on('input', function() {
            validateInput(this);
        });
        $('#terms').on('input', function() {
            validateInput(this);
        });

        $('#calcBtn').click(function() {
            $.post('/loan/calculate', {
                _token: "{{ csrf_token() }}",
                amount: $('#amount').val(),
                rate: $('#rate').val(),
                terms: $('#terms').val()
            }, function(res) {
                let tbody = $('#resultTable tbody');
                tbody.empty();
                res.forEach(r => {
                    let row = `<tr data-terms="${r.terms}" class="${r.payment>5000?'table-danger':''}">
                <td>${r.terms}</td><td>${r.payment}</td>
            </tr>`;
                    tbody.append(row);
                });
                $('#clearBtn').show();
            });
        });

        $(document).on('click', '#resultTable tr', function() {
            $('#resultTable tr').removeClass('table-primary');
            $(this).addClass('table-primary');
        });

        $('#clearBtn').click(function() {
            $('#amount,#rate,#terms').val('');
            $('#resultTable tbody').empty();
            $(this).hide();
        });
    </script>

</body>

</html>
