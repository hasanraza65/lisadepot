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

<div class="">
    <form method="POST" action="/purchase-service" enctype="multipart/form-data">
        @csrf

        <div class="">
            @if(isset($_GET['service']))
            <input name="service_id" value="{{$_GET['service']}}" type="hidden" class="form-control">
            @else
            <input name="service_id" value="" type="hidden" class="form-control">
            @endif
        </div>

        <div class="mt-4">
            Choose Plan
            <select onchange="checkPlanType(this)" class="form-control" name="plan" id="plan">
                <option value="DS Free Plan">DS Free Plan</option>
                <option value="Pro DS Plan">Pro DS Plan</option>
                <option value="Hire a VA">Hire a VA</option>
            </select>
        </div>

        <div id="package_2_type" class="mt-4 d-none">
            Choose Plan Type
            <select onchange="setPrice(this)" name="package_2_type" class="form-control">
                <option value="">Choose One</option>
                <option value="monthly">Monthly Charges $1999</option>
                <option value="equity">50% From Equity</option>
            </select>
        </div>

        <div id="package_3_type" class="mt-4 d-none">
            Choose Plan Type
            <select onchange="setPrice(this)" name="package_3_type" class="form-control">
                <option value="">Choose One</option>
                <option value="8_hours">8 Hours a Day ($10 Per Hour)</option>
                <option value="5_hours">5 Hours a Day ($14 Per Hour)</option>
            </select>
        </div>

        <div class="mt-4 pricediv">
            <label id="package_price_label">Price $</label>
            <input value="0" type="text" id="package_price" name="package_price" class="form-control" readonly>
        </div>

        <div class="mt-4">
            <input type="submit" value="Buy Now" class="btn btn-primary">
        </div>

    </form>
</div>




</div>
<!-- /.container-fluid -->

@endsection 