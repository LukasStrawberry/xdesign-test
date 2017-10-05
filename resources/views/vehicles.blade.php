<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Vehicles</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <style>
        .starter-template {
            padding: 3rem 1.5rem;
            text-align: center;
        }
        .table {
            font-size: 14px;
        }
        th {
            text-align: center;
        }
    </style>
</head>

<body>
<script type="text/javascript">
    $(document).ready(function () {

        $('tbody tr').on('click', function (e) {
            window.location.href = $('a', $(this)).attr('href');
        })

    });
</script>

<div class="container">

    <div class="starter-template">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>License plate</th>
                    <th>Owner</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($vehicles as $vehicle)
                <tr>
                    <td>{{ $vehicle->id }}</td>
                    <td>{{ $vehicle->license_plate }}</td>
                    <td>{{ $vehicle->owner->name }}</td>
                    <td><a href="/{{ $vehicle->id }}" class="btn btn-primary" role="button">Detail</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</div><!-- /.container -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>
</html>