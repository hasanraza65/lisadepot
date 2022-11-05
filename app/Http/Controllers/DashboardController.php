<?php

namespace App\Http\Controllers;
use DB;
use Auth;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        $userid = Auth::user()->id;
        $userrole = Auth::user()->user_role;
        
        $total_sales = DB::table('client_progress')
        ->where('user_id', $userid)
        ->sum('total_sales');

        $total_profit = DB::table('client_progress')
        ->where('user_id', $userid)
        ->sum('total_profit');

        $total_loss = DB::table('client_progress')
        ->where('user_id', $userid)
        ->sum('total_loss');

        if($userrole == 1){
        $total_accounts = DB::table('client_accounts')
        ->count('id');
        }else{
        $total_accounts = DB::table('client_accounts')
        ->where('user_id', $userid)
        ->count('id');
        }

        $total_users = DB::table('users')
        ->where('user_role','!=',1)
        ->count('id');

        $total_paid_orders = DB::table('client_purchases')
        ->where('payment_status','Paid')
        ->count('id');

        $total_unpaid_orders = DB::table('client_purchases')
        ->where('payment_status','Unpaid')
        ->count('id');

        return view('index',compact(['total_sales','total_profit','total_loss', 'total_accounts', 'total_users', 'total_paid_orders', 'total_unpaid_orders']));

    }
}
