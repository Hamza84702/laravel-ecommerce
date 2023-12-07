<!DOCTYPE html>
<html>
@include('frontend.layouts.head')
    <body>
    @include('frontend.layouts.header')
    @include('sweetalert::alert')
        @yield('content')

    <!-- footer start -->
    @include('frontend.layouts.footer')
      <!-- footer end -->
 <!-- jQery -->
 <script src="{{url('js/jquery-3.4.1.min.js')}}"></script>
      <!-- popper js -->
      <script src="{{url('js/popper.min.js')}}"></script>
      <!-- bootstrap js -->
      <script src="{{url('js/bootstrap.js')}}"></script>
      <!-- custom js -->
      <script src="{{asset('js/custom.js')}}"></script>
    
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   </body>
</html>