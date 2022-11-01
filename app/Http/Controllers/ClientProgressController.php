<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientProgress;
use App\Models\User;
use App\Models\ClientAccount;
use Auth;

class ClientProgressController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
        
    }

    public function index(Request $request){
        
        $isfilter = $request->isfilter;
        $userid = $request->user_id;
        $accountid = $request->account_id;
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        if($isfilter != "true"){

                if(Auth::user()->user_role == 1){    
                    $progress = ClientProgress::join('users', 'users.id', 'client_progress.user_id')
                    ->get();
                }else{
                    $progress = ClientProgress::join('users', 'users.id', 'client_progress.user_id')
                    ->where('user_id', Auth::user()->id)
                    ->get();
                }

        }else{
            if($userid == "" && $accountid == "" && $start_date == "" && $end_date == ""){

                if(Auth::user()->user_role == 1){    
                    $progress = ClientProgress::join('users', 'users.id', 'client_progress.user_id')
                    ->get();
                }else{
                    $progress = ClientProgress::join('users', 'users.id', 'client_progress.user_id')
                    ->where('user_id', Auth::user()->id)
                    ->get();
                }
            
            }elseif($userid != "" && $accountid == "" && $start_date == "" && $end_date == ""){
                
                if(Auth::user()->user_role == 1){ 
                    $progress = ClientProgress::join('users', 'users.id', 'client_progress.user_id')
                    ->where('user_id', $userid)
                    ->get();
                }else{
                    $progress = ClientProgress::join('users', 'users.id', 'client_progress.user_id')
                    ->where('user_id', Auth::user()->id)
                    ->get();
                }

            }elseif($accountid != "" && $userid == "" && $start_date == "" && $end_date == ""){
                
                if(Auth::user()->user_role == 1){ 
                    $progress = ClientProgress::join('users', 'users.id', 'client_progress.user_id')
                    ->where('user_id', $userid)
                    ->where('account_id', $accountid)
                    ->get();
                }else{
                    $progress = ClientProgress::join('users', 'users.id', 'client_progress.user_id')
                    ->where('user_id', Auth::user()->id)
                    ->where('account_id', $accountid)
                    ->get();
                }

            }elseif($start_date != "" && $userid == "" && $accountid == "" && $end_date == ""){

                if(Auth::user()->user_role == 1){ 
                    $progress = ClientProgress::join('users', 'users.id', 'client_progress.user_id')
                    ->whereDate('date', '>=', $start_date)
                    ->get();
                }else{
                    $progress = ClientProgress::join('users', 'users.id', 'client_progress.user_id')
                    ->whereDate('date', '>=', $start_date)
                    ->where('user_id', Auth::user()->id)
                    ->get();
                }

            }elseif($end_date != "" && $userid == "" && $accountid == "" && $start_date == ""){

                if(Auth::user()->user_role == 1){ 
                    $progress = ClientProgress::join('users', 'users.id', 'client_progress.user_id')
                    ->whereDate('date', '<=', $end_date)
                    ->get(); 
                }else{
                    $progress = ClientProgress::join('users', 'users.id', 'client_progress.user_id')
                    ->whereDate('date', '<=', $end_date)
                    ->where('user_id', Auth::user()->id)
                    ->get(); 
                }

            }elseif($userid != "" && $accountid != "" && $start_date == "" && $end_date == ""){

                if(Auth::user()->user_role == 1){ 
                    $progress = ClientProgress::join('users', 'users.id', 'client_progress.user_id')
                    ->where('user_id', $userid)
                    ->where('account_id', $accountid)
                    ->get();
                }else{
                    $progress = ClientProgress::join('users', 'users.id', 'client_progress.user_id')

                    ->where('account_id', $accountid)
                    ->where('user_id', Auth::user()->id)
                    ->get();
                }

            }elseif($userid == "" && $accountid != "" && $start_date != "" && $end_date == ""){

                if(Auth::user()->user_role == 1){ 
                    $progress = ClientProgress::join('users', 'users.id', 'client_progress.user_id')
                    ->whereDate('date', '>=', $start_date)
                    ->where('account_id', $accountid)
                    ->get();
                }else{
                    $progress = ClientProgress::join('users', 'users.id', 'client_progress.user_id')

                    ->where('account_id', $accountid)
                    ->whereDate('date', '>=', $start_date)
                    ->where('user_id', Auth::user()->id)
                    ->get();
                }

            }elseif($userid == "" && $accountid != "" && $start_date != "" && $end_date != ""){

                if(Auth::user()->user_role == 1){ 
                    $progress = ClientProgress::join('users', 'users.id', 'client_progress.user_id')
                    ->whereDate('date', '>=', $start_date)
                    ->whereDate('date', '<=', $end_date)
                    ->where('account_id', $accountid)
                    ->get();
                }else{
                    $progress = ClientProgress::join('users', 'users.id', 'client_progress.user_id')

                    ->where('account_id', $accountid)
                    ->whereDate('date', '>=', $start_date)
                    ->whereDate('date', '<=', $end_date)
                    ->where('user_id', Auth::user()->id)
                    ->get();
                }

            }elseif($userid != "" && $start_date != "" && $end_date == "" && $accountid == ""){

                if(Auth::user()->user_role == 1){ 
                    $progress = ClientProgress::join('users', 'users.id', 'client_progress.user_id')
                    ->where('user_id', $userid)
                    ->whereDate('date', '>=', $start_date)
                    
                    ->get();
                }else{
                    $progress = ClientProgress::join('users', 'users.id', 'client_progress.user_id')
   
                    ->whereDate('date', '>=', $start_date)
                    ->where('user_id', Auth::user()->id)
                    ->get();
                }

            }elseif($userid != "" && $end_date != "" && $accountid == "" && $start_date == ""){

                if(Auth::user()->user_role == 1){ 
                    $progress = ClientProgress::join('users', 'users.id', 'client_progress.user_id')
                    ->where('user_id', $userid)
                    ->whereDate('date', '<=', $end_date)
                    ->get();
                }else{
                    $progress = ClientProgress::join('users', 'users.id', 'client_progress.user_id')

                    ->whereDate('date', '<=', $end_date)
                    ->where('user_id', Auth::user()->id)
                    ->get();
                }

            }elseif($userid != "" && $accountid != "" && $start_date != "" && $end_date == ""){

                if(Auth::user()->user_role == 1){ 
                    $progress = ClientProgress::join('users', 'users.id', 'client_progress.user_id')
                    ->where('user_id', $userid)
                    ->where('account_id', $accountid)
                    ->whereDate('date', '>=', $start_date)
                    ->get();   
                }else{
                    $progress = ClientProgress::join('users', 'users.id', 'client_progress.user_id')

                    ->where('account_id', $accountid)
                    ->whereDate('date', '>=', $start_date)
                    ->where('user_id', Auth::user()->id)
                    ->get(); 
                }

            }elseif($userid != "" && $accountid != "" && $end_date != "" && $start_date == ""){

                if(Auth::user()->user_role == 1){ 
                    $progress = ClientProgress::join('users', 'users.id', 'client_progress.user_id')
                    ->where('user_id', $userid)
                    ->where('account_id', $accountid)
                    ->whereDate('date', '<=', $end_date)
                    ->get();  
                }else{
                    $progress = ClientProgress::join('users', 'users.id', 'client_progress.user_id')

                    ->where('account_id', $accountid)
                    ->whereDate('date', '<=', $end_date)
                    ->where('user_id', Auth::user()->id)
                    ->get(); 
                }   

            }elseif($userid != "" && $accountid != "" && $start_date != "" && $end_date != ""){

                if(Auth::user()->user_role == 1){ 
                    $progress = ClientProgress::join('users', 'users.id', 'client_progress.user_id')
                    ->where('user_id', $userid)
                    ->where('account_id', $accountid)
                    ->whereBetween('date', [$start_date,$end_date])
                    ->get();
                }else{
                    $progress = ClientProgress::join('users', 'users.id', 'client_progress.user_id')

                    ->where('account_id', $accountid)
                    ->whereBetween('date', [$start_date,$end_date])
                    ->where('user_id', Auth::user()->id)
                    ->get();
                }

            }elseif($userid != "" && $start_date != "" && $end_date != "" && $accountid == ""){

                if(Auth::user()->user_role == 1){
                    $progress = ClientProgress::join('users', 'users.id', 'client_progress.user_id')
                    ->where('user_id', $userid)
                    ->whereBetween('date', [$start_date,$end_date])
                    ->get();
                }else{
                    $progress = ClientProgress::join('users', 'users.id', 'client_progress.user_id')
                    ->whereBetween('date', [$start_date,$end_date])
                    ->where('user_id', Auth::user()->id)
                    ->get();
                }

            }
        }

        $users = User::where('user_role',2)->get();

        if(Auth::user()->user_role == 1){

        $accounts = ClientAccount::all();

        }else{

        $accounts = ClientAccount::where('user_id', Auth::user()->id)->get();    

        }

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
    public function edit($id)
    {
        
        $clientprogress = ClientProgress::where('id',$id)->get();

        return view('admin.progress.edit',compact(['clientprogress']));
    }
    public function update(Request $request, $id)
    {
        $clientprogress = ClientProgress::find($id);

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
