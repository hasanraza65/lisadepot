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
            <th>Buyer</th>
            <th>Price</th>
            <th>Payment Status</th>
            <th>Date</th>
            <th>Action</th>

        </tr>
        @foreach($clientpurchase as $data)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$data->plan}}</td>
            <td>{{$data->email}}</td>
            <td>${{$data->package_price}}</td>
            <td>{{$data->payment_status}}</td>
            <td>{{$data->created_at}}</td>
            <td>
                <form onSubmit="return confirm('Are you sure to Delete?')" method="post" action="{{ route('purchase-service.destroy',$data->id) }}">

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