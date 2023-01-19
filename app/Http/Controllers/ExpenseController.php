<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
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


    public function AddExpense()
    {
        return view('add_expense');

    }


    public function InsertExpense(Request $request)
    {
        $validated = $request->validate([
            'details' => 'required|max:255',
            'amount' => 'required|max:255',

        ]);

        $data=array();
        $data['details']=$request->details;
        $data['amount']=$request->amount;
        $data['date']=$request->date;
        $data['month']=$request->month;
        $data['year']=$request->year;

        $exp=DB::table('expenses')->insert($data);
        if ($exp){
            $notification=array(
                'messege'=>'Successfully Expense Inserted',
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

    public function  TodayExpense()
    {
        $date= date("d/m/y");
        $today=DB::table('expenses')->where('date',$date)->get();

        return view('today_expense', compact('today'));
    }

    public function EditTodayExpense($id)
    {
        $tdy=DB::table('expenses')->where('id',$id)->first();
        return view('edit-today-expense',compact('tdy'));
    }

    public function UpdateExpense(Request $request,$id)
    {
        $validated = $request->validate([
            'details' => 'required|max:255',
            'amount' => 'required|max:255',

        ]);

        $data=array();
        $data['details']=$request->details;
        $data['amount']=$request->amount;
        $data['date']=$request->date;
        $data['month']=$request->month;
        $data['year']=$request->year;

        $exp=DB::table('expenses')->where('id',$id)->update($data);
        if ($exp){
            $notification=array(
                'messege'=>'Successfully Expense Updated',
                'alert-type'=>'success'
            );
            return Redirect()->route('today.expense')->with($notification);

        }else{
            $notification=array(
                'messege'=> 'error',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }

    }

    public function DeleteExpense($id)
    {

        $dlt=DB::table('expenses')->where('id',$id)->delete();

        if ($dlt){
            $notification=array(
                'messege'=>'Successfully TodayExpense Deleted',
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

    public function MonthlyExpense()
    {

        $month= date("F");
        $expense=DB::table('expenses')->where('month',$month)->get();

        return view('monthly_expense', compact('expense'));

    }

    public function YearlyExpense()
    {
        $year= date("Y");
        $yearlyExpense=DB::table('expenses')->where('year',$year)->get();

        return view('yearly_expense', compact('yearlyExpense'));

    }


    //month wise

    public function MonthWiseExpense()
    {

        $month= date("F");
        $expense=DB::table('expenses')->where('month',$month)->get();

        return view('monthWise_expense', compact('expense'));

    }

    public function JanuaryExpense()
    {
        $month= "January";
        $expense=DB::table('expenses')->where('month',$month)->get();

        $total =DB::table('expenses')->where('month',$month)->sum('amount');

        return view('monthWise_expense', compact(['expense','total','month']));

    }

    public function FebruaryExpense()
    {
        $month= "February";
        $expense=DB::table('expenses')->where('month',$month)->get();

        $total =DB::table('expenses')->where('month',$month)->sum('amount');

        return view('monthWise_expense', compact(['expense','total','month']));
    }

    public function MarchExpense()
    {
        $month= "March";
        $expense=DB::table('expenses')->where('month',$month)->get();

        $total =DB::table('expenses')->where('month',$month)->sum('amount');

        return view('monthWise_expense', compact(['expense','total','month']));

    }

    public function AprilExpense()
    {
        $month= "April";
        $expense=DB::table('expenses')->where('month',$month)->get();

        $total =DB::table('expenses')->where('month',$month)->sum('amount');

        return view('monthWise_expense', compact(['expense','total','month']));

    }

    public function MayExpense()
    {
        $month= "May";
        $expense=DB::table('expenses')->where('month',$month)->get();

        $total =DB::table('expenses')->where('month',$month)->sum('amount');

        return view('monthWise_expense', compact(['expense','total','month']));

    }

    public function JuneExpense()
    {
        $month= "June";
        $expense=DB::table('expenses')->where('month',$month)->get();

        $total =DB::table('expenses')->where('month',$month)->sum('amount');

        return view('monthWise_expense', compact(['expense','total','month']));
    }

    public function JulyExpense()
    {
        $month= "July";
        $expense=DB::table('expenses')->where('month',$month)->get();

        $total =DB::table('expenses')->where('month',$month)->sum('amount');

        return view('monthWise_expense', compact(['expense','total','month']));

    }

    public function AugustExpense()
    {
        $month= "August";
        $expense=DB::table('expenses')->where('month',$month)->get();

        $total =DB::table('expenses')->where('month',$month)->sum('amount');

        return view('monthWise_expense', compact(['expense','total','month']));

    }

    public function SeptemberExpense()
    {
        $month= "September";
        $expense=DB::table('expenses')->where('month',$month)->get();
        $total =DB::table('expenses')->where('month',$month)->sum('amount');

        return view('monthWise_expense', compact(['expense','total','month']));

    }

    public function OctoberExpense()
    {
        $month= "October";
        $expense=DB::table('expenses')->where('month',$month)->get();

        $total =DB::table('expenses')->where('month',$month)->sum('amount');

        return view('monthWise_expense', compact(['expense','total','month']));

    }


    public function NovemberExpense()
    {
        $month= "November";
        $expense=DB::table('expenses')->where('month',$month)->get();

        $total =DB::table('expenses')->where('month',$month)->sum('amount');

        return view('monthWise_expense', compact(['expense','total','month']));

    }

    public function DecemberExpense()
    {
        $month= "December";
        $expense=DB::table('expenses')->where('month',$month)->get();

        $total =DB::table('expenses')->where('month',$month)->sum('amount');

        return view('monthWise_expense', compact(['expense','total','month']));

    }

    //month wise method ends

}
