@extends('tamples.head_footer')

@section('content')
    <?php $manager = \App\Models\User::find($id);
          $offers = \App\Models\Offer::where('managerId', $manager['id'])->get();
          ?>
    <div class="header-bottom">
        <ul class="list">
            <li><a href="/profile-DC">Профиль ДЦ</a></li>
            <li><a class="active" href="/sales">Отдел продаж</a></li>
            <li><a href="/advertisement">Объявления</a></li>
            <li><a href="#">Статистика</a></li>
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
                    <a class="back-page" href="{{url()->previous()}}">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.50001 12.8L14.2 18.4C14.6 18.8 15.2 18.8 15.6 18.4C16 18 16 17.4 15.6 17L10.7 12L15.6 7.00005C16 6.60005 16 6.00005 15.6 5.60005C15.4 5.40005 15.2 5.30005 14.9 5.30005C14.6 5.30005 14.4 5.40005 14.2 5.60005L8.50001 11.2C8.10001 11.7 8.10001 12.3 8.50001 12.8C8.50001 12.7 8.50001 12.7 8.50001 12.8Z"
                                fill="#1F1E21"/>
                        </svg>
                    </a>
                    <h3>Профиль менеджера</h3></div>
                <div class="profile-manager__block"><h4>Личные данные</h4>
                    <div class="profile-manager__about">
                        <div class="profile-manager__about_top">
                            <img src={{asset($manager['avatar'])}} alt="profile">
                            <div class="profile-manager__about_right">
                                @if(!is_null($manager['third_name']))
                                <div class="profile-manager__about_name">{{$manager['name']." ".$manager['surname']." ".$manager['third_name']}}</div>
                                @else
                                <div class="profile-manager__about_name">{{$manager['name']." ".$manager['surname']}}</div>
                                @endif
                                <div class="profile-manager__about_proff">{{$manager['role']}}</div>
                                @if($manager['online'] == 1)
                                <div class="profile-manager__about_status_on">Активен</div>
                                @elseif($manager['online'] ==0)
                                <div class="profile-manager__about_status_off">Неактивен</div>
                                @endif
                            </div>
                        </div>
                        <div class="profile-manager__about_wrapper">
                            <div class="profile-manager__about_block small-group">
                                <span>Номер телефона</span>
                                <a href="tel:{{$manager['phone']}}">{{$manager['phone']}}</a>
                            </div>
                            <div class="profile-manager__about_block small-group">
                                <span>Почта</span>
                                <a href="mailto:LidManager@workmail.com">{{$manager['email']}}</a>
                            </div>
                            <div class="profile-manager__about_block">
                                <span>Адрес дилерского центра</span>
                                <a href="#">{{\App\Models\Dealer::find($manager['dealerId'])['address']}}</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="profile-manager__block">
                    <div class="profile-manager__block_head"><h4>Личные данные</h4>
                        <div class="ads-count">{{\App\Models\Offer::where('managerId', $manager['id'])->count()}}</div>
                    </div>
                    @foreach($offers as $offer)
                       <?php $colors = unserialize($offer['color']); ?>
                    <div class="profile-manager__ads-list">
                        <div class="profile-manager__ads-list_item">
                            <a class="profile-manager__ads-list_left for-image" href="{{$offer['id']}}">
                                <img src={{asset("/img/01.jpg")}}>
                                <img src={{asset("/img/02.jpg")}}>
                                <img src={{asset("/img/03.jpg")}}>
                                <img src={{asset("/img/04.jpg")}}>
                                <div class="for-image">
                                    <span class="active"></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <div class="profile-manager__ads-list_right">
                                <div class="ads-item__top">
                                    <a class="ads-item__top_name" href="/sales/offer/{{$offer['id']}}">{{\App\Models\Car_model::find($offer['model'])['title']}}</a>
                                    <div class="ads-item__top_price">{{$offer['cost']}} ₽</div>
                                </div>
                                <a class="ads-item__main" href="/sales/offer/{{$offer['id']}}">
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
                                        <span>Расход, л/100 км</span>
                                        <span class="value">{{$offer['consumption']}}</span>
                                    </div>
                                    <div class="ads-item__main_block">
                                        <span>Цвет</span>
                                        @foreach($colors as $color)
                                        <span class="value color" style="background: {{\App\Models\Color::find($color)['color']}};"></span>
                                        @endforeach
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
