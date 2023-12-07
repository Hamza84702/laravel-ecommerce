@extends('admin.layouts.main')
@section('main-content') 
<div class="main-panel">
    <div class="content-wrapper">
      @if(session()->has('message'))
        <div class="alert alert-danger alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
          {{session()->get('message')}}
        </div>
      @endif
    <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Striped Table</h4>
                    <p class="card-description"> Add class <code>.table-striped</code>
                    </p>
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th> Sr #</th>
                            <th> Image</th>
                            <th> Title </th>
                            <th> Category </th>
                            <th> Quantity</th>
                            <th> Price </th>
                            <th> Discount</th>
                            <th> Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $key => $product)
                          <tr>
                            <td>{{$key  + 1}}</td>
                            <td class="py-1">
                              <img src="{{ asset('uploads/products/' . $product->image) }}" alt="image" />
                            </td>
                            <td> 
                                {{$product->title}} 
                            </td>
                            <td>
                            {{$product->category}}
                            </td>
                            <td> {{$product->quantity}}</td>
                            <td> {{$product->price}} </td>
                            <td>{{$product->discount_price}}</td>
                            <td><a href="{{route('edit_product',$product->id)}}"><i class="mdi mdi-table-edit" style="color: green;"></i></a>
                            <a href="{{route('delete_product',$product->id)}}" onclick="confirmation (event)">
                            <i class="mdi mdi-delete" style="color: red;"></i>
                            </a>
                            </td>  
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
    </div>
</div>
@endsection