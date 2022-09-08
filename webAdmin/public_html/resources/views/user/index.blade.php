@extends('layout')

@section('title')
    Users
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Add New User</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('user.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Name</label>
                            <input name="name" type="text" class="form-control" placeholder="Enter Name" required>
                        </div>
                        
                        <div class="form-group col-md-4">
                            <label>Email</label>
                            <input name="email" placeholder="Enter Email" type="email" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>User Name</label>
                            <input name="user_name" placeholder="Enter user name" type="email" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Password</label>
                            <input name="password" placeholder="Enter Password" type="password" class="form-control" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Create</button>
                    
                </form>
            </div>
        </div>
        <!-- /basic layout -->

    </div>
</div>

<div class="card">
    <table class="table datatable-save-state">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Action</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach (App\Models\User::all() as $key => $user)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->user_name}}</td>
                <td>{{$user->email}}</td>
                <td>
                    <button data-toggle="modal" data-target="#edit_modal" name="{{$user->name}}" user_name ="{{$user->user_name}}"
                    id="{{$user->id}}" email="{{$user->email}}" class="edit-btn btn btn-primary">Edit</button>
                </td>
                <td>
                    <form action="{{route('user.destroy',$user->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                    <button class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="edit_modal" class="modal fade">
    <div class="modal-dialog">
        <form id="updateForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Update User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" type="text" id="name" name="name" placeholder="Enter name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="name">Email</label>
                        <input class="form-control" type="email" id="email" name="email" placeholder="Enter email" required>
                    </div> 
                    
                    <div class="form-group">
                        <label for="user_name">User Name</label>
                        <input class="form-control" type="email" id="user_name" name="user_name" placeholder="Enter user name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="name">Password</label>
                        <input class="form-control" type="password" id="password" name="password" placeholder="Enter New Password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $('.edit-btn').click(function(){

            let name = $(this).attr('name');
            let id = $(this).attr('id');
            let email = $(this).attr('email');
            let user_name = $(this).attr('user_name');

            $('#name').val(name);
            $('#id').val(id);
            $('#email').val(email);
            $('#user_name').val(user_name);

            $('#updateForm').attr('action','{{route('user.update','')}}' +'/'+id);
        });
    });
</script>

@endsection