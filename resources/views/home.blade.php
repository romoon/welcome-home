@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!<br/>
                    <a href="{{ action('User\SendController@getsearch') }}" role="button" class="btn btn-rmngreen">位置情報の設定</a>
                    <a href="{{ asset('/profile/edit') }}" role="button" class="btn btn-outline-warning">ユーザー情報の設定</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
