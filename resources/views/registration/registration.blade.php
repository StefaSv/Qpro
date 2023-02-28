<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Carseller</title>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="./public/img/icon.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('/css/style.min.css')}}">
</head>
</html>
<body>
<section class="section-registration section-login">
    <div class="container">
        <div class="section-registration__main section-login__main">
            <div class="section-registration__main_top">
                <a class="btn back-btn" href="/">Назад</a>
            </div>
            <div class="title">Регистрация</div>
            <div class="desc">Укажите свои личные данные</div>
            <form id="registration"
{{--                  action="/registration/check-phone" --}}
{{--                  method="post"--}}
            >
                @csrf
                <div class="form-group">
                    <label for="name">Имя<b>*</b></label>
                    <input type="text" name="name" id="name" placeholder="Введите имя" required>
                </div>
                <div class="form-group">
                    <label for="last-name">Фамилия<b>*</b></label>
                    <input type="text" name="last_name" id="last_name" placeholder="Введите фамилию" required>
                </div>
                <div class="form-group" id ="div_e_mail">
                    <label for="email">Рабочий e-mail<b>*</b></label>
                    <input type="text" name="email" id="email" placeholder="Введите e-mail" required>
                </div>
                <div class="form-group" id="div_phone">
                    <label for="email">Номер телефона<b>*</b></label>
                    <input type="tel" name="phone" id="phone" placeholder="+7 (***) ***-**-** " required>
                </div>
                <div class="text-gray">На номер телефона поступит звонок для подтверждения заявки на регистрацию Вашего аккаунта</div>
                <div class="form-group form-group-center radio">
                    <input type="checkbox" name="agree" id="agree">
                    <label for="agree">Я согласен на <a href="#" class="underline"> обработку персональных данных</a>
                    </label>
                </div>
                <button class="btn" type="button" id="reg"
                        disabled>Продолжить</button>
            </form>
        </div>
    </div>
</section>
<div class="modal fade" id="exampleModalCenterRead" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalCenterReadTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <section class="section-registration section-login section-verification">
                <div class="container">
                    <div class="section-registration__main section-login__main">
                        <div class="title">Проверка заявки</div>
                        <div class="desc">Чтобы удостовериться, что Вы не робот</div>
                        <p>На номер <span> номер </span> поступит звонок.</p><p>Введите <span>последние четыре цифры</span>.</p>
                        <form id="registration1" action="/registration/check-phone" method="post">
                            @csrf
                            <div class="form-group">
                                <div class="for-input-pass">
                                    <input type="number">
                                    <input type="number">
                                    <input type="number">
                                    <input type="number">
                                    <input name="pincode" type="hidden">
                                </div>
                            </div>
                            <button class="btn" type="submit" id="verif" disabled>Выбрать ДЦ</button>
                        </form>
                    </div>
                </div>
            </section>
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
