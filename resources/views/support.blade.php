@extends('tamples.head_footer')

@section('content')
    <?php
    $num_notif = \App\Models\Notification::where('userId', '=', \Illuminate\Support\Facades\Auth::id())->get()->where('read',0)->count();
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
                    <li class="nav-element"><a href='/notification'>Уведомления</a></li>
                @else
                    <li class="nav-element"><a href='/notification'>Уведомления<a class="num-notifications">{{$num_notif}}</a></a></li>
                @endif
            <li><a class="active" href="/support">Служба поддержки</a></li>
        </ul>
    </div>
</header>
<section class="inactive-profile main-section">
    <div class="container">
        <div class="profile-container">
            <div class="section-support">
                <div class="section-support__head">Подробно опишите Вашу проблему или вопрос оператору</div>
                <div class="section-support__content">
{{--                                            <div class="section-support__content_item sended"><p>Сообщение от директора</p>--}}
{{--                                                <div class="section-support__content_time">время</div>--}}
{{--                                            </div>--}}
{{--                                            <div class="section-support__content_item new-message"><p>Сооьщение от админа</p>--}}
{{--                                                <div class="section-support__content_time">{{date('h:i',strtotime('now')}}</div>--}}
{{--                                            </div>--}}
{{--                                    <div class="end-conv">--}}
{{--                                        <div class="text-end-conv">--}}
{{--                                            Оператор закрыл ваш вопрос--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                </div>
                <form id="send_message" class="section-support__footer position-relative">
                    @csrf
                    <div class="form-group add_file">

                        <input type="file" name="file" id="file">
                        <label for="file">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M18.08 12.42L11.9 18.61C11.0898 19.33 10.0352 19.7133 8.95173 19.6814C7.86831 19.6495 6.83801 19.2049 6.07158 18.4385C5.30515 17.672 4.86052 16.6417 4.82862 15.5583C4.79673 14.4749 5.17999 13.4202 5.90001 12.61L13.9 4.61003C14.3776 4.15633 15.0112 3.90336 15.67 3.90336C16.3288 3.90336 16.9624 4.15633 17.44 4.61003C17.9054 5.08162 18.1663 5.7175 18.1663 6.38003C18.1663 7.04256 17.9054 7.67844 17.44 8.15003L10.54 15.04C10.4717 15.1136 10.3896 15.1729 10.2984 15.2147C10.2072 15.2566 10.1086 15.28 10.0083 15.2837C9.80575 15.2912 9.60853 15.2179 9.46001 15.08C9.38647 15.0117 9.3271 14.9296 9.28529 14.8384C9.24348 14.7472 9.22005 14.6486 9.21633 14.5483C9.20883 14.3458 9.28209 14.1486 9.42001 14L14.55 8.88003C14.7383 8.69173 14.8441 8.43633 14.8441 8.17003C14.8441 7.90373 14.7383 7.64833 14.55 7.46003C14.3617 7.27173 14.1063 7.16594 13.84 7.16594C13.5737 7.16594 13.3183 7.27173 13.13 7.46003L8.00001 12.6C7.74331 12.8547 7.53957 13.1577 7.40054 13.4916C7.2615 13.8254 7.18992 14.1834 7.18992 14.545C7.18992 14.9066 7.2615 15.2647 7.40054 15.5985C7.53957 15.9323 7.74331 16.2353 8.00001 16.49C8.52438 16.9895 9.22081 17.2681 9.94501 17.2681C10.6692 17.2681 11.3656 16.9895 11.89 16.49L18.78 9.59003C19.5749 8.73698 20.0076 7.6087 19.9871 6.44289C19.9665 5.27709 19.4942 4.16478 18.6697 3.3403C17.8453 2.51582 16.7329 2.04355 15.5671 2.02298C14.4013 2.00241 13.2731 2.43515 12.42 3.23003L4.42001 11.23C3.34121 12.4249 2.76504 13.9899 2.81154 15.599C2.85805 17.2081 3.52364 18.7373 4.66965 19.8678C5.81565 20.9983 7.35368 21.6431 8.96329 21.6677C10.5729 21.6924 12.1299 21.095 13.31 20L19.5 13.82C19.5932 13.7268 19.6672 13.6161 19.7177 13.4943C19.7681 13.3725 19.7941 13.2419 19.7941 13.11C19.7941 12.9782 19.7681 12.8476 19.7177 12.7258C19.6672 12.604 19.5932 12.4933 19.5 12.4C19.4068 12.3068 19.2961 12.2328 19.1743 12.1824C19.0524 12.1319 18.9219 12.1059 18.79 12.1059C18.6581 12.1059 18.5276 12.1319 18.4058 12.1824C18.2839 12.2328 18.1732 12.3068 18.08 12.4V12.42Z" fill="#98969E"/>
                            </svg>
                        </label>
                    </div>
                    <div class="form-group textarea">
                        <textarea rows="1" name="message" id="message"  placeholder="Начните печатать..."></textarea>
                    </div>
                    <a class="send" id="send_message_btn">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_327_2956)">
{{--                                <path  d="M22.3393 9.31637L8.33927 2.31436C7.78676 2.03929 7.16289 1.94136 6.55271 2.03393C5.94252 2.1265 5.37573 2.40506 4.9296 2.83162C4.48347 3.25819 4.17972 3.81201 4.05976 4.41757C3.9398 5.02313 4.00947 5.65097 4.25927 6.21548L6.65927 11.587C6.71373 11.7169 6.74177 11.8563 6.74177 11.9971C6.74177 12.138 6.71373 12.2774 6.65927 12.4073L4.25927 17.7788C4.05597 18.2356 3.97003 18.7361 4.00925 19.2346C4.04847 19.7331 4.21161 20.2139 4.48385 20.6333C4.75609 21.0527 5.1288 21.3974 5.56809 21.6361C6.00739 21.8748 6.49935 21.9999 6.99927 22C7.4675 21.9953 7.92876 21.886 8.34927 21.6799L22.3493 14.6779C22.8459 14.428 23.2633 14.045 23.555 13.5717C23.8466 13.0983 24.0011 12.5532 24.0011 11.9971C24.0011 11.4411 23.8466 10.896 23.555 10.4226C23.2633 9.94924 22.8459 9.56625 22.3493 9.31637H22.3393ZM21.4493 12.8874L7.44927 19.8894C7.26543 19.9777 7.059 20.0077 6.85766 19.9753C6.65631 19.9429 6.46968 19.8497 6.32278 19.7082C6.17589 19.5667 6.07575 19.3837 6.0358 19.1836C5.99585 18.9836 6.018 18.7761 6.09927 18.589L8.48927 13.2175C8.52021 13.1458 8.54692 13.0723 8.56927 12.9974H15.4593C15.7245 12.9974 15.9788 12.892 16.1664 12.7044C16.3539 12.5169 16.4593 12.2624 16.4593 11.9971C16.4593 11.7318 16.3539 11.4774 16.1664 11.2898C15.9788 11.1022 15.7245 10.9968 15.4593 10.9968H8.56927C8.54692 10.922 8.52021 10.8485 8.48927 10.7768L6.09927 5.40524C6.018 5.21815 5.99585 5.01068 6.0358 4.81064C6.07575 4.61061 6.17589 4.42757 6.32278 4.28607C6.46968 4.14458 6.65631 4.05139 6.85766 4.019C7.059 3.98661 7.26543 4.01658 7.44927 4.10487L21.4493 11.1069C21.6131 11.1908 21.7505 11.3184 21.8465 11.4754C21.9425 11.6325 21.9933 11.813 21.9933 11.9971C21.9933 12.1812 21.9425 12.3618 21.8465 12.5188C21.7505 12.6759 21.6131 12.8034 21.4493 12.8874Z" fill="#98969E"/>--}}
                            </g>
                            <defs>
                                <clipPath id="clip0_327_2956">
                                    <rect width="24" height="24" fill="white"/>
                                </clipPath>
                            </defs>
                        </svg>
                    </a>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
