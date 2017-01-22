<!DOCTYPE html>
<html>
<head>
    <title>Alpha</title>
</head>
<body>
<p>This is the Alpha page.</p>
<p><a href="/beta">Next</a></p>

<form name="LoginForm" action="doctor#/inpatients">
    <div class="login-container__field-wrap">
        <div class="input__icon">
            <i class="fa fa-user"></i>
        </div>
        <input id="login" ng-model="loginCtrl.login_info.login" class="login-container__input" name="login"   value="" title="Person Name" type="text">
    </div>

    <div class="login-container__field-wrap">
        <div class="input__icon">
            <i class="fa fa-lock"></i>
        </div>

        <input id="password" ng-model="loginCtrl.login_info.password" class="login-container__input" name="password"  value="" title="Person Name" type="password">
    </div>
    <div class="login-container__field-wrap">
        <input class="login-container__submit transition" type="submit" name="submit"  id="submit" value="Войти">
    </div>

    <a ui-sref="registration" class="login_ref">Зарегистрироваться</a>
</form>

</body>
</html>