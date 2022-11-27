@extends('supervisor.layouts.master2')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="brand text-center">
                <a class="link text-white text-center" href="{{route('index')}}">
                    <img class="text-center" src="{{asset('admin-assets/img/logo.png')}}" style="width:20%; margin: 10px auto ;" />
                    <h1 style="color: black !important;">
                        مجوهرات العقاب
                    </h1>
                </a>
            </div>
            <div class="card">
                <div class="card-header text-center">اعادة تعيين كلمة المرور</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('supervisor.password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">البريد الالكترونى</label>

                            <div class="col-md-6">
                                <input id="email" type="email" dir="ltr" class="form-control text-left @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">كلمة المرور</label>

                            <div class="col-md-6">
                                <input id="password" dir="ltr" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">تأكيد كلمة المرور</label>

                            <div class="col-md-6">
                                <input id="password-confirm" dir="ltr" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0 text-center">
                            <div class="col-md-12 offset-md-12">
                                <button type="submit" class="btn btn-primary">
                                    اعادة تعيين كلمة المرور
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
