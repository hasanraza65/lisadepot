@extends('layout.layout')
@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">
                                 <form action="/client-progress" method="GET" class="form">
                                 
                                    <div class="row">
                                        @if(Auth::user()->user_role==1)
                                        <div class="col-md-3 col-6 mt-4">
                                             <label for="">Choose Client</label>
                                                 <select class="form-control" name="user_id" onchange="getClientAccount(this.value)">
                                                      
                                                            <option value="" selected>Choose One</option>
                                                            @foreach($users as $userss)
                                                        
                                                            @if(isset($_GET['user_id']) && $_GET['user_id'] == $userss->id)
                                                            <option value="{{$userss->id}}" selected>{{$userss->email}}</option>
                                                            @else
                                                            <option value="{{$userss->id}}">{{$userss->email}}</option> 
                                                            @endif
                                                            @endforeach
                                                 </select>
                                        </div>
                                        @endif
                                        <div class="col-md-3 col-6 mt-4">
                                             <label for="">Choose Account</label>
                                                 <select class="form-control" name="account_id" id="account_id">
                                                            <option value="" selected>Choose One</option>
                                                            @foreach($accounts as $account)
                                                            @if(isset($_GET['account_id']) && $_GET['account_id'] == $account->id)
                                                            <option value="{{$account->id}}" selected>{{$account->account_name}}</option>
                                                            
                                                            @endif
                                                            @endforeach
                                                 </select>
                                        </div>
                                        <div class="col-md-2 col-6 mt-4">
                                             <label for="">Start Date</label>
                                             @if(isset($_GET['start_date']))
                                             <input value="{{$_GET['start_date']}}" type="date" class="form-control" name="start_date" id="">
                                             @else 
                                             <input type="date" class="form-control" name="start_date" id="">
                                             @endif
                                        </div>
                                        <div class="col-md-2 col-6 mt-4">
                                             <label for="">End Date</label>
                                             @if(isset($_GET['end_date']))
                                             <input value="{{$_GET['end_date']}}" type="date" class="form-control" name="end_date" id="">
                                             @else 
                                             <input type="date" class="form-control" name="end_date" id="">
                                             @endif
                                        </div>
                                        <div class="col-md-2 col-12 mt-5">

                                            <input type="hidden" name="isfilter" value="true">
                                             <input type="submit" class="form-control btn btn-primary mt-2" value="Search"  name="search_progress" id="">
                                                
                                        </div>
                                    </div>
                                    
                                 </form>
<!-- Page Heading -->
<h1 class="h3 mb-4 mt-4 text-gray-800">Progress</h1>

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
            <th>User</th>
            <th>Account Id</th>
            <th>Total Sales</th>
            <th>Total Profit</th>
            <th>Total Loss</th>
            <th>Today Card Charge</th>
            <th>Date</th>
            @if(Auth::user()->user_role == 1)
            <th>Action</th>
            @endif
        </tr>

        @php 
        $mega_total_sales = 0;
        $mega_total_profit = 0;
        $mega_total_loss = 0;
        $mega_today_card_charge = 0;

        @endphp

        @foreach($progress as $data)

        <!--- calculating totals ---> 

        @php
        
        $mega_total_sales = $data->total_sales+$mega_total_sales;
        $mega_total_profit = $data->total_profit+$mega_total_profit;
        $mega_total_loss = $data->total_loss+$mega_total_loss;
        $mega_today_card_charge = $data->today_card_charge+$mega_today_card_charge;

        @endphp 

        <!--- ending calculation totals --->

        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$data->name}}</td>
            <td>{{$data->account_name}}</td>
            <td>{{$data->total_sales}}</td>
            <td>${{$data->total_profit}}</td>
            <td>${{$data->total_loss}}</td>
            <td>${{$data->today_card_charge}}</td>
            <td>{{$data->date}}</td>

            @if(Auth::user()->user_role == 1)
            <td>
                
                <form onSubmit="return confirm('Are you sure to Delete?')" method="post" action="{{ route('client-progress.destroy',$data->id) }}">

                    <a type="button" href="/client-progress/{{$data->id}}/edit" class="btn btn-primary m-1">Edit</a>

                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete" class="btn btn-danger m-1">
                </form>
            </td>
            @endif
        </tr>
        @endforeach
        <tfooter>
            <tr class="table-primary">
                <th>Total: </th>
                <td></td>
                <td></td>
                <td>{{$mega_total_sales}}</td>
                <td>${{$mega_total_profit}}</td>
                <td>${{$mega_total_loss}}</td>
                <td>${{$mega_today_card_charge}}</td>
                <td></td>
                <td></td>
            </tr>
        </tfooter>
    </table>
</div>




</div>
<!-- /.container-fluid -->
<script>
    function getClientAccount(id){
        $('#account_id').html('');
        var options = '<option value="">Select Account</option>';
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