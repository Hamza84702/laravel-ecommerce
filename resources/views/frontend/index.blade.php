@extends('frontend.layouts.main')
    @section('content')
      <div class="hero_area">
         <!-- header section strats -->
       
         <!-- end header section -->
         <!-- slider section -->
        @include('frontend.layouts.slider')
         <!-- end slider section -->
      </div>
      <!-- why section -->
        @include('frontend.layouts.why')
      <!-- end why section -->
      
      <!-- arrival section -->
      @include('frontend.layouts.new-arival')

      <!-- end arrival section -->
      
      <!-- product section -->
      @include('frontend.layouts.products')
      <!-- end product section -->

      <!-- subscribe section -->
      @include('frontend.layouts.subscribe')
      <!-- end subscribe section -->
      <!-- client section -->
      @include('frontend.layouts.client')
      <!-- end client section -->
      
    @endsection
    