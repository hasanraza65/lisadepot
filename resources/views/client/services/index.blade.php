@extends('layout.layout')
@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">My Purchased Services</h1>

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
            <th>Service Banner</th>
            <th>Service Name</th>
            <th>Price</th>
            <!---
            <th>Action</th> --->
        </tr>
        @foreach($services as $data)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>
                @if($data->banner != "" && $data->banner != null)
                <img src="storage/{{$data->banner}}" width="80" height="auto">
                @endif
            </td>
            <td>{{$data->name}}</td>
            <td>${{$data->package_price}}</td>
            <!---
            <td>
                
                <form onSubmit="return confirm('Are you sure to Cancel Your Service?')" method="post" action="/cancelservice/{{$data->id}}">

                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Cancel" class="btn btn-danger m-1">
                </form>
            </td> --->
        </tr>
        @endforeach
    </table>
</div>




</div>
<!-- /.container-fluid -->

@endsection 