<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Carseller</title>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <link rel="icon" href="./public/img/icon.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('/css/style.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/jquery.toast.css')}}">
</head>
</html>
<body>
<section class="login-recovery section-login">
    <div class="container">
        <div class="login-recovery__main section-login__main">
            <div class="login-recovery__main_top">
                <a class="btn back-btn" href="/">Назад</a>
            </div>
            <div class="title">Восстановление пароля</div>
            <div class="desc">Для восстановления пароля введите почту,<br> на которую регистрировался аккаунт</div>
            <form class="recovery-form" action="#" method="post">
                @csrf
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="text" name="email" id="email" required>
                </div>
            </form>
            <div class="form-group">
                <button class="btn" type="submit" id="recovery">Восстановить пароль</button>
            </div>
        </div>
    </div>
</section>

<footer>
    <div class="footer-bottom">
        <div class="footer-bottom__left">
            <div class="support">Поддержка:</div>
            <a href="tel:88005353535">8 (800) 535 - 35 - 35</a>
            <div class="poloci">Политика обработки персональных данных</div>
        </div>
        <div class="footer-bottom__right">
            <div class="text">© 2022 Carsseller</div>
        </div>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js"></script>
<script src="{{ '/js/jquery.nicescroll.min.js'}}"></script>
<script src="{{ '/js/main.js'}}"></script>
<script src="{{ asset('/js/jquery.toast.js')}}"></script>
</body>
