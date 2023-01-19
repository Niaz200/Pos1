@extends('layouts.app')

@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="pull-left page-title">Welcome !</h4>
                        <ol class="breadcrumb pull-right">
                            <li><a href="#">Echobvel</a></li>
                            <li class="active">IT</li>
                        </ol>
                    </div>
                </div>

                @php

                /* $data= $today->date;  */

                  $date=date("d/m/y");
                  $expense=DB::table('expenses')->where('date',$date)->sum('amount');

                @endphp

                <!-- Start Widget -->
                <div class="row">
                    <div class="col-md-12">
                        <h4 style="color: red; font-size: 30px;" align="center">Total: {{$expense}} Taka</h4>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Today expense</h3>
                                <a  href="{{ route('add.expense') }}" class="btn btn-sm btn-info pull-right ">Add New</a>
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
                                                <th>Action</th>
                                            </tr>
                                            </thead>


                                            <tbody>
                                            @foreach($today as $row)
                                                <tr>
                                                    <td>{{ $row->details }}</td>
                                                    <td>{{ $row->amount }}</td>

                                                    <td>
                                                        <a href="{{ URL::to('edit-expense/'.$row->id) }}" class="btn btn-sm btn-info">Edit</a>
                                                        <a href="{{ URL::to('/delete-expense/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete">Delete</a>

                                                    </td>
                                                </tr>
                                            @endforeach

                                            </tbody>

                                        </table>
                                        <h4 style=" margin-left: 24%;  font-size: 20px;" align="center">Total: {{$expense}} Taka </h4>

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
