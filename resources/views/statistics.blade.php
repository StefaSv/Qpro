<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="{{asset('/css/datatables.css')}}">
    <link rel="stylesheet" href="{{asset('/css/select.css')}}">
<!-- {{--        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">--}} -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('/css/style.min.css')}}">
    <link rel="stylesheet" href="https://gistcdn.githack.com/mfd/09b70eb47474836f25a21660282ce0fd/raw/e06a670afcb2b861ed2ac4a1ef752d062ef6b46b/Gilroy.css">
</head>
<body>
<?php
$user = \Illuminate\Support\Facades\Auth::user();
$dealer = \App\Models\Dealer::find(\Illuminate\Support\Facades\Auth::user()['dealerId']);
$managers = \App\Models\User::where("dealerID", $dealer['id'])->where('is_fired', 0)->get();
$num_notif = \App\Models\Notification::where('userId', '=', \Illuminate\Support\Facades\Auth::id())->get()->where('read',0)->count();
?>

<!--header-->
<header class="header">
    <div class="header-title-wrapper">
        <div class="header-title-inner">
            <a href="/profile-DC/full"><img  src="{{asset('/img/logo.svg')}}"></a>
            <div class="profile">
                <div class="profile-pic">
                    @if(isset($user['avatar']))
                        <img src="{{asset($user['avatar'])}}" alt="avatar">
                    @else
                        <img src="{{asset('/img/avatar.jpg')}}" alt="avatar">
                    @endif
                </div>
                <div class="profile-data">
                    <p class="profile-fullname">{{$user['name']." ".$user['surname']}}</p>

                </div>
                <a class="exit-btn" id="exit_stat" data-toggle="modal" data-target="#exampleModalLogout">
                    <img src="{{asset("/img/4.svg")}}">
                </a>
            </div>
        </div>
    </div>
    <nav class="header-nav">
        <ul>
            @if(is_null(\App\Models\Dealer::find(\Illuminate\Support\Facades\Auth::user()['dealerId'])['full_name']))
                <li class="nav-element"><a href="/profile-DC">Профиль ДЦ</a></li>
            @else
                <li class="nav-element"><a href="/profile-DC/full">Профиль ДЦ</a></li>
            @endif
            <li class="nav-element"><a href='/sales'>Отдел продаж</a></li>
            <li class="nav-element"><a href='/advertisement'>Объявления</a></li>
            <li class="nav-element active"><a href=''>Статистика</a></li>
            @if($num_notif == 0)
                <li class="nav-element"><a href='/notification'>Уведомления</a></li>
            @else
                <li class="nav-element"><a href='/notification'>Уведомления<a class="num-notifications">{{$num_notif}}</a></a></li>
            @endif
            <li class="nav-element"><a href='/support'>Служба поддержки</a></li>
        </ul>
    </nav>
</header>
<!--header-->
<link rel="stylesheet" href="{{asset('/css/style_stat.css')}}">
<link rel="stylesheet" href="https://gistcdn.githack.com/mfd/09b70eb47474836f25a21660282ce0fd/raw/e06a670afcb2b861ed2ac4a1ef752d062ef6b46b/Gilroy.css">

<!--main-->
<main>
    <div class="main-wrapper">
        <a class="main-title">Статистика</a>
        <div class="main-filters">
            <ul>
                <li id="rating" class="active">По рейтингу
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.24168 11.9083L5.00001 12.1583V5.83333C5.00001 5.61232 4.91221 5.40036 4.75593 5.24408C4.59965 5.0878 4.38769 5 4.16668 5C3.94567 5 3.7337 5.0878 3.57742 5.24408C3.42114 5.40036 3.33335 5.61232 3.33335 5.83333V12.1583L3.09168 11.9083C2.93476 11.7514 2.72193 11.6633 2.50001 11.6633C2.27809 11.6633 2.06527 11.7514 1.90835 11.9083C1.75143 12.0653 1.66327 12.2781 1.66327 12.5C1.66327 12.7219 1.75143 12.9347 1.90835 13.0917L3.57501 14.7583C3.65427 14.8342 3.74772 14.8937 3.85001 14.9333C3.94976 14.9774 4.05762 15.0002 4.16668 15.0002C4.27574 15.0002 4.3836 14.9774 4.48335 14.9333C4.58564 14.8937 4.67909 14.8342 4.75835 14.7583L6.42501 13.0917C6.50271 13.014 6.56434 12.9217 6.6064 12.8202C6.64845 12.7187 6.67009 12.6099 6.67009 12.5C6.67009 12.3901 6.64845 12.2813 6.6064 12.1798C6.56434 12.0783 6.50271 11.986 6.42501 11.9083C6.34731 11.8306 6.25507 11.769 6.15355 11.7269C6.05203 11.6849 5.94323 11.6633 5.83335 11.6633C5.72346 11.6633 5.61466 11.6849 5.51314 11.7269C5.41162 11.769 5.31938 11.8306 5.24168 11.9083ZM9.16668 6.66667H17.5C17.721 6.66667 17.933 6.57887 18.0893 6.42259C18.2455 6.26631 18.3333 6.05435 18.3333 5.83333C18.3333 5.61232 18.2455 5.40036 18.0893 5.24408C17.933 5.0878 17.721 5 17.5 5H9.16668C8.94566 5 8.7337 5.0878 8.57742 5.24408C8.42114 5.40036 8.33335 5.61232 8.33335 5.83333C8.33335 6.05435 8.42114 6.26631 8.57742 6.42259C8.7337 6.57887 8.94566 6.66667 9.16668 6.66667ZM17.5 9.16667H9.16668C8.94566 9.16667 8.7337 9.25446 8.57742 9.41074C8.42114 9.56702 8.33335 9.77899 8.33335 10C8.33335 10.221 8.42114 10.433 8.57742 10.5893C8.7337 10.7455 8.94566 10.8333 9.16668 10.8333H17.5C17.721 10.8333 17.933 10.7455 18.0893 10.5893C18.2455 10.433 18.3333 10.221 18.3333 10C18.3333 9.77899 18.2455 9.56702 18.0893 9.41074C17.933 9.25446 17.721 9.16667 17.5 9.16667ZM17.5 13.3333H9.16668C8.94566 13.3333 8.7337 13.4211 8.57742 13.5774C8.42114 13.7337 8.33335 13.9457 8.33335 14.1667C8.33335 14.3877 8.42114 14.5996 8.57742 14.7559C8.7337 14.9122 8.94566 15 9.16668 15H17.5C17.721 15 17.933 14.9122 18.0893 14.7559C18.2455 14.5996 18.3333 14.3877 18.3333 14.1667C18.3333 13.9457 18.2455 13.7337 18.0893 13.5774C17.933 13.4211 17.721 13.3333 17.5 13.3333Z" fill="currentColor"/>
                    </svg>
                </li>
                <li id="num_adv">По кол-ву объявлений
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.24168 11.9083L5.00001 12.1583V5.83333C5.00001 5.61232 4.91221 5.40036 4.75593 5.24408C4.59965 5.0878 4.38769 5 4.16668 5C3.94567 5 3.7337 5.0878 3.57742 5.24408C3.42114 5.40036 3.33335 5.61232 3.33335 5.83333V12.1583L3.09168 11.9083C2.93476 11.7514 2.72193 11.6633 2.50001 11.6633C2.27809 11.6633 2.06527 11.7514 1.90835 11.9083C1.75143 12.0653 1.66327 12.2781 1.66327 12.5C1.66327 12.7219 1.75143 12.9347 1.90835 13.0917L3.57501 14.7583C3.65427 14.8342 3.74772 14.8937 3.85001 14.9333C3.94976 14.9774 4.05762 15.0002 4.16668 15.0002C4.27574 15.0002 4.3836 14.9774 4.48335 14.9333C4.58564 14.8937 4.67909 14.8342 4.75835 14.7583L6.42501 13.0917C6.50271 13.014 6.56434 12.9217 6.6064 12.8202C6.64845 12.7187 6.67009 12.6099 6.67009 12.5C6.67009 12.3901 6.64845 12.2813 6.6064 12.1798C6.56434 12.0783 6.50271 11.986 6.42501 11.9083C6.34731 11.8306 6.25507 11.769 6.15355 11.7269C6.05203 11.6849 5.94323 11.6633 5.83335 11.6633C5.72346 11.6633 5.61466 11.6849 5.51314 11.7269C5.41162 11.769 5.31938 11.8306 5.24168 11.9083ZM9.16668 6.66667H17.5C17.721 6.66667 17.933 6.57887 18.0893 6.42259C18.2455 6.26631 18.3333 6.05435 18.3333 5.83333C18.3333 5.61232 18.2455 5.40036 18.0893 5.24408C17.933 5.0878 17.721 5 17.5 5H9.16668C8.94566 5 8.7337 5.0878 8.57742 5.24408C8.42114 5.40036 8.33335 5.61232 8.33335 5.83333C8.33335 6.05435 8.42114 6.26631 8.57742 6.42259C8.7337 6.57887 8.94566 6.66667 9.16668 6.66667ZM17.5 9.16667H9.16668C8.94566 9.16667 8.7337 9.25446 8.57742 9.41074C8.42114 9.56702 8.33335 9.77899 8.33335 10C8.33335 10.221 8.42114 10.433 8.57742 10.5893C8.7337 10.7455 8.94566 10.8333 9.16668 10.8333H17.5C17.721 10.8333 17.933 10.7455 18.0893 10.5893C18.2455 10.433 18.3333 10.221 18.3333 10C18.3333 9.77899 18.2455 9.56702 18.0893 9.41074C17.933 9.25446 17.721 9.16667 17.5 9.16667ZM17.5 13.3333H9.16668C8.94566 13.3333 8.7337 13.4211 8.57742 13.5774C8.42114 13.7337 8.33335 13.9457 8.33335 14.1667C8.33335 14.3877 8.42114 14.5996 8.57742 14.7559C8.7337 14.9122 8.94566 15 9.16668 15H17.5C17.721 15 17.933 14.9122 18.0893 14.7559C18.2455 14.5996 18.3333 14.3877 18.3333 14.1667C18.3333 13.9457 18.2455 13.7337 18.0893 13.5774C17.933 13.4211 17.721 13.3333 17.5 13.3333Z" fill="currentColor"/>
                    </svg>
                </li>
                <li id="num_chat">По кол-ву чатов
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.24168 11.9083L5.00001 12.1583V5.83333C5.00001 5.61232 4.91221 5.40036 4.75593 5.24408C4.59965 5.0878 4.38769 5 4.16668 5C3.94567 5 3.7337 5.0878 3.57742 5.24408C3.42114 5.40036 3.33335 5.61232 3.33335 5.83333V12.1583L3.09168 11.9083C2.93476 11.7514 2.72193 11.6633 2.50001 11.6633C2.27809 11.6633 2.06527 11.7514 1.90835 11.9083C1.75143 12.0653 1.66327 12.2781 1.66327 12.5C1.66327 12.7219 1.75143 12.9347 1.90835 13.0917L3.57501 14.7583C3.65427 14.8342 3.74772 14.8937 3.85001 14.9333C3.94976 14.9774 4.05762 15.0002 4.16668 15.0002C4.27574 15.0002 4.3836 14.9774 4.48335 14.9333C4.58564 14.8937 4.67909 14.8342 4.75835 14.7583L6.42501 13.0917C6.50271 13.014 6.56434 12.9217 6.6064 12.8202C6.64845 12.7187 6.67009 12.6099 6.67009 12.5C6.67009 12.3901 6.64845 12.2813 6.6064 12.1798C6.56434 12.0783 6.50271 11.986 6.42501 11.9083C6.34731 11.8306 6.25507 11.769 6.15355 11.7269C6.05203 11.6849 5.94323 11.6633 5.83335 11.6633C5.72346 11.6633 5.61466 11.6849 5.51314 11.7269C5.41162 11.769 5.31938 11.8306 5.24168 11.9083ZM9.16668 6.66667H17.5C17.721 6.66667 17.933 6.57887 18.0893 6.42259C18.2455 6.26631 18.3333 6.05435 18.3333 5.83333C18.3333 5.61232 18.2455 5.40036 18.0893 5.24408C17.933 5.0878 17.721 5 17.5 5H9.16668C8.94566 5 8.7337 5.0878 8.57742 5.24408C8.42114 5.40036 8.33335 5.61232 8.33335 5.83333C8.33335 6.05435 8.42114 6.26631 8.57742 6.42259C8.7337 6.57887 8.94566 6.66667 9.16668 6.66667ZM17.5 9.16667H9.16668C8.94566 9.16667 8.7337 9.25446 8.57742 9.41074C8.42114 9.56702 8.33335 9.77899 8.33335 10C8.33335 10.221 8.42114 10.433 8.57742 10.5893C8.7337 10.7455 8.94566 10.8333 9.16668 10.8333H17.5C17.721 10.8333 17.933 10.7455 18.0893 10.5893C18.2455 10.433 18.3333 10.221 18.3333 10C18.3333 9.77899 18.2455 9.56702 18.0893 9.41074C17.933 9.25446 17.721 9.16667 17.5 9.16667ZM17.5 13.3333H9.16668C8.94566 13.3333 8.7337 13.4211 8.57742 13.5774C8.42114 13.7337 8.33335 13.9457 8.33335 14.1667C8.33335 14.3877 8.42114 14.5996 8.57742 14.7559C8.7337 14.9122 8.94566 15 9.16668 15H17.5C17.721 15 17.933 14.9122 18.0893 14.7559C18.2455 14.5996 18.3333 14.3877 18.3333 14.1667C18.3333 13.9457 18.2455 13.7337 18.0893 13.5774C17.933 13.4211 17.721 13.3333 17.5 13.3333Z" fill="currentColor"/>
                    </svg>
                </li>
                <li id="num_view">По кол-ву просмотров
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.24168 11.9083L5.00001 12.1583V5.83333C5.00001 5.61232 4.91221 5.40036 4.75593 5.24408C4.59965 5.0878 4.38769 5 4.16668 5C3.94567 5 3.7337 5.0878 3.57742 5.24408C3.42114 5.40036 3.33335 5.61232 3.33335 5.83333V12.1583L3.09168 11.9083C2.93476 11.7514 2.72193 11.6633 2.50001 11.6633C2.27809 11.6633 2.06527 11.7514 1.90835 11.9083C1.75143 12.0653 1.66327 12.2781 1.66327 12.5C1.66327 12.7219 1.75143 12.9347 1.90835 13.0917L3.57501 14.7583C3.65427 14.8342 3.74772 14.8937 3.85001 14.9333C3.94976 14.9774 4.05762 15.0002 4.16668 15.0002C4.27574 15.0002 4.3836 14.9774 4.48335 14.9333C4.58564 14.8937 4.67909 14.8342 4.75835 14.7583L6.42501 13.0917C6.50271 13.014 6.56434 12.9217 6.6064 12.8202C6.64845 12.7187 6.67009 12.6099 6.67009 12.5C6.67009 12.3901 6.64845 12.2813 6.6064 12.1798C6.56434 12.0783 6.50271 11.986 6.42501 11.9083C6.34731 11.8306 6.25507 11.769 6.15355 11.7269C6.05203 11.6849 5.94323 11.6633 5.83335 11.6633C5.72346 11.6633 5.61466 11.6849 5.51314 11.7269C5.41162 11.769 5.31938 11.8306 5.24168 11.9083ZM9.16668 6.66667H17.5C17.721 6.66667 17.933 6.57887 18.0893 6.42259C18.2455 6.26631 18.3333 6.05435 18.3333 5.83333C18.3333 5.61232 18.2455 5.40036 18.0893 5.24408C17.933 5.0878 17.721 5 17.5 5H9.16668C8.94566 5 8.7337 5.0878 8.57742 5.24408C8.42114 5.40036 8.33335 5.61232 8.33335 5.83333C8.33335 6.05435 8.42114 6.26631 8.57742 6.42259C8.7337 6.57887 8.94566 6.66667 9.16668 6.66667ZM17.5 9.16667H9.16668C8.94566 9.16667 8.7337 9.25446 8.57742 9.41074C8.42114 9.56702 8.33335 9.77899 8.33335 10C8.33335 10.221 8.42114 10.433 8.57742 10.5893C8.7337 10.7455 8.94566 10.8333 9.16668 10.8333H17.5C17.721 10.8333 17.933 10.7455 18.0893 10.5893C18.2455 10.433 18.3333 10.221 18.3333 10C18.3333 9.77899 18.2455 9.56702 18.0893 9.41074C17.933 9.25446 17.721 9.16667 17.5 9.16667ZM17.5 13.3333H9.16668C8.94566 13.3333 8.7337 13.4211 8.57742 13.5774C8.42114 13.7337 8.33335 13.9457 8.33335 14.1667C8.33335 14.3877 8.42114 14.5996 8.57742 14.7559C8.7337 14.9122 8.94566 15 9.16668 15H17.5C17.721 15 17.933 14.9122 18.0893 14.7559C18.2455 14.5996 18.3333 14.3877 18.3333 14.1667C18.3333 13.9457 18.2455 13.7337 18.0893 13.5774C17.933 13.4211 17.721 13.3333 17.5 13.3333Z" fill="currentColor"/>
                    </svg>
                </li>
            </ul>
        </div>
        <div class="cards-container">
            <div class="cards-row">
                @foreach($managers as $manager)
                <div class="card-element">
                    <div class="card-header">
                        <img class="card-pic" src = {{asset($manager['avatar'])}} alt="profile">
                        <a class="card-fullname" href="/sales/profile-manager/{{$manager['id']}}">{{$manager['name']." ".$manager['surname']." ".$manager['third_name']}}</a>
                        <div class="card-rating">
                            <img src={{asset('img/star.svg')}}>
                            {{$manager['rating']}}
                        </div>
                    </div>
                    <div class="card-content">

                        <div class="card-content-line">
                            <a class="card-content-line-title">Объявления:</a>
                            <a class="card-content-line-data">{{\App\Models\Offer::where('managerId', $manager['id'])->count()}}</a>
                        </div>

                        <div class="card-content-line">
                            <a class="card-content-line-title">Чаты:</a>
                            <a class="card-content-line-data">9</a>
                        </div>

                        <div class="card-content-line">
                            <?php
                                $num_adv = 0;
                                foreach(\App\Models\Offer::where('managerId', $manager['id'])->get() as $offer){
                                    $num_adv += $offer['views'];
                                }
                            ?>
                            <a class="card-content-line-title">Просмотры объявлений:</a>
                            <a class="card-content-line-data">{{$num_adv}}</a>
                        </div>

                    </div>
                </div>
                @endforeach


            </div>
        </div>
    </div>
    
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
</main>
<!--main-->

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
    <!-- <script src = "{{asset('js/datatables.js')}}"></script>                    -->
    <script src = "{{asset('js/main.js')}}"></script>
    <script src = "{{asset('js/booststrap.js')}}"></script>
    <script src="{{ asset('/js/jquery.toast.js')}}"></script>
</body>

</html>

