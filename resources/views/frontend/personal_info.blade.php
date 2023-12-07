@extends('frontend.layouts.main')
@section('content')
<style>
    .font{
         font-size: 30px;
    }
</style>
<div class="hero_area">
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="POST" action="{{route('personal_infoSave')}}" class="needs-validation">
                    @csrf
                    <!-- <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    </div> -->
                    <!-- <div class="form-group">
                        <label for="phone_number">Phone Number:</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Phone Number" required>
                    </div> -->
                    <div class="text-center mb-4 font">
                        <h1><b>Delivery Address</b></h1>
                    </div>
                    <div class="form-group">
                        <label for="street">Street:</label>
                        <input type="text" class="form-control" id="street" name="address[street]" placeholder="Street" required>
                            @if($errors->has('address.street'))
                                <p class="text-danger">Please Fill the Street Fileld</p>
                            @endif                          
                    </div>
                    <div class="form-group">
                        <label for="city">City:</label>
                        <input type="text" class="form-control" id="city" name="address[city]" placeholder="City" required>
                            @if($errors->has('address.city'))
                                <p class="text-danger">Please Fill the City Fileld</p>
                            @endif   
                    </div>
                    <div class="form-group">
                        <label for="zip">ZIP Code:</label>
                        <input type="text" class="form-control" id="zip" name="address[zip]" placeholder="ZIP Code" required>
                            @if($errors->has('address.zip'))
                                <p class="text-danger">Please Fill the Street Fileld</p>
                            @endif   
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-success">Next</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection