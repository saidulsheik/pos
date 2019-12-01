@extends('layouts.admin')

@section('content')
    <section class="content">
            <section class="content-header">
                    <div class="container-fluid">
                      <div class="row mb-2">
                        <div class="col-sm-6">
                          <h1>Users</h1>
                        </div>
                        <div class="col-sm-6">
                          <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Users</li>
                          </ol>
                        </div>
                      </div>
                    </div><!-- /.container-fluid -->
                  </section>
        <div class="container-fluid">
            <div class="row" id="successMessage">
                <div class="col-md-12">
                  @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block" role="alert">
                      <button type="button" class="close" data-dismiss="alert">×</button>	
                          <strong>{{ $message }}</strong>
                    </div>
                  @endif
                </div>
            </div>
            <div class="row">  
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add New User</h3>
                        </div>
                        <div class="card-body">
                          <?php 
                            $id = !empty($user) ? $user->id : '';
                            $method = !empty($user) ? 'PUT' : 'POST';
                          ?>
                          <form action="{{ url("user/$id") }}" method="post">
                            <input type="hidden" name="_method" value="{{$method}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="row">
                              <div class="col-sm-12">
                                <!-- text input -->
                                <div class="form-group">
                                  <label>User Name</label>
                                  <input type="text" name="name" requireed class="form-control" placeholder="Enter User Name"  value="{{ !empty($user) ? $user->name : '' }}">
                                </div>
                              </div>
                            </div>
                            @if ($errors->has('name'))
                            <div class="error text-danger">{{ $errors->first('name') }}</div>
                            @endif
                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- text input -->
                                    <div class="form-group">
                                    <label>User Email</label>
                                    <input type="email" name="email" requireed class="form-control" placeholder="Enter User Email"  value="{{ !empty($user) ? $user->email : '' }}">
                                    </div>
                                </div>
                            </div>
                            {{-- @if (!empty($users))
                            @foreach ($users as $user)
                            {{$user}}
                            @endforeach
                        @endif --}}
                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- text input -->
                                    <div class="form-group">
                                    <label>User Rule</label>
                                    <select name="role_id" id="role_id" class="form-control select2">
                                        <option value="">Select User Role</option>
                                        @if (!empty($roles))
                                        @foreach ($roles as $role)
                                    <option {{!$role_id=!empty($user) ? $user->role_id : '' }} {{$role->id==$role_id?'selected': ''}} value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach                                        
                                        @endif
                                    </select>
                                    </div>
                                </div>
                            </div>
                            @if (empty($user))
                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- text input -->
                                    <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" requireed class="form-control" placeholder="Enter Password"  value="{{ !empty($user) ? $user->password : '' }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- text input -->
                                    <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="password_confirmation" requireed class="form-control" placeholder="Enter Confirm Password"  value="{{ !empty($user) ? $user->password : '' }}">
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                    <div class="card-footer">
                        <button type="submit" name="submit" value="submit" class="btn btn-primary">{{ !empty($user) ? 'Update' : 'Save' }}</button>
                        <a href="{{ URL::to("user") }}"  class="btn btn-danger">Cancel</a>
                    </div>
                    </form>
                    </div>
                    
                </div>
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List of Users</h3>
                        </div>
                        <div class="card-body">
                                <table class="table table-bordered" id="example1">
                                    <thead>                  
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Name</th>
                                        <th>User Role</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($users))
                                            {{!$i=1}} 
                                                @foreach ($users as $user)
                                                    <tr>
                                                    <td>{{$i++}}</td>
                                                      <td> {{$user->name}}</td>
                                                    <td>{{$user->role->name}}</td>
                                                      <td> {{$user->status==1? 'Active': 'Inactive'}}</td>
                                                      <td style="text-align:center"  title="Edit User Role"> <a href="{{ URL::to("user/$user->id/edit") }}"><i class="fas fa-edit" style="color:#007bff"></i></a> || <i class="fas fa-trash" style="color:red"  title="Delete User Role"></i></td>
                                                    </tr>
                                                @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4">No Data Found</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

                   