@extends('layouts.app')

@section('content')

    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="pull-left page-title">Invoice</h4>
                        <ol class="breadcrumb pull-right">
                            <li><a href="#">Echovel</a></li>
                            <li><a href="#">Pages</a></li>
                            <li class="active">Invoice</li>
                        </ol>
                    </div>
                </div>

                <div class="row" >
                    <div class="col-md-12" id="printableArea">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="clearfix">
                                    <div class="pull-right">
                                        <h4>Order Date <br>
                                            <strong>{{ $order->order_date }}</strong>
                                        </h4>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="pull-left m-t-30">
                                            <address>
                                                <strong>Name: {{ $order->name }}</strong><br>
                                                Shop Name: {{ $order->shopname }}<br>
                                                Address: {{ $order->address }}<br>
                                                City: {{ $order->city }}<br>
                                                Phone: {{ $order->phone }}

                                            </address>
                                        </div>
                                        <div class="pull-right m-t-30">
                                            <p><strong>Today: </strong> {{ date("l jS \of F Y") }}</p>
                                            <p class="m-t-10"><strong>Order Status: </strong>
                                                @if($order->order_status == 'pending')
                                                    <span class="label label-pink">Pending</span>
                                                @else
                                                    <span class="label label-success">Success</span>
                                                @endif
                                            </p>

                                            <p class="m-t-10"><strong>Order ID: </strong>{{ $order->id}} </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-h-50"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table m-t-30">
                                                <thead>
                                                <tr><th>#</th>
                                                    <th>Product Name</th>
                                                    <th>Product Code</th>
                                                    <th>Quantity</th>
                                                    <th>Unit Cost</th>
                                                    <th>Total</th>
                                                </tr></thead>
                                                <tbody>

                                                @php
                                                    $sI=1;
                                                @endphp


                                                @foreach($order_details as $cont)

                                                    <tr>
                                                        <td>{{ $sI++ }}</td>
                                                        <td>{{ $cont->product_name }}</td>
                                                        <td>{{ $cont->product_code }}</td>
                                                        <td>{{ $cont->quantity }}</td>
                                                        <td>{{ $cont->unitcost }}</td>
                                                        <td>{{ $cont->unitcost*$cont->quantity }}</td>

                                                    </tr>

                                                @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="border-radius: 0px;"><br>

                                    <div class="col-md-9">
                                        <h3 >Payment By: {{ $order->payment_status }}</h3>
                                        <h4 >Pay: {{ $order->pay}}</h4>
                                        <h4 >Due: {{ $order->due}}</h4>

                                    </div>

                                    <div class="col-md-3 ">
                                        <p class="text-right"><b>Sub-total:</b> {{ $order->sub_total }}</p>
                                        {{--                                        <p class="text-right">Discout: 12.9%</p>--}}
                                        <p class="text-right">VAT: {{ $order->vat }}</p>
                                        <hr>
                                        <h3 class="text-right">Total: {{ $order->total }}</h3>
                                    </div>
                                </div>
                                <hr>
                                <div class="hidden-print">
                                    <div class="pull-right">
                                        <a href="#" onclick="printDiv('printableArea')"  class="btn btn-inverse waves-effect waves-light"><i class="fa fa-print"></i></a>
                                        @if($order->order_status == 'success')

                                        @else
                                        <a href="{{ URL::to('/pos-done/'.$order->id) }}" class="btn btn-primary waves-effect waves-light">Done</a>

                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>



            </div> <!-- container -->

        </div> <!-- content -->

        <footer class="footer text-right">
            2022 © CSL Traning.
        </footer>

    </div>
    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->

    <!-- For Print-->
    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>




@endsection


