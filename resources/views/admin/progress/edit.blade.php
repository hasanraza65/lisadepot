@extends('layout.layout')
@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">
                    
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Edit Progress</h1>

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        <br>
    @endif

<div class="">
    <form method="POST" action="" enctype="multipart/form-data">
         @csrf
        @method('PUT')

        <div class="">
            
            <input type="text"  name="user_id" value=""  class="form-control">
               
           
        </div>

        <div class="mt-4">
            Choose Client's Account
            <select name="account_id" id="account_id" class="form-control">
                <option>Choose One...</option>
                <option value="1">Account 1</option>
            </select>
        </div>

        <div class="mt-4">
            Total Sales
            <input name="total_sales" type="text" value="{{$clientprogress->total_sales}}" placeholder="Enter Total Sales" class="form-control">
        </div>

        <div class="mt-4">
            Total Profit
            <input name="total_profit" type="float" placeholder="Enter Total Profit" class="form-control">
        </div>

        <div class="mt-4">
            Total Loss
            <input name="total_loss" type="float" placeholder="Enter Total Loss" class="form-control">
        </div>

        <div class="mt-4">
            Today Card Charge
            <input name="today_card_charge" type="float" placeholder="Enter Today Card Charge" class="form-control">
        </div>

        <div class="mt-4">
            Date
            <input name="date" type="date" placeholder="Choose Date" class="form-control">
        </div>

        <div class="mt-4">
            <input type="submit" class="btn btn-primary">
        </div>

    </form>
</div>




</div>
<!-- /.container-fluid -->
<script>
    function getClientAccount(id){
    
        var options = '<option>Select Account</option>';
    $('#account_id').append(options);
    $.ajax({
    type : 'GET',
    url  : '/clientaccounts',
    data : {id:id},
   
    success: function(res){
        res.forEach(data => {
            var options = `<option value="${data.id}">${data.account_name}</option>`;
             $('#account_id').append(options);
            
           
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