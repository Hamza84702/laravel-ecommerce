<!DOCTYPE html>
<html lang="en">
@include('admin.layouts.head')
  <body>
    <div class="container-scroller">

@include('admin.layouts.sidebar')
      
    @include('admin.layouts.nav')
    @yield('main-content')
    @include('admin.layouts.footer')
</div>
    </body>
</html>