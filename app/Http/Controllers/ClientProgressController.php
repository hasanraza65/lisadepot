<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientProgress;
use App\Models\User;

class ClientProgressController extends Controller
{
    public function index(){

        $progress = ClientProgress::all();

        return view('admin.progress.index',compact(['progress']));
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

    public function destroy($id)
    {
        $clientprogress = ClientProgress::find($id);

        $clientprogress->delete(); 

        $message = "Client Progress Has Been Deleted";
        return back()->withMessage($message);
    }
}
