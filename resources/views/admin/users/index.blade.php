@extends('admin.layouts.admin')

@section('content')

@if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
            <br>
          <h3 class="card-title">Users Table</h3>
            <br>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 300px;">
          <table class="table table-head-fixed text-nowrap">
            <thead>
              <tr>
                <th>#</th>
                <th>User</th>
                <th>phone</th>
                <th>action</th>
              </tr>
            </thead>
            <tbody>
                @foreach($users as $key=>$user)
                <tr>
                <td>{{$key}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->phone}}</td>
                <td>
                    <a href="{{ route('users.edit', [ $user->id ]) }}" class="btn btn-sm btn-info"> Edit </a>
                    <a href="{{ route('users.delete', [ $user->id ]) }}" class="btn btn-sm btn-danger"> Delete </a>
                </td>>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
  <!-- /.row -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
@endsection