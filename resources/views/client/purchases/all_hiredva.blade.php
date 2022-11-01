@extends('layout.layout')
@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Hired Virtual Assistants</h1>

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
            @if(Auth::user()->user_role == 1)
            <th>User</th>
            @endif
            <th>Service</th>
            <th>Account</th>
            <th>Quantity</th>
            <th>Per Day Hours</th>
            <th>Per Hour Charges</th>
            <th>Per Day Total Charges (incl. qty)</th>
            <th>Hired Date</th>
            

        </tr>
        @foreach($hiredva as $data)
        <tr>
            <td>{{$loop->iteration}}</td>
            @if(Auth::user()->user_role == 1)
            <td>{{$data->email}}</td>
            @endif
            <td>{{$data->service_name}}</td>
            <td>{{$data->account_name}}</td>
            <td>{{$data->quantity}}</td>
            <td>{{$data->per_day_hours}}</td>
            <td>{{$data->package_price}}</td>
            <td>{{$data->package_price*$data->per_day_hours*$data->quantity}}</td>
            <td>{{$data->created_at}}</td>
            
            
        </tr>
        @endforeach
    </table>
</div>




</div>
<!-- /.container-fluid -->

@endsection 