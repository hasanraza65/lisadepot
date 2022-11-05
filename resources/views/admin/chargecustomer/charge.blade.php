@extends('layout.layout')
@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Charge Customer</h1>

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        <br>
    @endif

<div class="">
    <form method="POST" action="/chargecustomer" enctype="multipart/form-data">
        @csrf

        <div class="">
            Choose Customer
            <select onchange="getClientPurchase(this.value)" class="form-control" name="user_id">
                <option>Choose One...</option>
                @foreach($users as $userss)
                <option value="{{$userss->id}}">{{$userss->name}} ({{$userss->email}})</option>
                @endforeach
            </select>
        </div>

        <div class="mt-4">
            Total Amount
            <input type="text" placeholder="Enter Amount To Charge This User" name="total_cost" class="form-control">
        </div>

        <div class="mt-4">
            Choose Customer Purchase
            <select id="client_purchases" class="form-control" name="purchase_id">
                <option>Choose Customer...</option>
                
            </select>
        </div>

        <div class="mt-4">
            <input type="submit" class="btn btn-primary">
        </div>

    </form>
</div>


</div>
<!-- /.container-fluid -->

<script>
    function getClientPurchase(id){
        
        $('#client_purchases').html('');
        var options = '<option>Select Purchase..</option>';
    $('#client_purchases').append(options);
    $.ajax({
    type : 'GET',
    url  : '/clientpurchase',
    data : {id:id},
   
    success: function(res){
        res.forEach(data => {
            var options = `<option value="${data.id}">${data.plan}</option>`;
             $('#client_purchases').append(options);
            
           
        })

    },
    error: function(res){
      console.log('Failed');
      console.log(res);
    }
 });
    }
</script>

@endsection 