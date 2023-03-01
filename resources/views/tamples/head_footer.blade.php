<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Carseller</title>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('/css/datatables.css')}}">
    <link rel="stylesheet" href="{{asset('/css/select.css')}}">
{{--        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('/css/style.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/inet.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/jquery.toast.css')}}">


</head>
</html>
<body>
<header>
    <?php
        $user = \Illuminate\Support\Facades\Auth::user();
        //dd(is_null(\App\Models\Dealer::find(\Illuminate\Support\Facades\Auth::user()['dealerId'])['full_name']));
    ?>
    <div class="header-top">
        <div class="header-top__main">
            <div class="header-top__main_left">
                @if(is_null(\App\Models\Dealer::find(\Illuminate\Support\Facades\Auth::user()['dealerId'])['full_name']))
                    <a href="/profile-DC">
                @else
                    <a href="/profile-DC/full">
                @endif
                    <img src="{{asset("/img/NewLogo.svg")}}" alt="logo">
                </a>
            </div>
            <div class="header-top__main_right">
                <a class="header-top__main_right-user" href="/profile-data">
                    @if(isset($user['avatar']))
                        <img src="{{asset($user['avatar'])}}" alt="avatar">
                    @else
                        <img src="{{asset('/img/avatar.jpg')}}" alt="avatar">
                    @endif
{{--                    <img src="{{asset("/img/2.jpg")}}" alt="2">--}}
                    <div class="header-top__main_right-user-name">
                        <div class="name">{{$user['name']." ".$user['surname']}}</div>
                    </div>
                </a>
                <a class="exit" data-toggle="modal" data-target="#exampleModalLogout">
                    <img src="{{asset("/img/4.svg")}}" alt="4">
                </a>
            </div>
        </div>
    </div>

    @yield('content')

    <div class="modal fade" id="exampleModalLogout" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterChoiseTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalCenterChoiseTitle">Вы уверены, что хотите выйти из аккаунта?</h4>
                </div>
                <div class="modal-body">
                    <p>Нажав на кнопку "Да" вы выйдете из аккаунта, но сможете потом авторизоваться с помощью логина и пароля.</p>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-gray" href="#" data-dismiss="modal">Нет</a>
                    <a class="btn btn-red" href="/logout">Да</a>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="footer-bottom">
            <div class="footer-bottom__left">
                <div class="support">Поддержка:</div>
                <a href="tel:88005353535">8 (800) 535 - 35 - 35</a>
                <div class="poloci"> Политика обработки персональных данных
                </div>
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
    <script src = "{{asset('js/jquery.js')}}"></script>
    <script src = "{{asset('js/select.js')}}"></script>
    <script src = "{{asset('js/jquery.nicescroll.min.js')}}"></script>
    <script src = "{{asset('js/move.js')}}"></script>
    <script src = "{{asset('js/datatables.js')}}"></script>
    <script src = "{{asset('js/main.js')}}"></script>
    <script src = "{{asset('js/booststrap.js')}}"></script>
    <script src="{{ asset('/js/jquery.toast.js')}}"></script>
</body>
