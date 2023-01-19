<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaryController extends Controller
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


    public function AddAdvancedSalary()
    {
        return view('advanced_salary');

    }

    public function InsertAdvanced(Request $request)
    {
        $month=$request->month;
        $emp_id=$request->emp_id;
        $year=$request->year;

        $advanced=DB::table('advanced_salaries')
                ->where('month',$month)
                ->where('emp_id',$emp_id)
                ->where('year', $year)
                ->first();

        if ($advanced === NULL){

            $data=array();
            $data['emp_id']=$request->emp_id;
            $data['month']=$request->month;
            $data['advanced_salary']=$request->advanced_salary;
            $data['year']=$request->year;

            $advanced=DB::table('advanced_salaries')->insert($data);

            if ($advanced){
                $notification=array(
                    'messege'=>'Successfully Advanced Paid',
                    'alert-type'=>'success'
                );
                return Redirect()->route('all.advancedsalary')->with($notification);

            }else{
                $notification=array(
                    'messege'=> 'error',
                    'alert-type'=>'success'
                );
                return Redirect()->back()->with($notification);
            }

        }else{
            $notification=array(
                'messege'=> 'Oopss !! Already advanced Paid in this month!',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);

        }



    }

    public function AllSalary()
    {
        $salary=DB::table('advanced_salaries')
                ->join('employees','advanced_salaries.emp_id','employees.id')
                ->select('advanced_salaries.*','employees.name','employees.salary','employees.photo')
                ->orderBy('id','DESC')
                ->get();
        return view('all_advanced_salary', compact('salary'));

    }

    public function PaySalary()
    {
        $employee=DB::table('employees')->get();
        return view('pay_salary', compact('employee'));

    }
}
