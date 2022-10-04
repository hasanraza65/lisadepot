@extends('layout.layout')
@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Accounts</h1>

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
            <th>Account Name</th>
            <th>Action</th>
        </tr>
        @foreach($accounts as $data)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$data->account_name}}</td>
            <td>
                
                <form onSubmit="return confirm('Are you sure to Delete?')" method="post" action="{{ route('client-account.destroy',$data->id) }}">

                    <a type="button" href="/client-account/{{$data->id}}/edit" class="btn btn-primary m-1">Edit</a>

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