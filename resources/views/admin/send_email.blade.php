@extends('admin.layouts.main')
@section('main-content') 
<div class="main-panel" style="width:100%">
    <div class="content-wrapper">
    <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Send Email TO User</h4>
                    <p class="card-description"> To : {{$order->email}} </p>
                    <form class="forms-sample pt-4" action="{{route('send_user_email',$order->id)}}" method="post">
                        @csrf
                      <div class="form-group">
                        <label for="greetings">Email Greeting</label>
                        <input type="text" class="form-control" id="greetings"  placeholder="" name="greeting">
                      </div>
                      <div class="form-group">
                        <label for="firstline">First Line</label>
                        <input type="text" class="form-control"  placeholder="" id="firstline" name="firstline">
                      </div>
                      <div class="form-group">
                        <label for="emailbody">Textarea</label>
                        <textarea class="form-control" id="emailbody" rows="4" name="body"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="buttonname">Email Button Name</label>
                        <input type="text" class="form-control"  placeholder="" id="buttonname" name="button">
                      </div>
                      <div class="form-group">
                        <label for="emailurl">Email Url</label>
                        <input type="text" class="form-control"  placeholder="" id="emailurl" name="url">
                      </div>
                      <div class="form-group">
                        <label for="lastline">Last Line</label>
                        <input type="text" class="form-control"  placeholder="" id="lastline" name="lastline">
                      </div>
                      
                      <input type="submit" value="Send Email" class="btn btn-primary">
                    </form>
                  </div>
                </div>
              </div>
    </div>
</div>
@endsection