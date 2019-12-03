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
                  @if (!empty($success))
                  <div class="alert alert-success alert-block" role="alert">
                    <button type="button" class="close" data-dismiss="alert">×</button>	
                          <strong>{{ $success}}</strong>
                  </div>
                  @endif
                  @if ($errors->any())
                  <div class="alert alert-success alert-block" role="alert">
                    <button type="button" class="close" data-dismiss="alert">×</button>	
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
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
                          <form action="{{ url("inventory/$id") }}" method="post" id="addinventory">
                            <input type="hidden" name="_method" value="{{$method}}">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <?php 
                                if(!empty($inven)){
                                 $inven_product_id=$inven['product_id'];
                                 $supplier_name=$inven['supplier_name'];
                                 $buyprice=$inven['buyprice'];
                                 $saleprice=$inven['saleprice'];
                                }else{
                                  $inven_product_id='';
                                  $supplier_name='';
                                  $buyprice='';
                                  $saleprice='';
                                }
                              ?>
                              <div class="row">
                                <div class="col-sm-12">
                                  <!-- select option -->
                                  <div class="form-group">
                                    <label>Product</label>
                                    <select name="product_id" id="product_id" class="form-control select2">
                                      <option value="">Select Product</option>
                                      @foreach ($products as $product)
                                        <option {{ !$product_id=!empty($inventory)  ? $product->product_id : $inven_product_id }} {{ ($product_id==$product->id)  ? 'selected' : '' }} value="{{$product->id}}">{{$product->modelname}} -- ({{$product->brand->name}}) -- ({{$product->category->name}})</option>
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
                                    <input type="text" name="supplier_name" required class="form-control" placeholder="Enter Supplier Name" value="{{ !empty($inventory) ? $inventory->supplier_name :  $supplier_name}}">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-12">
                                  <!-- text input -->
                                  <div class="form-group">
                                    <label>Buy Price</label>
                                    <input type="number" name="buyprice" required class="form-control" placeholder="Enter Buy Price" value="{{ !empty($inventory) ? $inventory->buyprice : $buyprice }}">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-12">
                                  <!-- text input -->
                                  <div class="form-group">
                                    <label>Sale Price</label>
                                    <input type="number" name="saleprice" required class="form-control" placeholder="Enter Sale Price" value="{{ !empty($inventory) ? $inventory->saleprice : $saleprice }}">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-12">
                                  <!-- text input -->
                                  <div class="form-group">
                                    <label>Product Serial</label>
                                    <input type="text" id="myField" name="serial" required class="form-control" placeholder="Enter Product Serial" value="{{ !empty($inventory) ? $inventory->serial : '' }}">
                                  </div>
                                </div>
                              </div>
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
                                          <th>Category</th>
                                          <th>Brand</th>
                                          <th>Model	Name</th>
                                          <th>Serial</th>
                                          <th>Supplier</th>
                                          <th>Buy Price</th>
                                          <th>Sale Price</th>
                                          <th>Action</th>
                                      </tr>
                                    </thead>
                                   <tbody>
                                        @if (!empty($inventories))
                                        @php($i=1)
                                        @foreach ($inventories as $inventory)
                                        <?php 
                                            // $productBrandCategories = DB::table('inventories')
                                            //   ->join('products', 'inventories.product_id', '=', 'products.id')
                                            //   ->join('brands', 'products.brand_id', '=', 'brands.id')
                                            //   ->join('categories', 'products.category_id', '=', 'categories.id')
                                            //   ->select('inventories.buyprice','inventories.saleprice', 'inventories.serial', 'inventories.supplier_name', 'products.modelname', 'products.productname', 'brands.name as bname', 'categories.name as catname')
                                            //   ->where('products.id', $inventory->product_id)
                                            //   ->get();
                                            $categories=DB::table('categories')
                                                      ->join('products', 'categories.id','=', 'products.category_id')
                                                      ->join('brands', 'brands.id','=', 'products.brand_id')
                                                      ->select('categories.name as catname', 'brands.name as bname', 'products.modelname', 'products.productname')
                                                      ->where('products.id', $inventory->product_id)
                                                      ->get();
                                          ?>
                                          @foreach ($categories as $category)
                                          <tr>
                                            <td>{{$category->catname}}</td>
                                            <td>{{$category->bname}}</td>
                                            <td>{{$category->modelname}}</td>
                                            <td>{{$inventory->serial}}</td>
                                            <td>{{$inventory->supplier_name}}</td>
                                            <td>{{$inventory->buyprice}}</td>
                                            <td>{{$inventory->saleprice}}</td>
                                            <td style="text-align:center"  title="Edit"> 
                                              <a href="{{ URL::to("inventory/$inventory->id/edit") }}"> <i class="fas fa-edit" style="color:#007bff"></i></a>
                                              ||
                                              <i class="fas fa-trash" style="color:red"  title="Delete"></i>
                                            </td>
                                          </tr>
                                          @endforeach
                                         
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

