@extends('tamples.head_footer')

@section('content')
    <div class="header-bottom">
        <ul class="list">
            @if(is_null(\App\Models\Dealer::find(\Illuminate\Support\Facades\Auth::user()['dealerId'])['full_name']))
                <li><a href="/profile-DC">Профиль ДЦ</a></li>
            @else
                <li><a href="/profile-DC/full">Профиль ДЦ</a></li>
            @endif
            <li><a href="/sales">Отдел продаж</a></li>
            <li><a href="/advertisement">Объявления</a></li>
            <li><a href="#">Статистика</a></li>
            <li><a href="/notification">Уведомления</a></li>
            <li><a href="/support">Служба поддержки</a></li>
        </ul>
    </div>
</header>
<section class="registration-completed section-login">
    <div class="container">
        <div class="registration-completed section-login__main">
            <div class="title">Заявка принята!</div>
            <p>На почту <a class="email" href="mailto:GenDirAuto@workmail.com">GenDirAuto@workmail.com</a> будет
                отправлено письмо с Вашим логином и паролем, после того как мы добавим Ваш дилерский центр в базу.</p>
            <p>Проверка может занять до 24-х часов.</p><a class="btn" href="#">На главный экран</a></div>
    </div>
</section>
@endsection
