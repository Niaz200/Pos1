<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
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

    public function TakeAttendance()
    {
        $employee=DB::table('employees')->get();
        return view('take_attendance',compact('employee'));

    }


    public function InsertAttendance(Request $request)
    {

        $validated = $request->validate([
            'attendance' => 'required|max:255',

        ]);

        $date=$request->att_date;
        $att_date=DB::table('attendances')->where('att_date',$date)->first();
        if ($att_date){
            $notification=array(
                'messege'=>'Today Attendance already Taken',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }else{

            foreach ($request->user_id as $id)
            {
                $data[]=[
                    "user_id"=>$id,
                    "attendance"=>$request->attendance[$id],
                    "att_date"=>$request->att_date,
                    "att_year"=>$request->att_year,
                    "month"=>$request->month,
                    "edit_date"=>date("d_m_y"),
                ];


            }

            $att=DB::table('attendances')->insert($data);
            if ($att){
                $notification=array(
                    'messege'=>'Successfully Attendance Take',
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


        }








    }


    public function AllAttendance()
    {
        $all_att=DB::table('attendances')->select('edit_date')->groupBy('edit_date')->get();

        return view('all_attendance',compact('all_att'));

    }

    public function EditAttendance($edit_date)
    {
        $date=DB::table('attendances')->where('edit_date',$edit_date)->first();
        $data=DB::table('attendances')->join('employees','attendances.user_id','employees.id')
                ->select('employees.name','employees.photo','attendances.*')
                ->where('edit_date',$edit_date)->get();
        return view('edit_attendance',compact('data','date'));

    }


    public function UpdateAttendance(Request $request)
    {
        foreach ($request->id as $id){

            $data=[
                "attendance"=>$request->attendance[$id],
                "att_date"=>$request->att_date,
                "att_year"=>$request->att_year,
                "month"=>$request->month

            ];

            $attendance=Attendance::where(['att_date' =>$request->att_date,'id'=>$id])->first();
            $attendance->update($data);



        }

        if ($attendance){
            $notification=array(
                'messege'=>'Successfully Attendance Updated',
                'alert-type'=>'success'
            );
            return Redirect()->route('all.attendance')->with($notification);

        }else{
            $notification=array(
                'messege'=> 'error',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }


    }


    public function ViewAttendance($edit_date)
    {
        $date=DB::table('attendances')->where('edit_date',$edit_date)->first();
        $data=DB::table('attendances')->join('employees','attendances.user_id','employees.id')
            ->select('employees.name','employees.photo','attendances.*')
            ->where('edit_date',$edit_date)->get();
        return view('view_attendance',compact('data','date'));

    }


    public function Setting()
    {



        $setting=DB::table('settings')->first();
        return view('setting',compact('setting'));
    }


    public function UpdateWebsite(Request $request, $id)
    {
        $validateData = $request->validate([
            'company_name' => 'required|max:255',
            'company_address' => 'required|max:255',
            'company_email' => 'required|max:255',
            'company_phone' => 'required',

            'company_mobile' => 'required',
            'company_city' => 'required|max:30',
            'company_country' => 'required',
            'company_zipcode' => 'required',

        ]);

        $data=array();
        $data['company_name']=$request->company_name;
        $data['company_address']=$request->company_address;
        $data['company_email']=$request->company_email;
        $data['company_phone']=$request->company_phone;
        $data['company_mobile']=$request->company_mobile;
        $data['company_city']=$request->company_city;
        $data['company_country']=$request->company_country;
        $data['company_zipcode']=$request->company_zipcode;

        $image = $request->company_logo;

        if ($image) {
            $image_name = str_random(5);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'public/company/';
            $image_url = $upload_path . $image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            if ($success) {
                $data['company_logo'] = $image_url;
                $img = DB::table('settings')->where('id', $id)->first();
                $image_path = $img->company_logo;
                $done = unlink($image_path);
                $company = DB::table('settings')->where('id', $id)->update($data);

                if ($company) {
                    $notification = array(
                        'messege' => ' Information Update Successfully',
                        'alert-type' => 'success'
                    );
                    return Redirect()->back()->with($notification);
                } else {
                    return Redirect()->back();
                }
            }

        }else{
            $oldphoto = $request->old_photo;
            if ($oldphoto) {
                $data['company_logo'] = $oldphoto;
                $comp = DB::table('settings')->where('id', $id)->update($data);
                if ($comp) {
                    $notification = array(
                        'messege' => ' Information Update Successfully',
                        'alert-type' => 'success'
                    );
                    return Redirect()->back()->with($notification);
                } else {
                    return Redirect()->back();
                }
            }

        }

    }



}
