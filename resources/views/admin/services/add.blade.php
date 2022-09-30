@extends('layout.layout')
@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Add Service</h1>

<div class="">
    <form method="POST" action="/service">
        @csrf

        <div class="">
            Service Name
            <input name="name" type="text" placeholder="Enter Service Name" class="form-control">
        </div>

        <div class="mt-4">
            Service Banner (Recommended: 350*250 px)
            <input name="banner" style="height:auto" class="form-control" type="file" id="formFile">
        </div>

        <div class="mt-4">
            Price
            <input name="price" placeholder="25" type="number" class="form-control">
        </div>

        <div class="mt-4">
            <input type="submit" class="btn btn-primary">
        </div>

    </form>
</div>




</div>
<!-- /.container-fluid -->

@endsection 