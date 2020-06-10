@extends('layouts.user')

@section('title', 'ユーザー情報の編集')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>ユーザー情報の編集</h2>
                <form action="{{ action('User\ProfileController@update') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2" for="date">名前</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="name" value="{{ $profile_form->name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="date">表示名</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="nickname" value="{{ $profile_form->nickname }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="date">メールアドレス（編集できません）</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="email" value="{{ $profile_form->email }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="date">LINE notify Token</label>
                        <div class="col-md-10">
                            <input type="password" class="form-control" name="linetoken" value="{{ $profile_form->linetoken }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $profile_form->id }}">
                            <input type="hidden" name="password" value="{{ $profile_form->password }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-rmngreen" value="更新">
                            <a href="{{ asset('/search') }}" role="button" class="btn btn-outline-rmngreen">位置情報の設定</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
