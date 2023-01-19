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

                <!-- Start Widget -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">All Attendance
                                <a  href="{{ route('take.attendance') }}" class="btn btn-sm btn-info pull-right ">Take New</a>
                                </h3>
                            </div>



                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>SI</th>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>


                                            <tbody>

                                            <?php
                                                $sl=1;
                                            ?>
                                            @foreach($all_att as $row)
                                                <tr>
                                                    <td>{{ $sl++ }}</td>
                                                    <td>{{ $row->edit_date }}</td>
                                                    <td>
                                                        <a href="{{ URL::to('/edit-attendance/'.$row->edit_date) }}" class="btn btn-sm btn-info">Edit</a>
                                                        <a href="{{ URL::to('/delete-attendance/'.$row->edit_date) }}" class="btn btn-sm btn-danger" id="delete">Delete</a>
                                                        <a href="{{ URL::to('/view-attendance/'.$row->edit_date) }}" class="btn btn-sm btn-success">View</a>

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

            </div> <!-- container -->

        </div> <!-- content -->

    </div>



@endsection
