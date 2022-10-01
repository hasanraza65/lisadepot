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
            <th>Service Banner</th>
            <th>Service Name</th>
            <th>Price</th>
            <th>Action</th>
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
            <td>${{$data->price}}</td>
            <td>
                
                <form method="post" action="{{ route('service.destroy',$data->id) }}">

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