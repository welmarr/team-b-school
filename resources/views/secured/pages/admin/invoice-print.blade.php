<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice Print | Admin</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.css') }}">
    <style>
        @media print {
            @page {
                margin: 0;
            }

            body {
                margin-top: 2cm;
                background: url("img/cincy-transparent.png");
            }

            header,
            footer,
            nav,
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h2 class="page-header">
                        <i class="fas fa-globe"></i>Cincy Dent Repair
                        <small class="float-right">Date: {{ \Carbon\Carbon::now()->format('Y-m-d') }}</small>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    From
                    <address>
                        <strong>Cincy Dent Repair</strong><br>
                        Phone: (513)515-0941<br>
                        Email: chris@cincydentrepair.com
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    To
                    <address>
                        <strong>{{ $demand->createdBy->first_name }} {{ $demand->createdBy->last_name }}</strong><br>
                        Phone: {{ $demand->createdBy->phone }} <br>
                        Email: {{ $demand->createdBy->email }}
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <br>
                    <b>Request ref:</b> {{ $demand->reference }}<br>
                    <b>Payed at:</b> {{ \Carbon\Carbon::now()->format('Y-m-d') }}<br>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Task description</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Repair dent on {{ $demand->car->brand->name }} {{ $demand->car->model->name }}
                                    ({{ $demand->car->year }}) [request reference: {{ $demand->reference }}]</td>
                                <td>${{ $demand->estimation }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
    <!-- Page specific script -->
    <script>
        window.addEventListener("load", window.print());
    </script>
</body>

</html>
