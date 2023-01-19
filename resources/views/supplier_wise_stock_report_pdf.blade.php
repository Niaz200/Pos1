<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Supplier Wise Stock Report PDF</title>

    {{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">--}}
    {{--    <link href="{{ asset('admin/css/bootstrap.min.css')}}" rel="stylesheet" />--}}

</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table width="100%">
                <tbody>
                <tr>
                    <td width="25%"></td>
                    <td>
                        <span style="font-size: 20px;background: #1781BF;padding: 3px 10px 3px 10px;color: #fff;">Shapla Shoping Mall</span><br>
                        Uttara-Badda,Dhaka
                    </td>

                    <td>
                                <span>Showroom No:01735207899 <br/>
                                    Owner No: 0145278251
                                </span>
                    </td>
                </tr>
                </tbody>

            </table>
        </div>
    </div>

    <div class="row"  >
        <div class="col-md-12">
            <hr style="margin-bottom: 0px;">
            <table style="margin: 0px auto;">
                <tbody>
                <tr >
                    <td ></td>
                    <td >
                        <u><strong><span style="font-size: 15px; ">Supplier Wise Stock Report</span></strong></u>

                    </td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <strong>Supplier Name : </strong> {{$allData['0']->shop}} <br>
            <table border="1px solid black" cellspacing = "0" width="100%">
                <thead>
                <tr>
                    <th>Sl.</th>
                    <th>Category Name</th>
                    <th>Product Name</th>
                    <th>Code</th>
                    <th>Selling Price</th>
                    <th>Image</th>
                    <th>Quantity</th>
                    <th>Garage</th>
                    <th>Route</th>
                    {{--   <th>Action</th>--}}
                </tr>
                </thead>


                <tbody>

                @foreach($allData as $key => $row)
                    <tr>
                        <td>{{ $key+1}}</td>
                        <td>{{ $row->cat_name}}</td>
                        <td>{{ $row->product_name }}</td>
                        <td>{{ $row->product_code}}</td>
                        <td>{{ $row->selling_price }}</td>
                        <td><img src="{{ $row->product_image }}" style=" height: 60px; width: 60px;" alt=""></td>
                        <td>{{ $row->quantity }}</td>
                        <td>{{ $row->product_garage }}</td>
                        <td>{{ $row->product_route}}</td>

                        {{--                                                    <td>--}}
                        {{--                                                        <a href="{{ URL::to('edit-product/'.$row->id) }}" class="btn btn-sm btn-info">Edit</a>--}}
                        {{--                                                        <a href="{{ URL::to('delete-product/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete">Delete</a>--}}
                        {{--                                                        <a href="{{ URL::to('view-product/'.$row->id) }}" class="btn btn-sm btn-primary">View</a>--}}
                        {{--                                                    </td>--}}
                    </tr>
                @endforeach
                </tbody>
            </table>

            @php
                $date = new DateTime('now', new DateTimeZone('Asia/Dhaka'));
            @endphp
            <i>Printing time : {{$date->format('F j,Y,g:ia')}}</i>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table border="0" width="100%">
                <tbody>
                <tr>
                    <td style="width: 40%;"></td>
                    <td tyle="width: 20%;"></td>
                    <td style="width: 40%; text-align: center;">
                        <p style="text-align: center; margin-top: 60px; border-bottom: 1px solid #000;">Owner signature</p>
                    </td>
                </tr>
                </tbody>

            </table>

        </div>
    </div>

</div>

</body>
</html>
