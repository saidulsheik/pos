@extends('layouts.admin')

@section('content')
    <section class="content">
            <section class="content-header">
                    <div class="container-fluid">
                      <div class="row mb-2">
                        <div class="col-sm-6">
                          <h1>Task</h1>
                        </div>
                        <div class="col-sm-6">
                          <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Task</li>
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
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add New Task</h3>
                        </div>
                        <div class="card-body">
                            {{-- @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block" role="alert">
                              <button type="button" class="close" data-dismiss="alert">×</button>	
                                    <strong>{{ $message }}</strong>
                            </div>
                            @endif --}}
                          {{-- {{Route::currentRouteName()}} --}}
                          @php($id = !empty($task) ? $task->id : '')
                          @php($method = !empty($task) ? 'PUT' : 'POST')
                          <form action="{{ url("task/$id") }}" method="post">
                            <input type="hidden" name="_method" value="{{$method}}">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row">
                                  <div class="col-sm-12">
                                    <!-- text input -->
                                    <div class="form-group">
                                      <label>Task Name</label>
                                      <input type="text" name="name" required class="form-control" placeholder="Enter task Name" value="{{ !empty($task) ? $task->name : '' }}">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-12">
                                    <!-- textarea -->
                                    <div class="form-group">
                                      <label>Task Description</label>
                                    <textarea class="textarea" name="description" placeholder="Enter task Description"
                                      style="width: 100%; height: 200px; font-size: 14px; line-height: 25px; border: 1px solid #dddddd; padding: px;">
                                      {{ !empty($task) ? $task->description : '' }}
                                    </textarea>

                                      {{-- <textarea class="form-control" rows="3" required name="description" placeholder="Enter task Description">{{ !empty($task) ? $task->description : '' }}</textarea> --}}
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-sm-12">
                                    <!-- select option -->
                                    <div class="form-group">
                                      <label>Department</label>
                                      <select name="company_id" id="company_id" class="form-control select2">
                                        <option value="">Select Department Name</option>
                                        @foreach ($companies as $company)
                                          <option {{ !$company_id=!empty($task)  ? $task->company_id : '' }} {{ ($company_id==$company->id)  ? 'selected' : '' }} value="{{$company->id}}">{{$company->name}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <!-- select option -->
                                        <div class="form-group">
                                        <label>Project</label>
                                        <select name="project_id" id="project_id" class="form-control select2">
                                            <option value="">Select Project Name</option>
                                            @foreach ($projects as $project)
                                            <option {{ !$project_id=!empty($task)  ? $task->company_id : '' }} {{ ($company_id==$company->id)  ? 'selected' : '' }} value="{{$project->id}}">{{$project->name}}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                      <!-- text input -->
                                      <div class="form-group">
                                        <label>Approximate Days</label>
                                        <input type="number" name="days" required class="form-control" placeholder="Enter Approximate Days" value="{{ !empty($task) ? $task->days : '' }}">
                                      </div>
                                    </div>
                                </div>
                        </div>

                    <div class="card-footer">
                        <button type="submit" name="submit" value="submit" class="btn btn-primary">Save</button>
                        <a href="{{ URL::to("task") }}"  class="btn btn-danger">Cancel</a>
                    </div>
                    </form>
                    </div>
                    
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Task Lists</h3>
                        </div>
                        <div class="card-body">
                                <table class="table table-bordered table-responsive" id="example1">
                                    <thead>                  
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Task Name</th>
                                        <th>Description</th>
                                        <th>Department Name</th>
                                        <th>Project Name</th>
                                        <th>Approximate Days</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($tasks))
                                        @php($i=1)
                                        @foreach ($tasks as $task)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td><a href="{{ URL::to("task/$task->id") }}">{{$task->name}}</a></td>
                                                <td> {{$task->task_details}}</td>
                                                <td>  {{$task->company->name}}</td>
                                                <td>  {{$task->project->name}}</td>
                                                {{-- <td>  {{$task->users->name}}</td> --}}
                                                <td>  {{$task->days}} Days</td>
                                                <td style="text-align:center"  title="Edit"> 
                                                  <a href="{{ URL::to("task/$task->id/edit") }}"> <i class="fas fa-edit" style="color:#007bff"></i></a>
                                                  ||
                                                  <i class="fas fa-trash" style="color:red"  title="Delete"></i>
                                                </td>
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

                   