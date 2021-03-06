@extends('layouts.admin')

@section('content')
    <section class="content">
            <section class="content-header">
                    <div class="container-fluid">
                      <div class="row mb-2">
                        <div class="col-sm-6">
                          <h1>Product Category</h1>
                        </div>
                        <div class="col-sm-6">
                          <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Product Category</li>
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
                            <h3 class="card-title">Add New Product Category</h3>
                        </div>
                        <div class="card-body">
                          <?php 
                            $id = !empty($category) ? $category->id : '';
                            $method = !empty($category) ? 'PUT' : 'POST';
                          ?>
                          <form action="{{ url("category/$id") }}" method="post">
                            <input type="hidden" name="_method" value="{{$method}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="row">
                              <div class="col-sm-12">
                                <!-- text input -->
                                <div class="form-group">
                                  <label>Category Name</label>
                                  <input type="text" name="name" requireed class="form-control" placeholder="Enter Category Name"  value="{{ !empty($category) ? $category->name : '' }}">
                                </div>
                              </div>
                            </div>
                        </div>

                    <div class="card-footer">
                        <button type="submit" name="submit" value="submit" class="btn btn-primary">{{ !empty($category) ? 'Update' : 'Save' }}</button>
                        <a href="{{ URL::to("category") }}"  class="btn btn-danger">Cancel</a>
                    </div>
                    </form>
                    </div>
                    
                </div>
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List of Product Category</h3>
                        </div>
                        <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>                  
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Name</th>
                                        <th  colspan="2" style="text-align:center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($categories))
                                        {{!$i=1}} 
                                            @foreach ($categories as $category)
                                                <tr>
                                                <td>{{$i++}}</td>
                                                  <td> {{$category->name}}</td>
                                                  <td style="text-align:center"  title="Edit User category"> <a href="{{ URL::to("category/$category->id/edit") }}"><i class="fas fa-edit" style="color:#007bff"></i></a></td>
                                                  <td style="text-align:center"> <i class="fas fa-trash" style="color:red"  title="Delete User category"></i></td>
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

                   