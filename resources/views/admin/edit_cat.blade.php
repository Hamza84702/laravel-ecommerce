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
            <form action="{{route('add_category')}}" method="POST">
            @csrf
            <label for="category">Category</label>
            <input type="text" name="category_name" id="category">
                @error('category_name')
                 <div class="text-danger">Enter Category Name</div>
                @enderror
            <div class="text-center">
            <input class="btn btn-primary" type="submit" name="submit" value="Add">
            </div>
            </form>
        </div>

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