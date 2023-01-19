@extends('layouts.app')

@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="pull-left page-title">Manage Supplier/Product Wise Stock !</h4>
                        <ol class="breadcrumb pull-right">
                            <li><a href="#">Echobvel</a></li>
                            <li class="active">IT</li>
                        </ol>
                    </div>
                </div>

                <!-- Start Widget -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Select Criteria
{{--                                <a  href="{{ route('stock.report.supplier.wise.pdf') }}" class="btn btn-sm btn-info pull-right" target="_blank"><i class="fa fa-download"></i> Download PDF</a>--}}
                                </h3>
                            </div>



                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-12 text-center">
                                        <strong>Supplier Wise Report</strong>
                                        <input type="radio" name="supplier_product_wise" value="supplier_wise" class="search_value"> &nbsp;&nbsp;


                                        <strong>Product Wise Report</strong>
                                        <input type="radio" name="supplier_product_wise" value="product_wise" class="search_value"> &nbsp;&nbsp;

                                    </div>
                                </div>

                                <!-- for Show supplier -->

                                <div class="show_supplier" style="display: none;">
                                    <form method="GET" action="{{route('stock.report.supplier.wise.pdf')}}" id="SupplierWiseForm" target="_blank">
                                        <div class="form-row">
                                            <div class="col-sm-8">
                                                <label for="sup_id">Supplier Name</label>
                                                <select  name="sup_id" class="form-control select2">
                                                    <option value="">Select Supplier</option>
                                                    @foreach($sup as $row)
                                                        <option value="{{ $row->id }}">{{ $row->shop }}</option>
                                                    @endforeach

                                                </select>

                                            </div>

                                            <div class="col-sm-4" style="padding-top: 26px;">
                                                <button  type="submit" class="btn btn-primary btn-sm">Search</button>

                                            </div>

                                        </div>
                                    </form>

                                </div>



                                <!-- for Show product -->

                                <div class="show_product" style="display: none;">
                                    <form method="GET" action="{{route('stock.report.product.wise.pdf')}}" id="ProductWiseForm" target="_blank">
                                        <div class="form-row">
                                            <div class="col-sm-4">
                                                <label for="">Category Name</label>
                                                <select name="cat_id" id="cat_id" class="form-control select2">
                                                    <option value="">Select Category</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}">{{$category->cat_name}}</option>
                                                    @endforeach

                                                </select>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="">Product Name</label>
                                                <select name="product_id" id="product_id" class="form-control select2">
                                                    <option value="">Select Product</option>
                                                </select>
                                            </div>

                                            <div class="col-sm-2" style="padding-top: 26px;">
                                                <button  type="submit" class="btn btn-primary btn-sm">Search</button>

                                            </div>

                                        </div>
                                    </form>

                                </div>

                            </div>



                        </div>
                    </div>

                </div>

            </div> <!-- container -->

        </div> <!-- content -->

    </div>



    @push('js')



{{--        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>--}}
{{--        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>--}}

    <script>
        $(document).on('change','.search_value',function (){
            var search_value = $(this).val();
            if (search_value == 'supplier_wise'){
                $('.show_supplier').show();
            }else{
                $('.show_supplier').hide();
            }
            if (search_value == 'product_wise'){
                $('.show_product').show();
            }else {
                $('.show_product').hide();
            }
        });
    </script>

// for validation

{{--    <script type="text/javascript">--}}
{{--        $(document).ready(function (){--}}
{{--            $('#SupplierWiseForm').validate({--}}

{{--                        rules: {--}}

{{--                            sup_id: {--}}
{{--                            required:true,--}}


{{--                        }--}}
{{--                    },--}}
{{--                    messages: {--}}

{{--                    },--}}
{{--                errorElement: 'span',--}}
{{--                errorPlacement:function (error,element){--}}
{{--                            error.addClass('invalid-feedback');--}}
{{--                            element.closest('.form-group').append(error);--}}
{{--                },--}}
{{--                highlight: function (element,errorClass, validClass){--}}
{{--                            $(element).addClass('is-invalid');--}}
{{--                },--}}
{{--                unhighlight: function (element,errorClass, validClass){--}}
{{--                    $(element).removeClass('is-invalid');--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}

{{--    </script>--}}

<script type="text/javascript">
    $(document).ready(function (){
        $('#SupplierWiseForm').validate({
            ignore:[],
            errorPlacement: function (error, element){
                if (element.attr("name") == "sup_id")
                {
                    error.insertAfter(element.next());
                }else {
                    error.insertAfter(element);
                }
            },
            errorClass:'text-danger',
            validClass:'text-success',

            rules: {

                sup_id: {
                    required:true,


                }
            },
            messages: {

            },
        });
    });

</script>

<script type="text/javascript">
    $(document).ready(function (){
        $('#ProductWiseForm').validate({
            ignore:[],
            errorPlacement: function (error, element){
                if (element.attr("name") == "cat_id")
                {
                    error.insertAfter(element.next());
                }
                else if (element.attr("name") == "product_id"){ error.insertAfter(element.next());}
                else {
                    error.insertAfter(element);
                }
            },
            errorClass:'text-danger',
            validClass:'text-success',

            rules: {

                cat_id: {
                    required:true,

                },
                product_id: {
                    required:true,

                }
            },
            messages: {

            },
        });
    });

</script>

//for ajax

    <script type="text/javascript">
        $(function(){
            $(document).on('change','#cat_id',function(){
                var cat_id = $(this).val();
                $.ajax({
                    url:"{{route('get-product')}}",
                    type:"GET",
                    data:{cat_id:cat_id},
                    success:function (data){
                        var html = '<option value="">Select Product</option>';
                        $.each(data,function (key,v){
                            html +='<option value="'+v.id+'">'+v.product_name+'</option>';
                        });
                        $('#product_id').html(html);
                    }
                });
            });
        });

    </script>


    @endpush

@endsection
