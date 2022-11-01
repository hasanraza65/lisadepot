<?php

namespace App\Http\Controllers;

use App\Models\ClientAccount;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class ClientAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){

        $this->middleware('auth');
        
    }

    public function index()
    {    if(Auth::user()->user_role==1){
        $accounts = ClientAccount::all();


        }else{
        $accounts = ClientAccount::where('user_id', Auth::user()->id)->get();


        }

        return view('client.account.index',compact(['accounts']));
    }
    public function ClientAccounts()
    {  
        $id=$_GET['id'];
        $accounts = ClientAccount::where('user_id',$id)->get();


        return $accounts;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $clients = User::where('user_role','!=',1)->get();

        return view('client.account.add', compact(['clients']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ClientAccount::create($request->except(['_token']));

        $message = "Account created successfully";
        return back()->withMessage($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClientAccount  $clientAccount
     * @return \Illuminate\Http\Response
     */
    public function show(ClientAccount $clientAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClientAccount  $clientAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientAccount $clientAccount)
    {
        

        return view('client.account.edit',compact(['clientAccount']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClientAccount  $clientAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientAccount $clientAccount)
    {
        $clientAccount->update($request->except(['_token']));
        
        $message = "Account Updated successfully";
        return back()->withMessage($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClientAccount  $clientAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientAccount $clientAccount)
    {
        $clientAccount->delete();
        $message = "Account Deleted successfully";
        return back()->withMessage($message);
    }
}
