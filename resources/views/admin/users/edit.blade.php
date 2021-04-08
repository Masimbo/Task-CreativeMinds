@extends('admin.layouts.admin')
@section('content')
<div class="col-md-6">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit User</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form role="form" action='' method='post'>
        @if($errors->any())
        {!! implode('', $errors->all('<div>:message</div>')) !!}
    @endif
          @method('put')
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter name" value="{{$user->name}}" name="name">
          </div>
          <label for="exampleInputEmail1">Phone</label>
          <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter phone" value="{{$user->phone}}" name="phone">
        </div>
       
         
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
    @endsection