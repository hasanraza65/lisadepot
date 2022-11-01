@extends('layout.layout')
@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Add Account</h1>

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        <br>
    @endif

<div class="">
    <form method="POST" action="/client-account" enctype="multipart/form-data">
        @csrf

        <div class="">
            Account Name
            <input name="account_name" type="text" placeholder="Enter Service Name" class="form-control">
            @if(Auth::user()->user_role != 1)
            <input name="user_id" type="hidden" placeholder="Enter Service Name" value="{{Auth::user()->id}}" class="form-control">
            @else 
            <br>
            Choose Client
            <select name="user_id" class="form-control">
                <option value="">Choose One</option>
                @foreach($clients as $clientss)
                <option value="{{$clientss->id}}">{{$clientss->name}}</option>
                @endforeach
            </select>
            @endif
        </div>

       
        <div class="mt-4">
            <input type="submit" class="btn btn-primary">
        </div>

    </form>
</div>




</div>
<!-- /.container-fluid -->

@endsection 