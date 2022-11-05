@extends('layout.layout')
@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">
                                 <form action="/client-progress" method="GET" class="form m-4">
                                 
                                    <div class="row">
                                        @if(Auth::user()->user_role==1)
                                        <div class="col-3">
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
                                        <div class="col-3">
                                             <label for="">Choose Account</label>
                                                 <select class="form-control" name="account_id" id="account_id">
                                                            <option value="" selected>Choose One</option>
                                                            @foreach($accounts as $account)
                                                            @if(isset($_GET['account_id']) && $_GET['account_id'] == $account->id)
                                                            <option value="{{$account->id}}" selected>{{$account->account_name}}</option>
                                                            @else
                                                            <option value="{{$account->id}}">{{$account->account_name}}</option>
                                                            @endif
                                                            @endforeach
                                                 </select>
                                        </div>
                                        <div class="col-2">
                                             <label for="">Start Date</label>
                                             @if(isset($_GET['start_date']))
                                             <input value="{{$_GET['start_date']}}" type="date" class="form-control" name="start_date" id="">
                                             @else 
                                             <input type="date" class="form-control" name="start_date" id="">
                                             @endif
                                        </div>
                                        <div class="col-2">
                                             <label for="">End Date</label>
                                             @if(isset($_GET['end_date']))
                                             <input value="{{$_GET['end_date']}}" type="date" class="form-control" name="end_date" id="">
                                             @else 
                                             <input type="date" class="form-control" name="end_date" id="">
                                             @endif
                                        </div>
                                        <div class="col-2">
                                            <br>
                                            <input type="hidden" name="isfilter" value="true">
                                             <input type="submit" class="form-control btn btn-primary mt-2" value="Search"  name="search_progress" id="">
                                                
                                        </div>
                                    </div>
                                    
                                 </form>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Progress</h1>

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
        @foreach($progress as $data)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$data->user_id}}</td>
            <td>{{$data->account_id}}</td>
            <td>{{$data->total_sales}}</td>
            <td>£{{$data->total_profit}}</td>
            <td>£{{$data->total_loss}}</td>
            <td>£{{$data->today_card_charge}}</td>
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