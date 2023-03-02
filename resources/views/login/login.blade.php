<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Carseller</title>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <link rel="icon" href="./public/img/icon.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('/css/style.min.css')}}">
</head>
</html>
<body>
<section class="section-login section-login-first">
    <div class="container">
        <div class="section-login__main">
            <img src="{{asset("/img/NewLogo.svg")}}" alt="logo">
            <div class="title">Авторизация для генеральных директоров и руководителей отделов продаж</div>
            <div class="gray-block"><img src="./img/1.svg" alt="1">
                <div class="text">Вы получите логин и пароль в ответном письме после регистрации</div>
            </div>

            <form action="/login" method="post">
                @csrf
                <div class="form-group">
                    <label for="login">Логин</label>
                    <input type="text" name="login" id="login" placeholder="Введите логин" required>
                </div>
                <div class="form-group password-form-group">
                    <label for="password">Пароль</label>
                    <input class="@error('password') is-invalid @enderror" type="password" name="password" id="password" placeholder="Введите пароль"  required>
                    <div class="show-password"  style="top: 35px"></div>
                    @error('password')
                        <span class="error">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <a class="password" data-toggle="modal" data-target="#exampleModalRecover" href ="#">Забыли пароль?</a>
                    <button class="btn" type="submit" id="submit" disabled>Войти</button>
                </div>
            </form>
            <div class="bottom">
                <div class="text">Нет акканута?</div>
                <a class="register" href="/registration">Зарегистрироваться</a>
            </div>
        </div>
    </div>
</section>


<!-- Modal -->
<div class="modal fade" id="exampleModalRecover" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalRecover" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalRecover">Восстановление пароля</h4>
            </div>
            <div class="modal-body">
                <p>Для восстановления пароля введите почту,<br> на которую регистрировался аккаунт</p>
                <form class="recovery-form" action="/login/recovery/check" method="post" id="postpost">
                    @csrf
                    <div class="form-group">
                        <label for="email">E-mail<b>*</b></label>
                        <input type="text" name="email" id="email" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn" form="postpost" type="submit" id="submit">Восстановить пароль</button>
            </div>
        </div>
    </div>
</div>
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
</body>
