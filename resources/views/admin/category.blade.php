@extends('admin.layouts.main')
@section('main-content')
<div class="main-panel ">
    <div class="content-wrapper">
        @if(session()->has('message'))
            <div class ="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{session()->get('message')}}
            </div>

        @endif
        <div class="card">
        <div class="card-header">
            Add Category
        </div>
        <div class="card-body text-center">
          @if(Route::is('category_edit'))
          <form action="{{route('category_update',$category->id)}}" method="POST">
          @else
          <form action="{{route('add_category')}}" method="POST">
          @endif
            @csrf
            <label for="category">Enter Category</label>
            <input type="text" style="color:black" name="category_name" id="category" value="{{ Route::currentRouteName() === 'category_edit' ? $category->category_name : '' }}">
                @error('category_name')
                 <div class="text-danger">Enter Category Name</div>
                @enderror
            <div class="text-center pt-2">
            <input class="btn btn-primary" style="color:black" type="submit" name="submit" value="{{ Route::currentRouteName() === 'category_edit' ? 'Update' : 'Add' }}">
            </div>
            </form>
        </div>

        </div>
        @if(Route::is('view_category'))
        <div class="row mt-4">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Category List</h4>
                    <p class="card-description"> Add class <code>.table</code>
                    </p>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>SR#</th>
                            <th>Category</th>
                            <th>Created</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $key => $category)
                          <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$category->category_name}}</td>
                            <td>{{$category->created_at}}</td>
                            <td><a href="{{route('category_edit',$category->id)}}"><i class="mdi mdi-table-edit" style="color: green;"></i></a>
                            <a href="{{route('delete_category',$category->id)}}" onclick="confirmation (event)">
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
            @endif
    </div>
</div>

<!-- Script -->
<script>
        // Automatically close the success message after 3 seconds (3000 milliseconds)
        setTimeout(function(){
            $('.alert-success').alert('close');
        }, 6000);
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>

function confirmation(ev)
{
ev.preventDefault();
var urlToRedirect=ev.currentTarget.getAttribute('href');
console.log(urlToRedirect);
swal({
title: "Are you Sure to delete this",
text: "You won't be able to revert this delete",
icon: "warning",
buttons: true,
})
.then((willCancel) =>
{
if(willCancel)
{
window.location.href=urlToRedirect;
}
});
}
</script>


<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-category');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                const categoryId = button.getAttribute('data-category-id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect to the delete route if user confirms
                        window.location.href = "{{ url('delete-category') }}" + '/' + categoryId;
                    }
                });
            });
        });
    });
</script> -->

@endsection