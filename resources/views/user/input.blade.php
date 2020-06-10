@extends('layouts.user')

@section('title', 'Welcome home 位置の入力')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Keyword') }}</div>

                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="keyword" class="col-md-4 col-form-label text-md-right">{{ __('Keyword') }}</label>

                            <div class="col-md-6">
                                <input id="keyword" type="text" class="form-control" name="keyword" value="{{ old('keyword') }}" required autocomplete="keyword" autofocus>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Search') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
