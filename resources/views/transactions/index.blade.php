@extends('layout.layout')
@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Transactions</h1>

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        <br>
    @endif

<div class="table-responsive mt-2">
    <table class="table" id="mydataTable">
        <thead>
        <tr>
            <th>ID</th>
            <th>Transaction Id</th>
            <th>User Email</th>
            <th>Card Last 4</th>
            <th>Status</th>
        </tr>

        </thead>
        <tbody>

        
        @foreach($transactions as $data)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$data->transaction_id}}</td>
            <td>{{$data->email}}</td>
            <td>{{$data->card_last_four}}</td>
            <td>{{$data->status}}</td>
            
        </tr>
        @endforeach
        </tbody>
    </table>
</div>




</div>
<!-- /.container-fluid -->

@endsection 