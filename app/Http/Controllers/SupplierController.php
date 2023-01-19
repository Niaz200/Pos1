<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
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

    //new supplier form view
    public function index()
    {
        return view('add_supplier');
    }

    public function SupplierStore(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:suppliers|max:255',
            'phone' => 'required|unique:suppliers|max:255',
            'address' => 'required',
            'photo' => 'required',
            'city' => 'required',
            'accountnumber' => 'required|unique:suppliers|max:255',

        ]);

        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['address']=$request->address;
        $data['shop']=$request->shop;
        $data['accountholder']=$request->accountholder;
        $data['accountnumber']=$request->accountnumber;
        $data['bankname']=$request->bankname;
        $data['branchname']=$request->branchname;
        $data['city']=$request->city;
        $data['type']=$request->type;

        $image = $request->file('photo');

        if($image){
            $image_name = str_random(5);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/supplier/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if ($success){
                $data['photo']=$image_url;
                $supplier=DB::table('suppliers')
                    ->insert($data);


                if ($supplier){
                    $notification=array(
                        'messege'=>'Successfully Supplier Inserted',
                        'alert-type'=>'success'
                    );
                    return Redirect()->route('all.supplier')->with($notification);

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

    public function AllSupplier()
    {
        $supplier=DB::table('suppliers')->get();
        return view('all_supplier', compact('supplier'));
    }

    //single supplier data view
    public function ViewSupplier($id)
    {
//        $supplier=Supplier::findorfail($id)->get();

        $supplier=DB::table('suppliers')
            ->where('id',$id)
            ->first();

        return view('view_supplier', compact('supplier'));

    }

    public function DeleteSupplier($id)
    {

        $delete=DB::table('suppliers')
            ->where('id',$id)
            ->first();
        $photo=$delete->photo;
        unlink($photo);
        $dltuser=DB::table('suppliers')
            ->where('id',$id)
            ->delete();
        if ($dltuser){
            $notification=array(
                'messege'=>'Successfully Supplier Deleted',
                'alert-type'=>'success'
            );
            return Redirect()->route('all.supplier')->with($notification);

        }else{
            $notification=array(
                'messege'=> 'error',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function EditSupplier($id)
    {
        $sup=DB::table('suppliers')->where('id',$id)->first();
        return view('edit_supplier', compact('sup'));
    }


    public function UpdateSupplier(Request $request, $id)
    {

        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|max:255',
            'address' => 'required',
            'city' => 'required',
            'accountnumber' => 'required|max:255',

        ]);

        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['address']=$request->address;
        $data['shop']=$request->shop;
        $data['accountholder']=$request->accountholder;
        $data['accountnumber']=$request->accountnumber;
        $data['bankname']=$request->bankname;
        $data['branchname']=$request->branchname;
        $data['city']=$request->city;
        $data['type']=$request->type;

        $image = $request->photo;

        if ($image) {
            $image_name = str_random(5);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'public/supplier/';
            $image_url = $upload_path . $image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            if ($success) {
                $data['photo'] = $image_url;
                $img = DB::table('suppliers')->where('id', $id)->first();
                $image_path = $img->photo;
                $done = unlink($image_path);
                $user = DB::table('suppliers')->where('id', $id)->update($data);

                if ($user) {
                    $notification = array(
                        'messege' => ' Supplier Update Successfully',
                        'alert-type' => 'success'
                    );
                    return Redirect()->route('all.supplier')->with($notification);
                } else {
                    return Redirect()->back();
                }
            }

        }else{
            $oldphoto = $request->old_photo;
            if ($oldphoto) {
                $data['photo'] = $oldphoto;
                $user = DB::table('suppliers')->where('id', $id)->update($data);
                if ($user) {
                    $notification = array(
                        'messege' => ' Supplier Update Successfully',
                        'alert-type' => 'success'
                    );
                    return Redirect()->route('all.supplier')->with($notification);
                } else {
                    return Redirect()->back();
                }
            }

        }

    }


}
