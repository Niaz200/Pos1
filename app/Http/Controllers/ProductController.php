<?php

namespace App\Http\Controllers;



use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
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



    public function AddProduct()
    {
        return view('add_product');
    }

    public function InsertProduct(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|max:255',
            'cat_id' => 'required|max:255',
            'sup_id' => 'required|max:255',
            'product_code' => 'required|unique:products|max:255',
            'product_garage' => 'required|max:255',
            'product_route' => 'required',
            'product_des' => 'required|max:255',
            'product_image' => 'required',
            'buy_date' => 'required',
            'expire_date' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'quantity' => 'required',

        ]);

        $data=array();
        $data['product_name']=$request->product_name;
        $data['cat_id']=$request->cat_id;
        $data['sup_id']=$request->sup_id;
        $data['product_code']=$request->product_code;
        $data['product_garage']=$request->product_garage;
        $data['product_route']=$request->product_route;
        $data['product_des']=$request->product_des;
        $data['buy_date']=$request->buy_date;
        $data['expire_date']=$request->expire_date;
        $data['buying_price']=$request->buying_price;
        $data['selling_price']=$request->selling_price;
        $data['quantity']=$request->quantity;

        $image = $request->file('product_image');

        if($image){
            $image_name = str_random(5);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/products/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if ($success){
                $data['product_image']=$image_url;
                $product=DB::table('products')
                    ->insert($data);


                if ($product){
                    $notification=array(
                        'messege'=>'Successfully Product Inserted',
                        'alert-type'=>'success'
                    );
                    return Redirect()->back()->with($notification);

                }else{
                    $notification=array(
                        'messege'=> 'error',
                        'alert-type'=>'success'
                    );
                    return Redirect()->back()->with($notification);
                }
            }else{
                return Redirect()->back();
            }
        }else{
            return Redirect()->back();
        }

    }


    public function AllProduct()
    {
        $product=DB::table('products')
                ->join('categories','products.cat_id','categories.id')
                ->select('categories.cat_name','products.*')
                ->get();
        return view('all-product',compact('product'));
    }


    public function DeleteProduct($id)
    {
        $delete=DB::table('products')
            ->where('id',$id)
            ->first();
        $photo=$delete->product_image;
        unlink($photo);
        $dltprod=DB::table('products')
            ->where('id',$id)
            ->delete();
        if ($dltprod){
            $notification=array(
                'messege'=>'Successfully Product Deleted',
                'alert-type'=>'success'
            );
            return Redirect()->route('all.product')->with($notification);

        }else{
            $notification=array(
                'messege'=> 'error',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }

    }


    public function ViewProduct($id)
    {
        $prod=DB::table('products')
            ->join('categories','products.cat_id','categories.id')
            ->join('suppliers','products.sup_id','suppliers.id')
            ->select('categories.cat_name','products.*','suppliers.name')
            ->where('products.id',$id)
            ->first();

        return view('view_product', compact('prod'));

    }


    public function EditProduct($id)
    {
        $prod=DB::table('products')->where('id',$id)->first();
        return view('edit_product', compact('prod'));
    }

    public function UpdateProduct(Request $request,$id)
    {


        $validated = $request->validate([
            'product_name' => 'required|max:255',
            'cat_id' => 'required|max:255',
            'sup_id' => 'required|max:255',
            'product_code' => 'required|max:255',
            'product_garage' => 'required|max:255',
            'product_route' => 'required',
            'product_des' => 'required|max:255',
            'buy_date' => 'required',
            'expire_date' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'quantity' => 'required',



        ]);

        $data=array();
        $data['product_name']=$request->product_name;
        $data['cat_id']=$request->cat_id;
        $data['sup_id']=$request->sup_id;
        $data['product_code']=$request->product_code;
        $data['product_garage']=$request->product_garage;
        $data['product_route']=$request->product_route;
        $data['product_des']=$request->product_des;
        $data['buy_date']=$request->buy_date;
        $data['expire_date']=$request->expire_date;
        $data['buying_price']=$request->buying_price;
        $data['selling_price']=$request->selling_price;
        $data['quantity']=$request->quantity;

        $image = $request->file('product_image');

        if ($image) {
            $image_name = str_random(5);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'public/products/';
            $image_url = $upload_path . $image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            if ($success) {
                $data['product_image'] = $image_url;
                $img = DB::table('products')->where('id', $id)->first();
                $image_path = $img->product_image;
                $done = unlink($image_path);
                $product= DB::table('products')->where('id', $id)->update($data);

                if ($product) {
                    $notification = array(
                        'messege' => ' Product Update Successfully',
                        'alert-type' => 'success'
                    );
                    return Redirect()->route('all.product')->with($notification);
                } else {
                    return Redirect()->back();
                }
            }

        }else{
            $oldphoto = $request->old_photo;
            if ($oldphoto) {
                $data['product_image'] = $oldphoto;
                $user = DB::table('products')->where('id', $id)->update($data);
                if ($user) {
                    $notification = array(
                        'messege' => ' Product Update Successfully',
                        'alert-type' => 'success'
                    );
                    return Redirect()->route('all.product')->with($notification);
                } else {
                    return Redirect()->back();
                }
            }

        }

    }


    //products import and export

        public function ImportProduct()
        {
            return view('import_product');
        }

    public function export()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }


    public function import(Request $request)
    {
        $import= Excel::import(new ProductsImport,request()->file('import_file'));
        if ($import) {
            $notification = array(
                'messege' => ' Product Import Successfully',
                'alert-type' => 'success'
            );
            return Redirect()->route('all.product')->with($notification);
        } else {
            return Redirect()->back();
        }
    }


}
