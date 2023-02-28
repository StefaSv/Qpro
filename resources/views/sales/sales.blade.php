@extends('tamples.head_footer')

@section('content')
    <?php
    $dealer = \App\Models\Dealer::find(\Illuminate\Support\Facades\Auth::user()['dealerId']);
    $managers = \App\Models\User::where("dealerID", $dealer['id'])->where('is_fired', 0)->get();
    $num_notif = \App\Models\Notification::where('userId', '=', \Illuminate\Support\Facades\Auth::id())->get()->where('read',0)->count();
    ?>
    <div class="header-bottom">
        <ul class="list">
{{--            @if(\App\Models\Dealer::find(\Illuminate\Support\Facades\Auth::user()['dealerId'])['confirmed'] == 0)--}}
{{--                <li><a href="/registration/completed">Профиль ДЦ</a></li>--}}
            @if(is_null(\App\Models\Dealer::find(\Illuminate\Support\Facades\Auth::user()['dealerId'])['full_name']))
                <li><a href="/profile-DC">Профиль ДЦ</a></li>
            @else
                <li><a href="/profile-DC/full">Профиль ДЦ</a></li>
            @endif
            <li><a class="active" href="/sales">Отдел продаж</a></li>
            <li><a href="/advertisement">Объявления</a></li>
            <li><a href="/statistics">Статистика</a></li>
            @if($num_notif == 0)
                <li class="nav-element"><a href='/notification'>Уведомления</a></li>
            @else
                <li class="nav-element"><a href='/notification'>Уведомления<a class="num-notifications">{{$num_notif}}</a></a></li>
            @endif
            <li><a href="/support">Служба поддержки</a></li>
        </ul>
    </div>
</header>
<section class="inactive-profile main-section">
    <div class="container">
        <div class="advertisement-main">
            <h3>Отдел продаж</h3>
            <div class="advertisement-main__table">
                <div class="section-sales__main">
                    <div class="container">
                        <div class="section-sales__table">
                                <table id="example" class="table table-striped" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>
                                            <div class="table-head-sort">
                                                <span>Продавец</span>
                                            </div>
                                        </th>
                                        <th>Телефон</th>
                                        <th>
                                            <div class="table-head-sort">
                                                <span>Объявлений</span>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="table-head-sort">
                                                <span>Статус</span>
                                            </div>
                                        </th>
                                        <th>Действия</th>
                                    </tr>
                                    </thead>
                                    <tbody>
{{--                                    @for($i = 0;$i < 50;$i +=1)--}}
                                    @foreach($managers as $manager)
                                        <tr>
                                            <td>
                                                <div class="saler">
                                                    @if(isset($manager['avatar']))
                                                    <img src="{{asset($manager['avatar'])}}">
                                                    @else
                                                    <img src="{{asset('img/avatar.jpg')}}">
                                                    @endif
                                                    @if(!is_null($manager['third_name']))
                                                        <a class="name-table-cell" href="/sales/profile-manager/{{$manager['id']}}">{{$manager['surname']}} {{$manager['name']}} {{$manager['third_name']}}</a>
                                                    @else
                                                        <a class="name-table-cell" href="/sales/profile-manager/{{$manager['id']}}">{{$manager['name']." ".$manager['surname']}}</a>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <a class="seler-phone" href="tel:{{$manager['phone']}}">{{$manager['phone']}}</a>
                                            </td>
                                            <td>{{\App\Models\Offer::where('managerId', $manager['id'])->count()}}</td>
                                            <td>
                                                @if($manager['confirmed'] == 1)
                                                @if($manager['online'] == 1)
                                                    <div class="status active">Активен</div>
                                                @elseif($manager['online'] ==0)
                                                    <div class="status not-active">Неактивен</div>
                                                @endif
                                                @else
                                                    <div class="status wait">Ожидает принятия</div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="choises">
                                                    @if($manager['confirmed'] == 1)
                                                    <a class="fire" id="{{$manager['id']}}" title-tooltip="Уволить сотрудника">
                                                    </a>
                                                    @else
                                                        <a class="accept" title-tooltip="Подтвердить" href="/user/confirm/{{$manager['id']}}">
                                                        </a>
                                                        <a class="reject" title-tooltip="Отменить" href="/user/not-confirm/{{$manager['id']}}">
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>

                                    @endforeach
{{--                                    @endfor--}}
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalCenterChoise" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterChoiseTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalCenterChoiseTitle">Вы уверены, что хотите уволить сотрудника?</h4>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-gray" href="#" data-dismiss="modal">Нет</a>
                    <a class="btn btn-accept" href="#">Да</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
