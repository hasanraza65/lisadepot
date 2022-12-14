@extends('layout.layout')
@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Edit Account</h1>

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        <br>
    @endif

<div class="">
    <form method="POST" action="{{ route('client-account.update',$clientAccount->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="">
            Account Name
            <input name="account_name" type="text" placeholder="Enter Service Name" value="{{$clientAccount->account_name}}" class="form-control">
            
        </div>

       
        <div class="mt-4">
            <input type="submit" class="btn btn-primary">
        </div>

    </form>
</div>




</div>
<!-- /.container-fluid -->

@endsection 