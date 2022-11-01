<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(){

        if(Auth::user()->user_role == 1){
        $transactions = Transaction::join('users', 'users.id', 'transactions.user_id')
        ->select('users.*', 'transactions.*', 'transactions.id as id')
        ->get();
        }else{
        $transactions = Transaction::join('users', 'users.id', 'transactions.user_id')
        ->where('user_id', Auth::user()->id)
        ->select('users.*', 'transactions.*', 'transactions.id as id')
        ->get();    
        }

        return view('transactions.index', compact(['transactions']));

    }
}
