<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class StockController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function StockReport()
    {
//        $allData = Product::orderBy('sup_id','asc')->orderBy('cat_id','asc')->get();
//        return view('stock_report',compact('allData'));

        $allData=DB::table('products')
            ->join('categories','products.cat_id','categories.id')
            ->join('suppliers','products.sup_id','suppliers.id')
            ->select('categories.cat_name','products.*','suppliers.shop')
            ->orderBy('cat_id','asc')
            ->orderBy('sup_id','asc')
            ->get();
        return view('stock_report',compact('allData'));
    }


    public function StockReportPdf()
    {
        $data['allData'] = DB::table('products')
            ->join('categories','products.cat_id','categories.id')
            ->join('suppliers','products.sup_id','suppliers.id')
            ->select('categories.cat_name','products.*','suppliers.shop')
            ->orderBy('cat_id','asc')
            ->orderBy('sup_id','asc')
            ->get();




//        $pdf=PDF::loadView('stock_report_pdf', $data);
////        $pdf->SetProtection(['copy','print'], '', 'pass');
//        return $pdf->stream('document.pdf');


        $pdf = PDF::loadView('stock_pdf', $data);

        return $pdf->download('tutsmake.pdf');

    }


    //to get product using ajax
    public function getProduct(Request $request){
        $category_id= $request->cat_id;

        $allProduct=DB::table('products')
            ->join('categories','products.cat_id','categories.id')
            ->select('categories.id','products.*')
            ->where('cat_id',$category_id)
            ->get();
        return response()->json($allProduct);

    }


    public function SupplierProductWise()
    {
//        $validated = $request->validate([
//            'sup_id' => 'required|max:255',
//
//        ]);


        $data['sup']=DB::table('suppliers')->get();
        $data['categories']=DB::table('categories')->get();

        return view('supplier_product_wise_report',$data);

    }

    public function SupplierWisePdf(Request $request)
    {
        $data['allData'] = DB::table('products')
            ->join('categories','products.cat_id','categories.id')
            ->join('suppliers','products.sup_id','suppliers.id')
            ->select('categories.cat_name','products.*','suppliers.shop')
            ->orderBy('cat_id','asc')
            ->orderBy('sup_id','asc')
            ->where('sup_id',$request->sup_id)
            ->get();



        $pdf = PDF::loadView('supplier_wise_stock_report_pdf', $data);

        return $pdf->download('tutsmake.pdf');


    }


    public function ProductWisePdf(Request $request)
    {

        $data['product'] = DB::table('products')
            ->join('categories','products.cat_id','categories.id')
            ->join('suppliers','products.sup_id','suppliers.id')
            ->select('categories.cat_name','products.*','suppliers.shop')

            ->where('cat_id', $request->cat_id)
            ->where('products.id', $request->product_id)
            ->first();



        $pdf = PDF::loadView('product_wise_stock_report_pdf', $data);

        return $pdf->download('tutsmake.pdf');


    }

}
