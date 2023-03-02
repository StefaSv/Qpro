@extends('tamples.head_footer')

@section('content')
    <?php
    $offer = \App\Models\Offer::find($offer_id);
    $colors = unserialize($offer['color']);
    ?> 
    <div class="header-bottom">
        <ul class="list">
            <li><a href="/profile-DC">Профиль ДЦ</a></li>
            <li><a href="/sales">Отдел продаж</a></li>
            <li><a href="/advertisement">Объявления</a></li>
            <li><a class= href="#">Статистика</a></li>
            <li><a href="/notification">Уведомления</a></li>
            <li><a href="/support">Служба поддержки</a></li>
        </ul>
    </div>
</header>
<section class="inactive-profile main-section">
    <div class="container">
        <div class="profile-manager">
            <div class="profile-container">
                <div class="profile-manager__head">
                    <div class="profile-manager__head_left"><a class="back-page" href="{{url()->previous()}}">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.50001 12.8L14.2 18.4C14.6 18.8 15.2 18.8 15.6 18.4C16 18 16 17.4 15.6 17L10.7 12L15.6 7.00005C16 6.60005 16 6.00005 15.6 5.60005C15.4 5.40005 15.2 5.30005 14.9 5.30005C14.6 5.30005 14.4 5.40005 14.2 5.60005L8.50001 11.2C8.10001 11.7 8.10001 12.3 8.50001 12.8C8.50001 12.7 8.50001 12.7 8.50001 12.8Z"
                                    fill="#1F1E21"/>
                            </svg>
                        </a>
                        <h3>{{\App\Models\Car_model::find($offer['model'])['title']}}</h3></div>
                    <div class="profile-manager__head_right">
                        @if($offer['is_frozen'] == 0)
                        <a class="btn-border" href="#" id="send_re">Отправить на исправление</a>
                        <a class="btn-border" href="#" id="send_fr">Приостановить объявление</a>
                        @else
                        <a class="btn-border" data-toggle="modal" href="#" data-target="#exampleModalCenterDefroze" id="send_defr">Разморозить объявленине</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="profile-container">
            <div class="advertisement-item-profile">
                <div class="advertisement-item-profile__top">
                    <div class="advertisement-item-profile__left for-image">
                        <img src="{{asset("/img/01.jpg")}}">
                        <img src="{{asset("/img/02.jpg")}}">
                        <img src="{{asset("/img/03.jpg")}}">
                        <img src="{{asset("/img/04.jpg")}}">
                        <div class="for-image">
                            <span class="active"></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <div class="advertisement-item-profile__right">
                        <div class="ads-item__top">
                            <div class="ads-item__top_name">{{\App\Models\Car_model::find($offer['model'])['title']}}</div>
                            <div class="ads-item__top_price">{{$offer['cost']}} ₽</div>
                        </div>
                        <div class="advertisement-item-profile__benefit">
                            <span>Выгода при Трейд-Ин</span>
                            <div class="price">{{$offer['priceTradeInFrom']}} - {{$offer['priceTradeInTo']}} ₽</div>
                        </div>
                        <div class="advertisement-item-profile__benefit">
                            <span>Выгода при покупке в кредит</span>
                            <div class="price">{{$offer['priceCreditFrom']}} – {{$offer['priceCreditTo']}} ₽</div>
                        </div>
                        <div class="ads-item__main">
                            <div class="ads-item__main_block">
                                <span>Двигатель</span>
                                <span class="value">{{\App\Models\Engine::find($offer['engine'])['title']}} / {{$offer['volume']}} л / {{$offer['power']}} л.с</span>
                            </div>
                            <div class="ads-item__main_block">
                                <span>КПП</span>
                                <span class="value">{{\App\Models\Transmission::find($offer['transmission'])['title']}}</span>
                            </div>
                            <div class="ads-item__main_block">
                                <span>Привод</span>
                                <span class="value">{{\App\Models\Driveunit::find($offer['drive'])['title']}}</span>
                            </div>
                            <div class="ads-item__main_block">
                                <span>Год выпуска</span>
                                <span class="value">{{$offer['year']}}</span>
                            </div>
                            <div class="ads-item__main_block">
                                <span>Разгон, 1-100 км/ч</span>
                                <span class="value">{{$offer['racing']}}</span>
                            </div>
                            <div class="ads-item__main_block">
                                <span>Расход, л/100 км</span>
                                <span class="value">{{$offer['consumption']}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="advertisement-item-profile__bottom">
                    <div class="advertisement-item-profile__bottom_item">
                        <h4>Описание</h4>
                        <p>{{$offer['desc']}}</p>
                    </div>
                    <div class="advertisement-item-profile__bottom_item">
                        <h4>Комплектация</h4>
                        <div class="advertisement-item-profile__bottom_main">
                            <div class="advertisement-item-profile__bottom_line">
                                <span>Количество мест</span>
                                <p>{{\App\Models\Parameter::find($num_seats[0])['title']}}</p>
                            </div>
                            <div class="advertisement-item-profile__bottom_line">
                                <span>Фары</span>
                                <p>{{\App\Models\Parameter::find($lights[0])['title']}}</p>
                            </div>
                            <div class="advertisement-item-profile__bottom_line">
                                <span>Зимний пакет</span>
                                @foreach($winter_package as $win)
                                    <p>{{\App\Models\Parameter::find($win)['title']}}</p>
                                @endforeach
                            </div>
                            <div class="advertisement-item-profile__bottom_line">
                                <span>Комфорт</span>
                                @foreach($comfort as $com)
                                    <p>{{\App\Models\Parameter::find($com)['title']}}</p>
                                @endforeach
                            </div>
                            <div class="advertisement-item-profile__bottom_line">
                                <span>Мультимедиа</span>
                                @foreach($multimedia as $mul)
                                    <p>{{\App\Models\Parameter::find($mul)['title']}}</p>
                                @endforeach
                            </div>
                            <div class="advertisement-item-profile__bottom_line">
                                <span>Салон</span>
                                @foreach($salon as $sal)
                                    <p>{{\App\Models\Parameter::find($sal)['title']}}</p>
                                @endforeach
                            </div>
                            <div class="advertisement-item-profile__bottom_line">
                                <span>Доступные цвета</span>
                                @foreach($colors as $color)
                                    <p>{{\App\Models\Color::find($color)['title']}}</p>
{{--                                    <span class="value color" style="background: {{\App\Models\Color::find($color)['color']}};"></span>--}}
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    <div class="modal fade" id="exampleModalCenterRead" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterReadTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalCenterReadTitle">Исправление объявления</h4>
                    <div class="close" data-dismiss="modal" aria-label="Close"></div>
                </div>
                <div class="modal-body">
                    <form method="post">
                        @csrf
                        <div class="form-group">
                            <label for="desc">Описание <b>*</b></label>
                            <textarea rows="15" name="desc" id="desc" required
                                      placeholder="Опишите, что следует изменить в объявлении"></textarea>
                        </div>
                        <input id="offer_id" value="{{$offer_id}}" hidden>
                    </form>
                    <div class="form-group form-group-btn">
                        <button class="btn" id="send_ch">Отправить</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalCenterStop" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterStopTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalCenterStopTitle">Приостановка объявления</h4>
                    <div class="close" data-dismiss="modal" aria-label="Close"></div>
                </div>
                <div class="modal-body">
                    <form>
                        @csrf
                        <div class="form-group">
                            <label for="desc_stop">Описание <b>*</b></label>
                            <textarea rows="15" name="desc_stop" id="desc_stop" required
                                      placeholder="Опишите причину приостановки объявления"></textarea>
                            <input id="offer_id" value="{{$offer_id}}" hidden>
                            <input id="type_send" value="button" hidden>
                        </div>
                    </form>
                    <div class="form-group form-group-btn">
                        <button class="btn" id="info_send">Отправить</button>
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
                    <h4 class="modal-title" id="exampleModalCenterChoiseTitle">Вы уверены, что хотите заморозить
                        объявление?</h4>
                </div>
                <div class="modal-body">
                    <p>Чтобы заморозить объявление необходимо указать причину</p>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-gray" href="#" data-dismiss="modal">Нет</a>
                    <a class="btn `btn-accept`" id="info_choice" href="#">Да</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalCenterDefroze" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterChoiseTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalCenterChoiseTitle">Вы уверены, что хотите разморозить
                        объявление?</h4>
                </div>
                <div class="modal-body">
                    <p>Нажмите "Да", чтобы разморозить объявление</p>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-gray" href="#" data-dismiss="modal">Нет</a>
                    <input id="offer_id" value="{{$offer['id']}}" hidden>
                    <input id="type_send" value="button" hidden>
                    <a class="btn btn-accept" href="#" id="defroze">Да</a>
                </div>
            </div>
        </div>
    </div>
@endsection
