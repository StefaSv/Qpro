@extends('tamples.head_footer')

@section('content')
    <?php
    $dealer = \App\Models\Dealer::find(\Illuminate\Support\Facades\Auth::user()['dealerId']);
    $paid = \App\Models\Pay_account::where('dealerId', '=', $dealer['id'])->get();
    $active_pay = $paid->where('is_start','=',1)->where('is_over','=',0)->first();
    $wait_pay = $paid->where('is_payd','=',0)->first();
    $num_notif = \App\Models\Notification::where('userId', '=', \Illuminate\Support\Facades\Auth::id())->get()->where('read',0)->count();
    use Carbon\Carbon;
//    dd($paid, $active_pay, $wait_pay)
    ?>


    <div class="header-bottom">
        <ul class="list">
            <li><a class="active" href="/profile-DC">Профиль ДЦ</a></li>
            <li><a href="/sales">Отдел продаж</a></li>
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
        <div class="inactive-profile__main">
            <div class="inactive-profile__main_left">
                <div class="inactive-profile__main_left-top" style="display: flex">
                    <div>
                        <div class="title-bold">{{$dealer['title']}}</div>
                        <div class="block-adress">
                            <div class="text-gray">Адрес</div>
                            <div class="adress">{{$dealer['address']}}</div>
                        </div>
                        <div class="block-adress">
                            <div class="text-gray">Сайт</div>
                            <a href="{{$dealer['site_dc']}}" class="info-text">{{$dealer['site_dc']}}</a>
                        </div>
                    </div>
                    <a class="btn back-btn" href="/profile-DC/change" style="position: absolute; margin-left: 51.8%">Изменить профиль</a>
                </div>
                <div class="inactive-profile__main_left-bottom">
                    <div class="inactive-profile__main_left-bottom-block">
                        <div class="info-dc"><h4>Реквизиты</h4>
                            <div class="info-dc__main">
                                <div class="info-dc__item">
                                    <span class="label">Полное наименование организации</span>
                                    <span class="info-text" id="{{$dealer['full_name']}}">{{$dealer['full_name']}}</span>
                                </div>
                                <div class="info-dc__item">
                                    <span class="label">Бренды (Чтобы увеличить количество брендов, обратитесь в службу поддержки)</span>
                                    @foreach(unserialize($dealer['brand']) as $brand)
                                    <span class="info-text" id="{{\App\Models\Brand::find($brand)['title']}}">{{\App\Models\Brand::find($brand)['title']}}</span>
                                    @endforeach
                                </div>
                                <div class="info-dc__item">
                                    <span class="label">Телефон ДЦ</span>
                                    <span class="info-text" id="{{$dealer['phone_center']}}">{{$dealer['phone_center']}}</span>
                                </div>
                                <div class="info-dc__item">
                                    <span class="label">Юридический адрес</span>
                                    <span class="info-text" id="{{$dealer['yor_address']}}">{{$dealer['yor_address']}}</span>
                                </div>
                                <div class="info-dc__item">
                                    <span class="label">Почтовый адрес</span>
                                    <span class="info-text" id="{{$dealer['post_address']}}">{{$dealer['post_address']}}</span>
                                </div>
                                <div class="info-dc__item">
                                    <span class="label">ИНН</span>
                                    <span class="info-text" id="{{$dealer['inn']}}">{{$dealer['inn']}}</span>
                                </div>
                                <div class="info-dc__item">
                                    <span class="label">КПП</span>
                                    <span class="info-text" id="{{$dealer['kpp']}}">{{$dealer['kpp']}}</span>
                                </div>
                                <div class="info-dc__item">
                                    <span class="label">БИК</span>
                                    <span class="info-text" id="{{$dealer['bik']}}">{{$dealer['bik']}}</span>
                                </div>
                                <div class="info-dc__item">
                                    <span class="label">ОГРН</span>
                                    <span class="info-text" id="{{$dealer['ogrn']}}">{{$dealer['ogrn']}}</span>
                                </div>
                                <div class="info-dc__item">
                                    <span class="label">ОКПО</span>
                                    <span class="info-text" id="{{$dealer['okpo']}}">{{$dealer['okpo']}}</span>
                                </div>
                                <div class="info-dc__item">
                                    <span class="label">ОКАТО</span>
                                    <span class="info-text" id="{{$dealer['okato']}}">{{$dealer['okato']}}</span>
                                </div>
                                <div class="info-dc__item">
                                    <span class="label">Генеральный директор</span>
                                    <span class="info-text" id="{{$dealer['name_director']}}">{{$dealer['name_director']}}</span>
                                </div>
                                <div class="info-dc__item">
                                    <span class="label">Электронная почта ДЦ</span>
                                    <span class="info-text" id="{{$dealer['email_dc']}}">{{$dealer['email_dc']}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="inactive-profile__main_right">
                <div class="inactive-profile__main_right-top">
                    <div class="title">Статус аккаунта</div>
                    @if(isset($active_pay))
                    <div class="btn-green">Оплачен и активен</div>
                    @elseif(isset($wait_pay))
                    <div class="btn-yellow">Ожидает оплаты</div>
                    @else
                        <div class="btn-yellow">Ожидает оплаты</div>
                    @endif
                </div>
                <div class="inactive-profile__main_right-top">
                    @if(isset($active_pay))
                        <div class="paid-and-active">
                            <div class="paid-and-active__left"><span>Дата действия, до</span>
                                <div class="date">{{$active_pay['date_start']}}</div>
                            </div>
                            <div class="paid-and-active__right"><span>Дата оплаты</span>
                                <div class="date">{{$active_pay['date_over']}}</div>
                            </div>
                            <a class="btn-gray" href="#" data-toggle="modal" data-target="#exampleModalHistory">История платежей</a>
                        </div>
                    @elseif(isset($wait_pay))
                        <div class="paid-and-active">
                            <div class="paid-and-active__left"><span>Дата оплаты</span>
                                <div class="date">{{$wait_pay['date_start']}}</div>
                            </div>
                            <div class="paid-and-active__right"><span>Дата действия, до</span>
                                <div class="date">{{$wait_pay['date_over']}}</div>
                            </div>
                            <a class="btn-gray" href="#" data-toggle="modal" data-target="#exampleModalHistory">История платежей</a>
                        </div>
                    @else
                        <div class="text-gray mb-3">
                            <div class="form-group" style="margin-top: 8px">
                                <div class="paid-and-active">
                                    <div class="date" style =
                                    "margin-right:40px;
                                    font-size: 22px;
                                    font-weight: 400;
                                    text-decoration:line-through;">99 000 ₽</div>
                                    <div class="date" style=
                                    "font-size: 22px;
                                    font-weight: 400;">49 000 ₽</div>
                            </div>
                                <a class="btn" id="choice_pay" href="#" style="margin-top: 5px; margin-bottom: 5px;">Начать пользоваться</a>
{{--                                <form method="post">--}}
{{--                                    <label for="tariff">Выберите тип подписки:</label>--}}
{{--                                    <select name="tariff" id="tariff">--}}
{{--                                        <option value="" selected="selected" disabled="disabled">Выберите из списка</option>--}}
{{--                                        @foreach(\App\Models\Tariff::all() as $tariff)--}}
{{--                                            <option value="{{$tariff['id']}}">{{$tariff['title']}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </form>--}}
                                <div class="bottom">
                                    <a class="info-sub" href="#" data-toggle="modal" data-target="#exampleModalSubs">Подробнее о подписках</a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="inactive-profile__main_right-bottom">
                    <div class="text-gray">В данный момент доступ ограничен к приложению для сотрудников автосалона Qseller
                    </div>
                    @if(isset($wait_pay) or isset($active_pay))
                    <a class="btn-gray" id="choice_pay1" href="#" hidden>Сформировать счёт</a>
                    @else
{{--                    <a class="btn" id="choice_pay" href="#">Сформировать счёт</a>--}}
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
    <div class="modal fade" id="exampleModalWarn" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalChangePostPhone" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalChangePostPhone">Что бы взаимодействовать с подписками дополните данные вашего ДЦ</h4>
                </div>
                <div class="modal-footer">
                    <a class="btn" href="#" data-dismiss="modal">Хорошо</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalReceipt" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalChangePostPhone" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalChangePostPhone">Подтверждение формирования счёта</h4>
                </div>
                <div class="modal-body ">
                    <form id= "receipt" method="post" action="/profile-DC/pay_account">
                        @csrf
                        <div class="form-group" id="choice_pay_form">
                            <label class="mt-0">Обычно оплата проходит в течение 24 часов с момента её подтверждения</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-gray" href="#" data-dismiss="modal">Отмена</a>
                    <button class="btn" form = "receipt">Сформировать</button>
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalSubs" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterChoiseTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalCenterChoiseTitle">О тарифах</h4>
                </div>

                <div class="modal-body">
                    @foreach(\App\Models\Tariff::all() as $tariff)
                    <p class="text-days">{{$tariff['title']}}</p>
                    <p class="text-mini mt-0">{{$tariff['description']}}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="modal-history modal modal-notification2 fade" id="exampleModalHistory" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalHistoryLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title" id="exampleModalHistoryLabel">История платежей</div>
                </div>
                <div class="modal-body">
                    <div class="history-payment">
                        @foreach(\App\Models\Pay_account::where('dealerId', '=',$dealer['id'])->where('is_over','=',1)->get() as $pay)
                        <div class="history-payment__item">
                            <div class="history-payment__mouth">{{$pay['days']}}  дней</div>
                            <div class="history-payment__date">{{$pay['date_start']}}</div>
                            <div class="history-payment__mouth">{{$pay['pay_type']}}</div>
                            <div class="history-payment__cost">{{$pay['summ']}} ₽</div>
                            <a class="check" id="{{$pay['id']}}" title-tooltip="Посмотреть подробный чек"></a>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" type="button">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
@endsection
