@extends('layouts.app')

@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12 bg-info">
                        <h4 class="pull-left page-title text-white">POS (Point of Sale) </h4>
                        <ol class="breadcrumb pull-right">
                            <li><a href="#" class="text-white">Echovel</a></li>
                            <li class="text-white">{{ date('d/m/y') }}</li>
                        </ol>
                    </div>
                </div>
                <br><br>
                <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                            <div class="portfolioFilter">

                                @foreach($categories as $row)
                                <a href="#" data-filter="*" class="current">{{$row->cat_name}}</a>

                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="row"><br>
                        <div class="col-lg-6">
{{--                            <div class="panel">--}}
{{--                                <h4 class="text-info">Customer--}}
{{--                                    <a href="#" class="btn btn-sm btn-primary waves-effect waves-light pull-right" data-toggle="modal"--}}
{{--                                       data-target="#con-close-modal">Add New</a>--}}
{{--                                </h4>--}}

{{--                                <select class="form-control">--}}
{{--                                    <option disabled="" selected="">select customer</option>--}}
{{--                                    @foreach($customer as $cus)--}}
{{--                                        <option value="{{ $cus->name }}">{{$cus->name}}</option>--}}

{{--                                    @endforeach--}}
{{--                                </select>--}}

{{--                            </div>--}}

                            <div class="price_card text-center">

                                <ul class="price-features" style="border: 1px solid grey;">
                                    <table class="table">
                                        <thead class="bg-info">
                                            <tr>
                                                <th class="text-white">Name</th>
                                                <th class="text-white">Qty</th>
                                                <th class="text-white">Single Price</th>
                                                <th class="text-white">Sub Total</th>
                                                <th class="text-white">Action</th>
                                            </tr>
                                        </thead>

                                        @php
                                            $cart_prod=Cart::content()
                                        @endphp

                                        <tbody>

                                        @foreach($cart_prod as $prod)
                                            <tr>
                                                <th>{{ $prod->name }}</th>
                                                <th>
                                                    <form action="{{ url('/cart-update/'.$prod->rowId) }}" method="post">
                                                        @csrf
                                                             <div class="d-flex  justify-content-between flex-wrap qty buttons_added" >
                                                            <div class="quantity-area  mb-3" >

                                                                <button type="submit" value="-" class="minus bg__base text-white btn btn-sm btn-success" style="margin-top: -2px;"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                                                <input type="number" step="1" min="1" max="" name="qty" value="{{ $prod->qty }}" title="Qty" class="input-text qty text" size="4" pattern="" inputmode="" style="width: 40px;border-style: solid;border-color: rgb(223 215 215);">
                                                                <button type="submit" class="plus bg__base text-white btn btn-sm btn-success " style="margin-top: -1px;"><i class="fa fa-plus"></i></button>
                                                            </div>



                                                        </div>
                                                    </form>
                                                </th>
                                                <th>{{ $prod->price }}</th>
                                                <th>{{ $prod->price*$prod->qty  }}</th>

                                                <th><a href="{{ URL::to('/cart-remove/'.$prod->rowId) }}"><i class="fas fa-trash-alt text-danger"></i></a></th>
                                            </tr>
                                         @endforeach
                                        </tbody>

                                    </table>

                                </ul>
                                 <div class="pricing-header bg-primary">
                                    <p style="font-size: 18px"> Quantity: {{ Cart::count() }}</p>
                                    <p style="font-size: 18px"> Sub Total: {{ Cart::subtotal() }}</p>
                                    <p style="font-size: 18px"> Product: 00.00</p>
                                    <p style="font-size: 18px"> VAT: {{ Cart::tax() }}</p>
                                     <hr>
                                    <p><h2 class="text-white">Total:</h2> <h1 class="text-white">{{ Cart::total() }}</h1></p>





                                <form action="{{ url('/create-invoice') }}" method="post">
                                    @csrf

                                    <div class="panel"><br><br>

                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <h4 class="text-info">Select Customer
                                            <a href="#" class="btn btn-sm btn-primary waves-effect waves-light pull-right" data-toggle="modal"
                                               data-target="#con-close-modal">Add New</a>
                                        </h4>

                                        <select class="form-control" name="cus_id">
                                            <option disabled="" selected="">select customer</option>
                                            @foreach($customer as $cus)
                                                <option value="{{ $cus->id }}">{{$cus->name}}</option>

                                            @endforeach
                                        </select>

                                    </div>


                             </div>

