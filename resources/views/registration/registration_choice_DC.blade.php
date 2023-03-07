<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Carseller</title>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="./img/icon.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('/css/style.min.css')}}">
</head>
</html>
<body>
@if(isset($data1))
    <?php $data = unserialize($data1) ?>
@endif


<section class="registration-application section-login">
    <div class="container">
        <div class="section-registration__main section-login__main">
            <div class="title">Заявка на добавление ДЦ</div>
            <div class="desc">Выберите дилерский центр, к которому будет привязан аккаунт</div>
            <form>
                @csrf
                <div class="form-group">
                    <label for="region">Регион<b>*</b></label>
                    <select name="region" id="region">
                        <option value="" selected="selected" disabled="disabled">Выберите из списка</option>
                            <option value="42">Москва и МО</option>
                            <option value="37">Ленинградская область</option>
                            @foreach(\App\Models\New_location::where('id','!=',42)->where('id','!=',37)->get() as $location)
                            <option value="{{$location['id']}}">{{$location['title']}}</option>
                            @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="brand">Бренд<b>*</b></label>
                    <select name="brand" id="brand" disabled>
                        <option id ="opt_brand" value="" selected="selected" disabled="disabled">Выберите из списка</option>
                        <option value="64">МУЛЬТИБРЕНД (Неофициальные дилеры)</option>
                        @foreach(\App\Models\Brand::all()->sortBy('title') as $brand)
                            <option value="{{$brand['id']}}">{{$brand['title']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" id="center_choice">
                    <label for="center">Дилерский центр<b>*</b></label>
                    <select name="center" id="center" disabled>
                        <option value="" selected="selected" disabled="disabled">Выберите из списка</option>
                    </select>
                </div>
                <div class="form-group not-found-center disabled">
                    <a href="/registration/new-DC" >Не нашёл свой дилерский центр</a>
                </div>
                <div class="form-group-block">
                    <a class="btn" href="#" id="send_request" style="cursor:pointer">Продолжить</a>
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
<script src="{{ asset('/js/jquery.nicescroll.min.js')}}"></script>
<script src="{{ asset('/js/main.js')}}"></script>
</body>
