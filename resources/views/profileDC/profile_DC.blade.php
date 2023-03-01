@extends('tamples.head_footer')

@section('content')
    <?php $dealer = \App\Models\Dealer::find(\Illuminate\Support\Facades\Auth::user()['dealerId']);?>
    <div class="header-bottom">
        <ul class="list">
            <li><a class="active" href="/profile-DC">Профиль ДЦ</a></li>
            <li><a href="/sales">Отдел продаж</a></li>
            <li><a href="/advertisement">Объявления</a></li>
            <li><a href="/statistics">Статистика</a></li>
            <li><a href="/notification">Уведомления</a></li>
            <li><a href="/support">Служба поддержки</a></li>
        </ul>
    </div>
    </header>
<section class="inactive-profile main-section">
    <div class="container">
        <div class="inactive-profile__main">
            <div class="inactive-profile__main_left">
                <div class="inactive-profile__main_left-top">
                    <div class="title-bold">{{$dealer['title']}}</div>
                    <div class="block-adress">
                        <div class="text-gray">Адрес</div>
                        <div class="adress">{{$dealer['address']}}</div>
                    </div>
                </div>
                <div class="inactive-profile__main_left-bottom">
                    <div class="inactive-profile__main_left-bottom-block">
                        <div class="title">Заполните профиль дилерского центра</div>
                        <div class="desc">Чтобы начать работать с личным кабинетом и оплачивать аккаунт,
                            <br> необходимо заполнить информацию о дилерском центре
                        </div><a class="btn" href="/profile-DC/fill">Заполнить профиль</a>
                    </div>
                </div>
            </div>
            <div class="inactive-profile__main_right">
                <div class="inactive-profile__main_right-top">
                    <div class="title">Статус аккаунта</div>
                    <div class="btn-red">Неактивен</div>
                </div><div class="inactive-profile__main_right-bottom">
                    <div class="text-gray">При создании квитанции берутся данные из реквизитов Вашего профиля. Внимательно проверьте все данные, перед оформлением квитанции для оплаты!
                    </div><a class="btn" href="#">Создать квитанцию</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
