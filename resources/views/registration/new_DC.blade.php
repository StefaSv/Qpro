<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Carseller</title>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <link rel="icon" href="./img/icon.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('/css/style.min.css')}}">
</head>
</html>
<body>
<section class="registration-application section-login">
    <div class="container">
        <div class="section-registration__main section-login__main">
            <div class="section-registration__main_top"><a class="btn back-btn" href="/registration/choice-DC">Назад</a></div>
            <div class="title">Заявка на добавление ДЦ</div>
            <div class="desc">Текст-описание, что нужно сделать пользователю, например: «Чтобы получить все материалы,
                заполните все поля и укажите почту, на которую эти материалы отправить.»
            </div>
            <form id="request" action="/registration/set-DC" method="post">
                @csrf
                <div class="form-group">
                    <label for="region">Регион<b>*</b></label>
                    <select name="region" id="region">
                        @foreach(\App\Models\New_location::all() as $model)
                            <option value="{{$model['title']}}">{{$model['title']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="brand">Бренд<b>*</b></label>
                    <select name="brand" id="brand">
                        @foreach(\App\Models\Brand::all() as $brand)
                            <option value="{{$brand['title']}}">{{$brand['title']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Название Вашего дилерского центра<b>*</b></label>
                    <input type="text" name="name" id="name"></div>
                <div class="form-group">
                    <label for="choice">Какие машины предоставляет дилерский центр?<b>*</b></label>
                    <div class="radio-line">
                        <div class="form-group radio">
                            <input type="radio" name="choice" id="choice"  required value="new">
                            <label for="choice">Новые</label>
                        </div>
                        <div class="form-group radio">
                            <input type="radio" name="choice" id="old"  required value="old">
                            <label for="old">С пробегом</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Рабочий e-mail<b>*</b></label>
                    <input type="text" name="email" id="email">
                </div>
                <div class="form-group form-group-center radio">
                    <input type="checkbox" name="agree" id="agree">
                    <label for="agree">Я согласен на <a class="underline" href="#"> обработку персональных данных</a>
                    </label>
                </div>
                <div class="form-group-block">
                    <button class="btn" type="submit" id="send_request" disabled>Продолжить</button>
                </div>
            </form>
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
<script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js"></script>
<script src="{{ '/js/jquery.nicescroll.min.js'}}"></script>
<script src="{{ '/js/main.js'}}"></script>
</body>
