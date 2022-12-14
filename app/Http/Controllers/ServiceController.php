<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ClientPurchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;


class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() 
    {
      $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::user()->user_role == 1){
            $services = Service::all();
            return view('admin.services.index',compact(['services']));
        }else{
            $services = ClientPurchase::join('services', 'services.id', 'client_purchases.service_id')
            ->where('user_id', Auth::user()->id)
            ->select('services.*', 'client_purchases.*', 'client_purchases.id as id')
            ->get();
            return view('client.services.index',compact(['services']));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.services.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if(isset($_FILES['file'])){
            if ($_FILES['file']['name']) {
                if (!$_FILES['file']['error']) {
                   
                    $filetestname = request()->file('file');
                    $destination = Storage::disk('public')->put('/images', $filetestname);
                    //echo '/images/' . $filename;
                    
                    $request->merge([
                        'banner'=> $destination,
                    ]);
                
                } else {
                    $request->merge([
                        'banner'=> '',
                    ]);
                    echo 'Ooops!  Your upload triggered the following error:  '.$_FILES['file']['error'];
                }
                
              }

        }

        $service = Service::create($request->except(['_token']));

        $message = "Service created successfully";
        return back()->withMessage($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::where('id',$id)->get();

        return view('admin.services.edit',compact(['service']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //$service = Service::find($service)->update($request->except(['_token']));
        //$service->update($request->except(['_token']));

        if(isset($_FILES['file'])){
            if ($_FILES['file']['name']) {
                if (!$_FILES['file']['error']) {
                   
                    $filetestname = request()->file('file');
                    $destination = Storage::disk('public')->put('/images', $filetestname);
                    //echo '/images/' . $filename;
                    
                    $request->merge([
                        'banner'=> $destination,
                    ]);
                
                } else {
                    $request->merge([
                        'banner'=> $request->oldfile,
                    ]);
                    echo 'Ooops!  Your upload triggered the following error:  '.$_FILES['file']['error'];
                }
                
              }

        }

        Service::where('id',$id)->update($request->except(['_token','_method','oldfile','file']));

        $message = "Service updated successfully";
        return back()->withMessage($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //$service = Service::find($id);
        $service->delete(); 

        $message = "Service Has Been Deleted";
        return back()->withMessage($message);
    }

    public function choosePlan(){
        
    }
}
