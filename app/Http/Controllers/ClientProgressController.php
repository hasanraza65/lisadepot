<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientProgress;
use App\Models\User;
use App\Models\ClientAccount;

class ClientProgressController extends Controller
{
    public function index(Request $request){
        
        $isfilter = $request->isfilter;
        $userid = $request->user_id;
        $accountid = $request->account_id;
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        if($isfilter != "true"){
        $progress = ClientProgress::all();
        }else{
            if($userid == "" && $accountid == "" && $start_date == "" && $end_date == ""){
            $progress = ClientProgress::all();
            }elseif($userid != "" && $accountid == "" && $start_date == "" && $end_date == ""){
            $progress = ClientProgress::where('user_id', $userid)
            ->get();
            }elseif($accountid != "" && $userid == "" && $start_date == "" && $end_date == ""){
            $progress = ClientProgress::where('user_id', $userid)
            ->where('account_id', $accountid)
            ->get();
            }elseif($start_date != "" && $userid == "" && $accountid == "" && $end_date == ""){
            $progress = ClientProgress::whereDate('date', '>=', $start_date)
            ->get();
            }elseif($end_date != "" && $userid == "" && $accountid == "" && $start_date == ""){
            $progress = ClientProgress::whereDate('date', '<=', $end_date)
            ->get(); 
            }elseif($userid != "" && $accountid != "" && $start_date == "" && $end_date == ""){
            $progress = ClientProgress::where('user_id', $userid)
            ->where('account_id', $accountid)
            ->get();   
            }elseif($userid != "" && $start_date != "" && $end_date == "" && $accountid == ""){
            $progress = ClientProgress::where('user_id', $userid)
            ->whereDate('date', '>=', $start_date)
            ->get();   
            }elseif($userid != "" && $end_date != "" && $accountid == "" && $start_date == ""){
            $progress = ClientProgress::where('user_id', $userid)
            ->whereDate('date', '<=', $end_date)
            ->get();   
            }elseif($userid != "" && $accountid != "" && $start_date != "" && $end_date == ""){
            $progress = ClientProgress::where('user_id', $userid)
            ->where('account_id', $accountid)
            ->whereDate('date', '>=', $start_date)
            ->get();   
            }elseif($userid != "" && $accountid != "" && $end_date != "" && $start_date == ""){
            $progress = ClientProgress::where('user_id', $userid)
            ->where('account_id', $accountid)
            ->whereDate('date', '<=', $end_date)
            ->get();     
            }elseif($userid != "" && $accountid != "" && $start_date != "" && $end_date != ""){
            $progress = ClientProgress::where('user_id', $userid)
            ->where('account_id', $accountid)
            ->whereBetween('date', [$start_date,$end_date])
            ->get();
            }elseif($userid != "" && $start_date != "" && $end_date != "" && $accountid == ""){
            $progress = ClientProgress::where('user_id', $userid)
            ->whereBetween('date', [$start_date,$end_date])
            ->get();
            }
        }

        $users = User::where('user_role',2)->get();
        $accounts = ClientAccount::all();

        return view('admin.progress.index',compact(['progress','users','accounts']));
    }
    public function filterProgress(Request $request){
        $user_id=$request->user_id();
        //$account_id=$_POST['account_id'];
        //$start_date=$_POST['start_date'];
        //$end_date=$_POST['end_date'];

        $progress = ClientProgress::where('user_id',$user_id)
                                     ->where('user_id',$user_id)
                                     ->orWhere('account_id',$account_id)
                                     ->orWhere('date','>',$start_date)
                                     ->orWhere('date','<',$end_date)
                                     ->get();

        $users = User::where('user_role',2)->get();

        $accounts = ClientAccount::all();

        dd($progress);

        return view('admin.progress.index',compact(['progress','users','accounts']));
    }

    public function create(){

        $users = User::where('user_role',2)->get();

        return view('admin.progress.add',compact(['users']));
    }

    public function store(Request $request)
    {

        $clientprogress = ClientProgress::create($request->except(['_token']));

        $message = "Client Progress created successfully";
        return back()->withMessage($message);
    }
    public function edit(ClientProgress $clientprogress)
    {
        
        $clientprogress = ClientProgress::find($clientprogress);

        return view('admin.progress.edit',compact(['clientprogress']));
    }
    public function update(Request $request, ClientProgress $clientprogress)
    {
        $clientprogress->update($request->except(['_token']));
        
        $message = "Progress Updated successfully";
        return back()->withMessage($message);
    }


    public function destroy($id)
    {
        $clientprogress = ClientProgress::find($id);

        $clientprogress->delete(); 

        $message = "Client Progress Has Been Deleted";
        return back()->withMessage($message);
    }
}
