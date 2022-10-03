@extends('layout.layout')
@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Services</h1>

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
            <th>User</th>
            <th>Account Id</th>
            <th>Total Sales</th>
            <th>Total Profit</th>
            <th>Total Loss</th>
            <th>Today Card Charge</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        @foreach($progress as $data)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$data->user_id}}</td>
            <td>{{$data->account_id}}</td>
            <td>{{$data->total_sales}}</td>
            <td>{{$data->total_profit}}</td>
            <td>{{$data->total_loss}}</td>
            <td>${{$data->today_card_charge}}</td>
            <td>
                
                <form onSubmit="return confirm('Are you sure to Delete?')" method="post" action="{{ route('client-progress.destroy',$data->id) }}">

                    <a type="button" href="/client-progress/{{$data->id}}/edit" class="btn btn-primary m-1">Edit</a>

                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete" class="btn btn-danger m-1">
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>




</div>
<!-- /.container-fluid -->

@endsection 