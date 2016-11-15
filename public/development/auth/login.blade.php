@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-sm-offset-2 col-sm-4">
                <div style="border-width: 0 1px 0 0; border-style: solid;">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <h1>Вход</h1><br>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('login') ? ' has-error' : '' }}">
                            <label for="login" class="col-md-4 control-label">login</label>

                            <div class="col-md-6">
                                <input id="emailLogin" type="login" class="form-control" name="login"
                                       value="{{ old('login') }}">

                                @if ($errors->has('login'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('login') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Пароль</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('emailLogin') ? ' has-error' : '' }}">
                            <lable for="forgetPassword" class="col-md-4 control-label"></lable>
                            <div class="col-md-6">

                                <a id="forgetPassword" href="{{ url('/forgetpassword') }}">Забыли пароль?</a>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Оставаться в системе
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> ОК
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
@endsection
