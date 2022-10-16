<?php

namespace App\Http\Controllers;

use App\Models\ClientPurchase;
use Illuminate\Http\Request;

class ClientPurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.purchases.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
}
