@extends('layout.layout')
@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Edit Service</h1>

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        <br>
    @endif

<div class="">
    @foreach($service as $data)
    <form method="POST" action="/service/{{$data->id}}" enctype="multipart/form-data">
    @method('PUT')
    @csrf

        <div class="">
            Service Name
            <input name="name" value="{{$data->name}}" type="text" placeholder="Enter Service Name" class="form-control">
        </div>

        <div class="mt-4">
            Service Banner (Recommended: 350*250 px)
            <input name="file" style="height:auto" class="form-control" type="file" id="formFile">

            @if($data->banner != "" && $data->banner != null)
                <img src="/storage/{{$data->banner}}" class="mt-2 mb-2" width="80" height="auto">
                <input type="hidden" value="{{$data->banner}}" name="oldfile">
            @endif

        </div>

        <div class="mt-4">
            <div class="form-check">
                <input type="hidden" name="is_onetime" value="0">
                @if($data->is_onetime == 1)
                <input onchange="isOneTime()" class="form-check-input" name="is_onetime" type="checkbox" value="1" id="is_onetime" checked>
                @else
                <input onchange="isOneTime()" class="form-check-input" name="is_onetime" type="checkbox" value="1" id="is_onetime">
                @endif
                <label class="form-check-label" for="is_onetime">
                    One Time Charges
                </label>
            </div>
            <div class="form-check">
                <input type="hidden" name="is_prods" value="0">
                <input class="form-check-input" name="is_prods" type="checkbox" value="1" id="is_prods">
                <label class="form-check-label" for="is_prods">
                    Pro DS Plan
                </label>
            </div>
            <div class="form-check">
                <input type="hidden" name="is_va" value="0">
                <input class="form-check-input" name="is_va" type="checkbox" value="1" id="is_va">
                <label class="form-check-label" for="is_va">
                    VA
                </label>
            </div>
        </div>

        @if($data->is_onetime == 1)
        <div id="pricediv" class="mt-4">
        @else 
        <div id="pricediv" class="mt-4 d-none">
        @endif    
            Price
            <input value="{{$data->price}}" name="price" class="form-control" type="float" id="price" placeholder="Enter Price">
        </div>

        <div class="mt-4">
            <input type="submit" class="btn btn-primary">
        </div>

    </form>
    @endforeach
</div>




</div>
<!-- /.container-fluid -->

@endsection 