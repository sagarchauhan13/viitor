@extends('users.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 9 CRUD Example from scratch</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('registerusers.create') }}"> Create New User</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>DOB</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($registerUsers as $data)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $data->first_name }}</td>
            <td>{{ $data->last_name }}</td>
            <td>{{ $data->email }}</td>
            <td>{{ $data->dob }}</td>
            <td>
                <form action="{{ route('registerusers.destroy',$data->id) }}" method="POST">
   
                    @if($data->is_active == 'no')
                    <a class="btn btn-info" href="{{ route('registerusers.active',$data->id) }}">Active</a>
                    @else
                    <a class="btn btn-secondary" disabled>Activted</a>
                    @endif
    
                    <a class="btn btn-primary" href="{{ route('registerusers.edit',$data->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $registerUsers->links() !!}
      
@endsection