@extends('layout.layout')
@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Buy Service</h1>

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        <br>
    @endif


    @php 

    $is_va = 0;
    $is_onetime = 0;
    $is_prods = 0;
    $price = 0;

    @endphp

    @if(isset($_GET['service']))
    
    @foreach($service as $services)

    @php 

    $is_va = $services->is_va;
    $is_onetime = $services->is_onetime;
    $is_prods = $services->is_prods;
    if($services->price != "" && $services->price != null){
    $price = $services->price;
    }

    @endphp 

    @endforeach
    
    @endif

<div class="">
    <form method="POST" action="/purchase-service" enctype="multipart/form-data">
        @csrf

        <div class="">
            @if(isset($_GET['service']))
            <input name="service_id" value="{{$_GET['service']}}" type="hidden" class="form-control">
            @else
            Choose Service
            <select class="form-control" name="service_id" required>
                Choose Service
                <option value="" selected>Choose One...</option>
                @foreach($service as $services)
                <option value="{{$services->id}}">{{$services->name}}</option>
                @endforeach
            </select>
            @endif
        </div>

        <div class="mt-4">
            Choose Account
            <select class="form-control" name="account_id" required>
                <option value="" selected>Choose One...</option>
                @foreach($accounts as $accountss)
                <option value="{{$accountss->id}}">{{$accountss->account_name}}</option>
                @endforeach
            </select>
        </div>

        @if($is_onetime == 0)
        <div class="mt-4">
            Choose Plan
            <select onchange="checkPlanType(this)" class="form-control" name="plan" id="plan" required>
                <option value="" selected>Choose One...</option>
                <option value="DS Free Plan">DS Free Plan</option>
                @if($is_prods == 1)
                <option value="Pro DS Plan">Pro DS Plan</option>
                @endif
            </select>
        </div>
        @endif

        <div id="package_2_type" class="mt-4 d-none">
            Choose Plan Type
            <select onchange="setPrice(this)" name="package_2_type" class="form-control">
                <option value="">Choose One</option>
                <option value="monthly">Monthly Charges $1999</option>
                <option value="equity">50% From Equity</option>
            </select>
        </div>


        <div class="mt-4 pricediv">
            <label id="package_price_label">Price $</label>
            <input value="{{$price}}" type="text" id="package_price" name="package_price" class="form-control" readonly>
        </div>

        <div class="mt-4">
            <input type="submit" value="Buy Now" class="btn btn-primary">
        </div>

    </form>
</div>




</div>
<!-- /.container-fluid -->

@endsection 