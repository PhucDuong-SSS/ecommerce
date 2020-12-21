<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function getTodayOrder(){
        $today = date('d-m-y');
        $orders = DB::table('orders')->where('status',0)->where('date',$today)->get();
        return view('admin.report.todayOrder',compact('orders'));

    }

    public function getTodayDelivery(){
        $today = date('d-m-y');
        $orders = DB::table('orders')->where('status',3)->where('date',$today)->get();
        return view('admin.report.todayDelivery',compact('orders'));
    }

    public function getThisMonthDelivery(){
        $month = date('F');
        $orders = DB::table('orders')->where('status',3)->where('month',$month)->get();
        return view('admin.report.thismonthDelivery',compact('orders'));
    }



    public function searchReport(){

        return view('admin.report.searchReport');
    }


    public function searchByYear(Request $request){

        $year = $request->year;

        $total = DB::table('orders')->where('status',3)->where('year',$year)->sum('total');

        $orders = DB::table('orders')->where('status',3)->where('year',$year)->get();
        return view('admin.report.searchByYear',compact('orders','total'));


    }


    public function searchByMonth(Request $request){

        $month = $request->month;

        $total = DB::table('orders')->where('status',3)->where('month',$month)->sum('total');

        $orders= DB::table('orders')->where('status',3)->where('month',$month)->get();
        return view('admin.report.searchByMonth',compact('orders','total'));


    }


    public function searchByDate(Request $request){

        $date = $request->date;
        $newdate = date('d-m-y',strtotime($date));

        $total = DB::table('orders')->where('status',3)->where('date',$newdate)->sum('total');

        $orders = DB::table('orders')->where('status',3)->where('date',$newdate)->get();
        return view('admin.report.searchByDate',compact('orders','total'));

    }

}
