<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\If_;

class EmployeeController extends Controller
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

    public function index()
    {
        return view('add_employee');

    }

    //insert employee

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:employees|max:255',
            'nid_no' => 'required|unique:employees|max:255',
            'address' => 'required',
            'phone' => 'required|max:15',
            'photo' => 'required',
            'experience' => 'required',
            'vacation' => 'required',
            'city' => 'required',

        ]);

        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['address']=$request->address;
        $data['experience']=$request->experience;
        $data['nid_no']=$request->nid_no;
        $data['salary']=$request->salary;
        $data['vacation']=$request->vacation;
        $data['city']=$request->city;
        $image = $request->file('photo');



        if($image){
            $image_name = str_random(5);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/employee/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if ($success){
                $data['photo']=$image_url;
                $employee=DB::table('employees')
                    ->insert($data);

                if ($employee){
                    $notification=array(
                        'messege'=>'Successfully Employee Inserted',
                        'alert-type'=>'success'
                    );
                    return Redirect()->route('home')->with($notification);

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

    //all employee
    public function AllEmployee()
    {
        $employees = Employee::all();
//        $employees=DB::table('employees')->get();
        return view('all_employee', compact('employees'));
    }

    //view single employee

    public function ViewEmployee($id)
    {
//        $single=Employee::findorfail();

        $single=DB::table('employees')
            ->where('id',$id)
            ->first();

        return view('view_employee', compact('single'));

    }

    // for delete

    public function DeleteEmployee($id)
    {
        $delete=DB::table('employees')
                ->where('id',$id)
                ->first();
        $photo=$delete->photo;
        unlink($photo);
        $dltuser=DB::table('employees')
                ->where('id',$id)
                ->delete();
        if ($dltuser){
            $notification=array(
                'messege'=>'Successfully Employee Deleted',
                'alert-type'=>'success'
            );
            return Redirect()->route('all.employee')->with($notification);

        }else{
            $notification=array(
                'messege'=> 'error',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }
    }

    //single employee data show for edit

    public function EditEmployee($id)
    {
        $edit=DB::table('employees')
            ->where('id',$id)
            ->first();
        return view('edit_employee', compact('edit'));
    }

//update a single employee
    public function UpdateEmployee(Request $request,$id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'nid_no' => 'required|max:255',
            'address' => 'required',
            'phone' => 'required|max:15',
            'experience' => 'required',
            'vacation' => 'required',
            'city' => 'required',

        ]);

        $data=array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['experience'] = $request->experience;
        $data['nid_no'] = $request->nid_no;
        $data['salary'] = $request->salary;
        $data['vacation'] = $request->vacation;
        $data['city'] = $request->city;

        $image = $request->photo;

        if ($image) {
            $image_name = str_random(5);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'public/employee/';
            $image_url = $upload_path . $image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            if ($success) {
                $data['photo'] = $image_url;
                $img = DB::table('employees')->where('id', $id)->first();
                $image_path = $img->photo;
                $done = unlink($image_path);
                $user = DB::table('employees')->where('id', $id)->update($data);

                if ($user) {
                        $notification = array(
                        'messege' => ' Employee Update Successfully',
                        'alert-type' => 'success'
                    );
                    return Redirect()->route('all.employee')->with($notification);
                } else {
                    return Redirect()->back();
                }
            }

         }else{
        return Redirect()->back();
        }

    }
}
