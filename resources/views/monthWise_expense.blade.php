@extends('layouts.app')

@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="pull-left page-title">Welcome ! {{ date("Y") }}</h4>
                        <ol class="breadcrumb pull-right">
                            <li><a href="#">Echobvel</a></li>
                            <li class="active">IT</li>
                        </ol>
                    </div>
                </div>

                <div>
                    <a href="{{ route('january.expense') }}" class="btn btn-sm btn-info">January</a>
                    <a href="{{ route('february.expense') }}" class="btn btn-sm btn-danger">February</a>
                    <a href="{{ route('march.expense') }}" class="btn btn-sm btn-success">March</a>
                    <a href="{{ route('april.expense') }}" class="btn btn-sm btn-warning">April</a>
                    <a href="{{ route('may.expense') }}" class="btn btn-sm btn-info">May</a>
                    <a href="{{ route('june.expense') }}" class="btn btn-sm btn-danger">June</a>
                    <a href="{{ route('july.expense') }}" class="btn btn-sm btn-success">July</a>
                    <a href="{{ route('august.expense') }}" class="btn btn-sm btn-primary">August</a>
                    <a href="{{ route('september.expense') }}" class="btn btn-sm btn-info">September</a>
                    <a href="{{ route('october.expense') }}" class="btn btn-sm btn-danger">October</a>
                    <a href="{{ route('november.expense') }}" class="btn btn-sm btn-success">November</a>
                    <a href="{{ route('december.expense') }}" class="btn btn-sm btn-warning">December</a>
                </div>

                <!-- Start Widget -->
                <div class="row">
                    <div class="col-md-12">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title text-danger">{{ $month}} All Expense</h3>
                                {{--                                <a  href="{{ route('add.expense') }}" class="btn btn-sm btn-info pull-right ">Add New</a>--}}
                                <br>
                            </div>



                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                            <tr>

                                                <th>Details</th>
                                                <th>Amount</th>

                                            </tr>
                                            </thead>


                                            <tbody>
                                            @foreach($expense as $row)
                                                <tr>
                                                    <td>{{ $row->details }}</td>
                                                    <td>{{ $row->amount }}</td>

                                                </tr>
                                            @endforeach

                                            </tbody>

                                        </table>



                                        <h4 style="color: red; margin-left: 24%;  font-size: 20px;" align="center">Total Expense: {{ $total }} Taka </h4>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div> <!-- container -->

        </div> <!-- content -->

    </div>



@endsection
