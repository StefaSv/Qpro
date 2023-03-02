@extends('tamples.head_footer')

@section('content')
    <?php $notifications = \App\Models\Notification::where('userId', '=', \Illuminate\Support\Facades\Auth::id())->get();
    $num_notif = $notifications->where('read',0)->count();
    foreach ($notifications as $notification) {
        $notification['message'] = preg_replace("~(http|https|ftp|ftps)://(.*?)(\s|\n|[,.?!](\s|\n)|$)~", '<a class="info-sub" href="$1://$2">$1://$2</a>$3', $notification['message']);
    }

    ?>
        <div class="header-bottom">
            <ul class="list">
                @if(is_null(\App\Models\Dealer::find(\Illuminate\Support\Facades\Auth::user()['dealerId'])['full_name']))
                    <li><a href="/profile-DC">Профиль ДЦ</a></li>
                @else
                    <li><a href="/profile-DC/full">Профиль ДЦ</a></li>
                @endif
                <li><a href="/sales">Отдел продаж</a></li>
                <li><a href="/advertisement">Объявления</a></li>
                <li><a href="/statistics">Статистика</a></li>
                    @if($num_notif == 0)
                        <li class="active"><a href='/notification'>Уведомления</a></li>
                    @else
                        <li class="active"><a href='/notification'>Уведомления<a class="num-notifications" id="{{$num_notif}}">{{$num_notif}}</a></a></li>
                    @endif

                <li><a href="/support">Служба поддержки</a></li>
            </ul>
        </div>
    </div>
</header>
<section class="inactive-profile main-section">
    <div class="container">
        <div class="section-notification">
            <div class="section-notification__left">
                <div class="section-notification__left_head">
                    <h4>Уведомления</h4>
                    <a class="read-all" href="#" id="{{\Illuminate\Support\Facades\Auth::id()}}">Прочитать все</a>
                </div>
                <div class="section-notification__left_body">
                    <div class="section-notification__left_body">
                        @foreach($notifications as $notification)
                            @if($notification['read'] == 0)
                        <a class="section-notification__left_item new-message choises" id="{{$notification['id']}}">
                            @else
                        <a class="section-notification__left_item" id="{{$notification['id']}}">
                            @endif
                            <div class="section-notification__left_date">11.11.2011 13:34</div>
                            <div class="section-notification__left_excerpt" id="{{$notification['title']}}" hidden>{{$notification['title']}}</div>
                            <div class="section-notification__left_excerpt" id="{{$notification['message']}}">{{$notification['message']}}</div>
                        </a>

                        @endforeach
                    </div>
                </div>
            </div>


            <div class="section-notification__right">
                @if($notifications->count() != 0)
                <h3 id="titleB">{{$notifications[0]['title']}}</h3>
                <div class="section-notification__right_full-text">
                    {{$notifications[0]['message']}}
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
