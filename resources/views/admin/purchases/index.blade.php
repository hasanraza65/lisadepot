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
            <th>Buyer Name</th>
            <th>Price</th>
            <th>Date</th>

        </tr>
        @foreach($clientpurchase as $data)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$data->plan}}</td>
            <td>{{$data->user_id}}</td>
            <td>${{$data->package_price}}</td>
            <td>
                
                <form onSubmit="return confirm('Are you sure to Delete?')" method="post" action="{{ route('purchase-service.destroy',$data->id) }}">

                    <a type="button" href="/service/{{$data->id}}/edit" class="btn btn-primary m-1">Edit</a>

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