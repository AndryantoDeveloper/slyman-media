<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Print Ticket</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('font-awesome-4.1.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/blog-home.css') }}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body onload="window.print()">

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-6 pull-right">
                <span class="pull-left">
                    <strong>@php echo date('m/d/Y') @endphp</strong>
                </span>
                &nbsp; &nbsp; &nbsp; &nbsp;
                <span class="pull-right">
                    <strong>{{ $invoice->invoice_number }}</strong>
                </span>
            </div>
            <div class="clearfix"></div>
            <h1></h1>
            <div class="col-md-6 pull-right">
                <h4><strong>Customer Detail</strong></h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <td width="">Name</td>
                            <td width=""><strong>{{ $invoice->customer->name }}</strong></td>
                        </tr>
                        <tr>
                            <td width="">Phone</td>
                            <td width=""><strong>{{ $invoice->customer->phone }}</strong></td>
                        </tr>
                        <tr>
                            <td width="">Device Type</td>
                            <td width="">
                                <strong>
                                    {{ $invoice->device->name }} - {{ $invoice->device->color->name }} - {{ $invoice->device->carrier->name }}  - {{ $invoice->device->size->value }}{{ $invoice->device->size->unit }} - {{ $invoice->condition->name }}
                                </strong>
                            </td>
                        </tr>
                        <tr>
                            <td width="">Price</td>
                            <td width=""><strong>${{ $invoice->condition->price }}</strong></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <h2>Parts</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Part name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Tax (8.61%)</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($detail)==0)
                    <tr>
                        <td colspan="6" class="text-center">No Data</td>
                    </tr>
                    @else
                    @foreach($detail as $row)
                    <tr>
                        <td>{{ $row->part->name }}</td>
                        <td>{{ $row->qty }}</td>
                        <td>{{ $row->price }}</td>
                        <td>{{ $row->tax }}</td>
                        <td>{{ $row->total }}</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="{{ asset('js/jquery-1.11.0.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

</body>

</html>
