@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="row">
        <div class="col-md-10 mx-auto mt-3">
          <a href="{{ route('login') }}" role="button" class="btn btn-primary">User Login</a>
          <a href="{{ route('admin.login') }}" role="button" class="btn btn-danger">Admin Login</a>
        </div>
      </div>
    </div>
@endsection
