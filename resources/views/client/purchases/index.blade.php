@extends('layout.layout')
@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Purchases</h1>

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        <br>
    @endif

<div class="table-responsive mt-2">
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Plan Type</th>
            <th>Paid Price</th>
            <th>Status</th>
            <th>Date</th>
            <th>Pay Now</th>

        </tr>
        @foreach($clientpurchase as $data)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$data->plan}}</td>
            <td>${{$data->package_price}}</td>
            <td>{{$data->payment_status}}</td>
            <td>{{$data->created_at}}</td>
            <td>
                @if($data->payment_status != 'Paid')
                <a href="/stripe/{{$data->id}}" class="btn btn-primary">Pay Now</a>
                @else 
                Already Paid
                @endif
            </td>
            
        </tr>
        @endforeach
    </table>
</div>




</div>
<!-- /.container-fluid -->

@endsection 