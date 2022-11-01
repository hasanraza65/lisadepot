@extends('layout.layout')
@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Hire Virtual Assistance</h1>

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        <br>
    @endif

<div class="">
    <form method="POST" action="/purchase-service" enctype="multipart/form-data">
        @csrf

        <div class="mt-4">
            Choose Service
            <select class="form-control" name="service_id">
                <option>Choose One...</option>
                @foreach($services as $servicess)
                <option value="{{$servicess->id}}">{{$servicess->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="mt-4">
            Choose Account
            <select class="form-control" name="account_id">
                <option>Choose One...</option>
                @foreach($accounts as $acountss)
                <option value="{{$acountss->id}}">{{$acountss->account_name}}</option>
                @endforeach
            </select>
        </div>

        <div id="package_3_type" class="mt-4">
            Enter Numbers of Assistance (Total Quantity)
            <input min="1" name="quantity" value="1" type="number" class="form-control">
        </div>

        <div id="package_3_type" class="mt-4">
            Enter Hours
            <input min="1"  name="per_day_hours" id="hours" type="number" class="form-control" onchange="setPricePerHour()">
        </div>

        <div class="mt-4 pricediv">
            <label id="package_price_label">Price $</label>
            <input value="0" type="text" id="package_price" name="package_price" class="form-control" readonly>
        </div>

        <div class="mt-4">
            <input type="hidden" name="plan" value="Hire a VA">
            <input type="submit" value="Hire Now" class="btn btn-primary">
        </div>

    </form>
</div>




</div>
<!-- /.container-fluid -->

@endsection 