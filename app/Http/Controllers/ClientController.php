<?php

namespace App\Http\Controllers;
use App\Models\Service;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(){

    }

    public function services(){

        $services = SERVICE::all();

        return view('client.services',compact(['services']));
    }
}
