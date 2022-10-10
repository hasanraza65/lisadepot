@extends('layout.layout')
@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">
                                 <form action="/filter-progress" method="POST" class="form m-4">
                                 @csrf
                                    <div class="row">
                                        <div class="col-3">
                                             <label for="">Choose Client</label>
                                                 <select class="form-control" name="user_id" onchange="getClientAccount(this.value)">
                                                      <option>Choose One...</option>
                                                          @foreach($users as $userss)
                                                              <option value="{{$userss->id}}">{{$userss->email}}</option>
                                                          @endforeach
                                                 </select>
                                        </div>
                                        <div class="col-3">
                                             <label for="">Choose Account</label>
                                                 <select class="form-control" name="account_id" id="account_id">
                                                         @foreach($accounts as $account)
                                                              <option value="{{$account->id}}">{{$account->account_name}}</option>
                                                          @endforeach
                                                 </select>
                                        </div>
                                        <div class="col-2">
                                              <label for="">start Date</label>
                                             <input type="date" class="form-control" name="start_date" id="">
                                                 
                                        </div>
                                        <div class="col-2">
                                             <label for="">End Date</label>
                                             <input type="date" class="form-control" name="end_date" id="">
                                                
                                        </div>
                                        <div class="col-2">
                                            <br>
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
            <th>Action</th>
        </tr>
        @foreach($progress as $data)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$data->user_id}}</td>
            <td>{{$data->account_id}}</td>
            <td>{{$data->total_sales}}</td>
            <td>{{$data->total_profit}}</td>
            <td>{{$data->total_loss}}</td>
            <td>${{$data->today_card_charge}}</td>
            <td>{{$data->date}}</td>
            <td>
                
                <form onSubmit="return confirm('Are you sure to Delete?')" method="post" action="{{ route('client-progress.destroy',$data->id) }}">

                    <a type="button" href="/client-progress/{{$data->id}}/edit" class="btn btn-primary m-1">Edit</a>

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
<script>
    function getClientAccount(id){
        $('#account_id').html('');
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