{{--                                     <input type="submit" name="submit" value="Create Invoice" class="btn btn-success">--}}
                                <button type="submit" class="btn btn-success">Create Invoice</button>


                            </div>
                        </div>

                         </form>



                    <div class="col-lg-6">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Product Code</th>
{{--                                <th>Unit Price</th>--}}

                            </tr>
                            </thead>


                            <tbody>
                            @foreach($product as $row)
                                <tr>
                                    <form action="{{ url('/add-cart') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $row->id }}">
                                        <input type="hidden" name="name" value="{{ $row->product_name}}">
                                        <input type="hidden" name="qty" value="1">
                                        <input type="hidden" name="price" value="{{ $row->selling_price }}">
                                        <input type="hidden" name="weight" value="0">
                                    <td>
                                        <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-plus-square"></i></button>
{{--                                        <a href="#" style="font-size: 20px;"><i class="fas fa-plus-square"></i></a>--}}
                                        <img src="{{ URL::to($row->product_image) }}" width="60px"; height="60px;" alt=""></td>
                                    <td>{{ $row->product_name }}</td>
                                    <td>{{ $row->cat_name }}</td>
                                    <td>{{ $row->product_code }}</td>
{{--                                    <td>{{ $row->selling_price }}</td>--}}


                                    </form>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>

                </div>


            </div> <!-- container -->
        </div> <!-- content -->
    </div><!-- content-page -->


    <!--customer add modal--->
    <form action="{{ url('/insert-customer') }}" method="POST" enctype="multipart/form-data">
        @csrf
    <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" >Add a New Customer</h4>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-4" class="control-label">Name</label>
                                <input type="text" class="form-control" id="field-4" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-5" class="control-label">Email</label>
                                <input type="email" class="form-control" id="field-5"  name="email" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-6" class="control-label">Phone</label>
                                <input type="text" class="form-control" id="field-6" name="phone" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-4" class="control-label">Address</label>
                                <input type="text" class="form-control" id="field-4" name="address" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-5" class="control-label">Shopname</label>
                                <input type="text" class="form-control" id="field-5" name="shopname" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-6" class="control-label">City</label>
                                <input type="text" class="form-control" id="field-6" name="city" >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-4" class="control-label">Account Number</label>
                                <input type="text" class="form-control" id="field-4" name="account_number" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-5" class="control-label">Account Holder</label>
                                <input type="text" class="form-control" id="field-5" name="account_holder">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-6" class="control-label">Bank Name</label>
                                <input type="text" class="form-control" id="field-6" name="bank_name" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-4" class="control-label">Bank Brach</label>
                                <input type="text" class="form-control" id="field-4" name="bank_branch" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <img id="image" src="#" alt="">
                                <label for="exampleInputPassword1">Show Photo</label>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-6" class="control-label">Photo</label>
                                <input type="file" class="form-control" name="photo" accept="image/*" class="upload" required onchange="readURL(this);">
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info waves-effect waves-light">Submit</button>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->

    </form>

    <script type="text/javascript">
        function readURL(input){
            if(input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function (e){
                    $('#image')
                        .attr('src', e.target.result)
                        .width(80)
                        .height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	
	<!--  increment and decrement -->

<script type="text/javascript">

function wcqib_refresh_quantity_increments() {
    jQuery("div.qty:not(.buttons_added), td.qty:not(.buttons_added)").each(function(a, b) {
        var c = jQuery(b);
        c.addClass("buttons_added"), c.children().first().before('<input type="button" value="-" class="minus" />'), c.children().last().after('<input type="button" value="+" class="plus" />')
    })
}
String.prototype.getDecimals || (String.prototype.getDecimals = function() {
    var a = this,
        b = ("" + a).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
    return b ? Math.max(0, (b[1] ? b[1].length : 0) - (b[2] ? +b[2] : 0)) : 0
}), jQuery(document).ready(function() {
    wcqib_refresh_quantity_increments()
}), jQuery(document).on("updated_wc_div", function() {
    wcqib_refresh_quantity_increments()
}), jQuery(document).on("click", ".plus, .minus", function() {
    var a = jQuery(this).closest(".qty").find(".qty"),
        b = parseFloat(a.val()),
        c = parseFloat(a.attr("max")),
        d = parseFloat(a.attr("min")),
        e = a.attr("step");
    b && "" !== b && "NaN" !== b || (b = 0), "" !== c && "NaN" !== c || (c = ""), "" !== d && "NaN" !== d || (d = 0), "any" !== e && "" !== e && void 0 !== e && "NaN" !== parseFloat(e) || (e = 1), jQuery(this).is(".plus") ? c && b >= c ? a.val(c) : a.val((b + parseFloat(e)).toFixed(e.getDecimals())) : d && b <= d ? a.val(d) : b > 0 && a.val((b - parseFloat(e)).toFixed(e.getDecimals())), a.trigger("change")
});

</script>

@endsection
