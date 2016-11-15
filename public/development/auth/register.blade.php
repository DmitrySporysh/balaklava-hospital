@extends('layouts.app')

@section('content')
    <div class="container ">
        <h2 class="text-center">Регистрация</h2>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('fio') ? ' has-error' : '' }}">
                <label for="inputFIO" class="col-sm-2 control-label">ФИО: *</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputFIO" name="fio" placeholder="ФИО"
                           value="{{ old('fio') }}" required>
                    @if ($errors->has('fio'))
                        <span class="help-block">
                            <strong>{{ $errors->first('fio') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Пол: *</label>
                <div class="radio">
                    <label for="optionMale">
                        <input type="radio" id="optionMale" name="sex" value="Мужской" checked>
                        Мужской
                    </label>
                    <label for="optionFemale">
                        <input type="radio" id="optionFemale" name="sex" value="Женский">
                        Женский
                    </label>
                </div>
            </div>

            <div class="form-group{{ $errors->has('birth_date') ? ' has-error' : '' }}">

                <label for="input_birth_date" class="col-sm-2 control-label">Дата рождения: *</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="input_birth_date" name="birth_date"
                           placeholder="Дата рождения" value="{{ old('birth_date') }}" required>
                    @if ($errors->has('birth_date'))
                        <span class="help-block">
                                            <strong>{{ $errors->first('birth_date') }}</strong>
                                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Должность: *</label>
                <div class="radio">
                    <label for="optionDepartmentCheif">
                        <input type="radio" id="optionDepartmentCheif" name="post" value="Заведующий отделением" checked>
                        Заведующий отделением
                    </label>
                    <label for="optionMedSister">
                        <input type="radio" id="optionMedSister" name="post" value="Медсестра">
                        Медсестра
                    </label>
                    <label for="optionDoctor">
                        <input type="radio" id="optionDoctor" name="post" value="Врач">
                        Врач
                    </label>
                    <label for="optionMedWorker">
                        <input type="radio" id="optionMedWorker" name="post" value="Мед персонал">
                        Мед персонал
                    </label>
                </div>
            </div>

            <div class="form-group{{ $errors->has('login') ? ' has-error' : '' }}">
                <label for="inputLogin" class="col-sm-2 control-label">Логин: *</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputLogin" name="login" placeholder="Логин"
                           value="{{ old('login') }}" required>
                    @if ($errors->has('login'))
                        <span class="help-block">
                                            <strong>{{ $errors->first('login') }}</strong>
                                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="inputEmail" class="col-sm-2 control-label">Email: *</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail" name="email" placeholder="Email"
                           value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                <label for="inputPassword" class="col-sm-2 control-label">Пароль: *</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Пароль" required>
                    @if ($errors->has('password'))
                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">

                <label for="password-confirm" class="col-sm-2 control-label">Повторите пароль: *</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password-confirm" name="password_confirmation"
                           placeholder="Повторите пароль" required>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                    @endif
                </div>
            </div>

            <span id="mark" class="text-left">* - Обязательные поля для заполнения</span>
            <div class="form-group text-center">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Зарегистрироваться</button>
                </div>
            </div>
        </form>
    </div>

@endsection
