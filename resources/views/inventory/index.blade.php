@extends('layouts.admin')

@section('content')
    <section class="content">
            <section class="content-header">
                    <div class="container-fluid">
                      <div class="row mb-2">
                        <div class="col-sm-6">
                          <h1>Add Inventory</h1>
                        </div>
                        <div class="col-sm-6">
                          <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Inventory</li>
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
                            <h3 class="card-title">Add Product</h3>
                        </div>
                        <div class="card-body">
                            {{-- @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block" role="alert">
                              <button type="button" class="close" data-dismiss="alert">×</button>	
                                    <strong>{{ $message }}</strong>
                            </div>
                            @endif --}}
                          {{-- {{Route::currentRouteName()}} --}}
                          @php($id = !empty($inventory) ? $inventory->id : '')
                          @php($method = !empty($inventory) ? 'PUT' : 'POST')
                          <form action="{{ url("inventory/$id") }}" method="post">
                            <input type="hidden" name="_method" value="{{$method}}">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              
                              <div class="row">
                                <div class="col-sm-12">
                                  <!-- select option -->
                                  <div class="form-group">
                                    <label>Product</label>
                                    <select name="product_id" id="product_id" class="form-control select2">
                                      <option value="">Select Product</option>
                                      @foreach ($products as $product)
                                        <option {{ !$product_id=!empty($inventory)  ? $product->product_id : '' }} {{ ($product_id==$product->id)  ? 'selected' : '' }} value="{{$product->id}}">{{$product->modelname}} -- ({{$product->brand->name}}) -- ({{$product->category->name}})</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                              </div>
                              
                              <div class="row">
                                <div class="col-sm-12">
                                  <!-- text input -->
                                  <div class="form-group">
                                    <label>Supplier Name</label>
                                    <input type="text" name="supplier_name" required class="form-control" placeholder="Enter Supplier Name" value="{{ !empty($inventory) ? $inventory->supplier_name :  !empty($supplier_name) ? $supplier_name: ''}}">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-12">
                                  <!-- text input -->
                                  <div class="form-group">
                                    <label>Buy Price</label>
                                    <input type="number" name="buyprice" required class="form-control" placeholder="Enter Buy Price" value="{{ !empty($inventory) ? $inventory->buyprice : '' }}">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-12">
                                  <!-- text input -->
                                  <div class="form-group">
                                    <label>Sale Price</label>
                                    <input type="number" name="saleprice" required class="form-control" placeholder="Enter Sale Price" value="{{ !empty($inventory) ? $inventory->saleprice : '' }}">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-12">
                                  <!-- text input -->
                                  <div class="form-group">
                                    <label>Supplier Name</label>
                                    <input type="text" name="serial" required class="form-control" placeholder="Enter Product Serial" value="{{ !empty($inventory) ? $inventory->serial : '' }}">
                                  </div>
                                </div>
                              </div>
                              {{-- <div class="row">
                                <div class="col-sm-12">
                                  <!-- select option -->
                                  <div class="form-group">
                                    <label>Brand</label>
                                    <select name="brand_id" id="brand_id" class="form-control select2">
                                      <option value="">Select Brand Name</option>
                                      @foreach ($brands as $brand)
                                        <option {{ !$brand_id=!empty($product)  ? $product->brand_id : '' }} {{ ($brand_id==$brand->id)  ? 'selected' : '' }} value="{{$brand->id}}">{{$brand->name}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-12">
                                  <!-- text input -->
                                  <div class="form-group">
                                    <label>Model Name</label>
                                    <input type="text" name="modelname" requireed class="form-control" placeholder="Enter Model Name"  value="{{ !empty($product) ? $product->modelname : '' }}">
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-sm-12">
                                  <!-- text input -->
                                  <div class="form-group">
                                    <label>Product Name</label>
                                    <input type="text" name="productname" requireed class="form-control" placeholder="Enter Product Name"  value="{{ !empty($product) ? $product->productname : '' }}">
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-sm-12">
                                  <!-- select option -->
                                  <div class="form-group">
                                    <label>Is Serialised?</label>
                                    <select name="isserialised" id="isserialised" class="form-control">
                                    <option {{!$isserialised=!empty($product)  ? $product->isserialised : '' }} {{($isserialised=='yes')  ? 'selected' : ''}} value="yes">Yes</option>
                                    <option {{!$isserialised=!empty($product)  ? $product->isserialised : '' }} {{($isserialised=='no')  ? 'selected' : ''}} value="no">No</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              @if (!empty($product))
                                <div class="row">
                                    <div class="col-sm-12">
                                      <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" id="status" class="form-control">
                                        <option {{!$status=!empty($product)  ? $product->status : '' }} {{($status==1)  ? 'selected' : ''}} value="1">Active</option>
                                        <option {{!$status=!empty($product)  ? $product->status : '' }} {{($status==0)  ? 'selected' : ''}} value="0">Inactive</option>
                                        </select>
                                      </div>
                                    </div>
                                </div>
                              @endif --}}
                               

                        </div>

                    <div class="card-footer">
                        <button type="submit" name="submit" value="submit" class="btn btn-primary">Save</button>
                        <a href="{{ URL::to("product") }}"  class="btn btn-danger">Cancel</a>
                    </div>
                    </form>
                    </div>
                    
                </div>
               <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Product Lists</h3>
                        </div>
                        <div class="card-body">
                                <table class="table table-bordered" id="example1">
                                    <thead>                  
                                    <tr>
                                        <th>#</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Model Name</th>
                                        <th>Product Name</th>
                                        <th>Available Quantity</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    {{-- <tbody>
                                        @if (!empty($products))
                                        @php($i=1)
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td> {{$product->category->name}}</td>
                                                <td>  {{$product->brand->name}}</td>
                                                <td>  {{$product->modelname}}</td>
                                                <td>  {{$product->productname}}</td>
                                                <td> 00</td>
                                                <td>{{$product->status==1? 'Active':'Inactive'}}</td>
                                                <td style="text-align:center"  title="Edit"> 
                                                  <a href="{{ URL::to("product/$product->id/edit") }}"> <i class="fas fa-edit" style="color:#007bff"></i></a>
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
                                    </tbody> --}}
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

                   