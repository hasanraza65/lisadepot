@extends('layout.layout')
@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Services</h1>

<div class="row mt-2 mb-2">
    
@foreach($services as $data)
    <!--- grid card --->
    <div class="col-md-3 mt-4">
        <div class="card" style="width: 18rem;">
            
            @if($data->banner != null && $data->banner != "")
            <img style="max-width: 280px; max-height: 250px; min-width:280px; min-height: 250px;" src="/storage/{{$data->banner}}" class="card-img-top" alt="...">
            @else 
            <img src="/assets/img/amazonservice.png" class="card-img-top" alt="...">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{$data->name}}</h5>
                
                <a href="/purchase-service/create?service={{$data->id}}" class="btn btn-primary">Buy Now</a>
            </div>
        </div>
    </div>
    <!--- grid card ending--->
@endforeach    

</div>

</div>
<!-- /.container-fluid -->

@endsection 