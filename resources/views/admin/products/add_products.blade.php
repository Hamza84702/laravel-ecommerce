@extends('admin.layouts.main')
@section('main-content') 
<div class="main-panel">
    <div class="content-wrapper">
        @if(session()->has('message'))
        <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        {{session()->get('message')}}
        </div>
        @endif
    <div class="container mt-5">
        <div class="card mx-auto">
            <div class="card-header">
                Product Information
            </div>
            <div class="card-body" style="color:balck;">
                <form action="{{route('add_product')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="productTitle" class="form-label">Product Title</label>
                        <input type="text" class="form-control" id="productTitle" placeholder="Enter product title" name="product_title" Required>
                        @error('product_title')
                            <span class="text-danger">Please Enter the Product Title</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Product Price</label>
                        <input type="number" class="form-control" id="productPrice" placeholder="Enter product price" name="product_price" Required>
                    </div>
                    <div class="mb-3">
                        <label for="discount" class="form-label">Discount</label>
                        <input type="number" class="form-control" id="discount" placeholder="Enter discount" name="product_discount" Required>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity" placeholder="Enter quantity" name="product_quantity" Required>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Select Category</label>
                        <select class="form-select" id="category" style="color:black" name="category" Required>
                            <option selected disablesd>Select</option>
                            @foreach($categories as $category)
                            <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="mb-3">
                        <label for="productImage" class="form-label">Product Image</label>
                        <input type="file" class="form-control" id="productImage" name="image" Required>
                    </div>
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Product Description</label>
                        <textarea class="form-control" id="productDescription" rows="3"
                            placeholder="Enter product description" name="product_description" Required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection