<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Vehicles</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
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


<div class="container">

    <div class="starter-template">
        <div class="row">
            <div class="col-lg-12">
                <h1>Vehicle {{ $vehicle->license_plate }}</h1>
            </div>
            <div class="col-lg-6">
                <h2>Vehicle details</h2>
                <p class="text-left">
                    <strong>Manufacturer</strong>: {{ $vehicle->model->manufacturer->name }}<br />
                    <strong>Model</strong>: {{ $vehicle->model->name }}<br />
                    <strong>Engine cc</strong>: {{ $vehicle->engine_cc }}<br />
                    <strong>Type</strong>: {{ $vehicle->type->name }}<br />
                    <strong>Fuel type</strong>: {{ $vehicle->fuelType->name }}<br />
                    <strong>Usage</strong>: {{ $vehicle->usage->name }}<br />
                    <strong>Color</strong>: {{ $vehicle->colour }}<br />
                    <strong>Weight category:</strong>: {{ $vehicle->weightCategory->name }}<br />
                    <strong>Seats count</strong>: {{ $vehicle->seats_count }}<br />
                    <strong>Doors count</strong>: {{ $vehicle->doors_count }}<br />
                    <strong>Wheels count</strong>: {{ $vehicle->wheels_count }}<br />
                    <strong>HGV</strong>: {{ $vehicle->model->is_hgv ? 'yes' : 'no' }}<br />
                    <strong>Boot</strong>: {{ $vehicle->model->has_boot ? 'yes' : 'no' }}<br />
                    <strong>Trailer</strong>: {{ $vehicle->model->has_trailer ? 'yes' : 'no' }}<br />
                    <strong>Sunroof</strong>: {{ $vehicle->model->sunroof ? 'yes' : 'no' }}<br />
                    <strong>GPS</strong>: {{ $vehicle->model->has_gps ? 'yes' : 'no' }}<br />
                </p>
            </div>
            <div class="col-lg-6">
                <h2>Owner details</h2>
                <p class="text-left">
                    <strong>Name</strong>: {{ $vehicle->owner->name }}<br />
                    <strong>Company</strong>: {{ $vehicle->owner->company->name }}<br />
                    <strong>Profession</strong>: {{ $vehicle->owner->profession }}
                </p>
            </div>
        </div>
    </div>

</div><!-- /.container -->


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>
</html>