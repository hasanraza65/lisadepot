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
            <td>1</td>
            <td></td>
            <td>Amazon</td>
            <td>$500</td>
            <td>
                <a href="/service/1/edit" class="btn btn-primary mb-2">Edit</a>
                <form method="post" action="{{ route('service.destroy',$data->id) }}">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete" class="btn btn-danger">
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>




</div>
<!-- /.container-fluid -->

@endsection 