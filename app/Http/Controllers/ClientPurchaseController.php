<?php

namespace App\Http\Controllers;

use App\Models\ClientPurchase;
use App\Models\ClientAccount;
use App\Models\Service;
use Illuminate\Http\Request;
use Auth;

class ClientPurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->user_role == 1){
        
        $clientpurchase = ClientPurchase::all();

        return view('admin.purchases.index',compact(['clientpurchase']));

        }else{

            $clientpurchase = ClientPurchase::where('user_id', Auth::user()->id)->get();

        return view('client.purchases.index',compact(['clientpurchase']));

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accounts = ClientAccount::where('user_id',Auth::user()->id)->get();
        return view('client.purchases.add',compact(['accounts']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge([
            'user_id'=> Auth::user()->id,
        ]);

        $clientpurchase = ClientPurchase::create($request->except(['_token']));

        $message = "Purchase Done successfully";
        return back()->withMessage($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClientPurchase  $clientPurchase
     * @return \Illuminate\Http\Response
     */
    public function show(ClientPurchase $clientPurchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClientPurchase  $clientPurchase
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientPurchase $clientPurchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClientPurchase  $clientPurchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientPurchase $clientPurchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClientPurchase  $clientPurchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientPurchase $clientPurchase)
    {
        //
    }

    public function viewHireVA(){

        $services = Service::all();

        return view('client.purchases.hireva', compact(['services']));

    }
}
