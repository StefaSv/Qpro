@extends('tamples.head_footer')

@section('content')
    <div class="header-bottom">
        <ul class="list">
            <?php
            $dealer = \App\Models\Dealer::find(\Illuminate\Support\Facades\Auth::user()['dealerId']);
            $managers = \App\Models\User::where("dealerID", $dealer['id'])->get();
            $num_notif = \App\Models\Notification::where('userId', '=', \Illuminate\Support\Facades\Auth::id())->get()->where('read',0)->count();
            ?>
            @if(is_null($dealer['full_name']))
            <li><a href="/profile-DC">Профиль ДЦ</a></li>
            @else
            <li><a href="/profile-DC/full">Профиль ДЦ</a></li>
            @endif
            <li><a href="/sales">Отдел продаж</a></li>
            <li><a class="active" href="/advertisement">Объявления</a></li>
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
            <h3>Объявления</h3>
            <div class="advertisement-main__table">
                <div class="section-sales__main">

{{--                    <div class="section-sales__head">--}}
{{--                        <div class="section-sales__head_left">--}}
{{--                            <div class="count-select">--}}
{{--                                <span>Записей на странице</span>--}}
{{--                                <select name="cout_page">--}}
{{--                                    <option value="10">10</option>--}}
{{--                                    <option value="20">20</option>--}}
{{--                                    <option value="30">30</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <div class="count-view">--}}
{{--                                <span>1-10</span>--}}
{{--                                <p>записей из</p>--}}
{{--                                <span>152</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="section-sales__head_right">--}}
{{--                            <form>--}}
{{--                                @csrf--}}
{{--                                <input type="search" name="search" id="search" placeholder="Поиск по таблице">--}}
{{--                                <button type="submit">--}}
{{--                                    <img src="./img/search.svg" alt="search">--}}
{{--                                </button>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="container">
                        <div class="section-sales__table">
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                <tr>
                                    <th>
                                        <div class="table-head-sort">
                                            <span>Название объявления</span>
{{--                                            <a class="icon-sort" href="#"></a>--}}
                                        </div>
                                    </th>
                                    <th>
                                        <div class="table-head-sort">
                                            <span>Продавец</span>
{{--                                            <a class="icon-sort" href="#"></a>--}}
                                        </div>
                                    </th>
                                    <th>
                                        <div class="table-head-sort">
                                            <span>Стоимость, руб</span>
    {{--                                            <a class="icon-sort" href="#"></a>--}}
                                        </div>
                                    </th>
                                    <th>Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($managers as $manager)
                                    @foreach(\App\Models\Offer::where('managerId', $manager['id'])->get() as $offer)
                                        <tr>
                                            <td>
                                                <a class="name-table-cell" href="/sales/offer/{{$offer['id']}}">{{\App\Models\Car_model::find($offer['model'])['title']}}, {{$offer['volume']}} л, {{$offer['power']}} л.с,
                                                    {{\App\Models\Transmission::find($offer['transmission'])['title']}}, {{\App\Models\Driveunit::find($offer['drive'])['title']}}
                                                </a>
                                            </td>
                                            <td>
                                                <a class="name-table-cell" href="/sales/profile-manager/{{$manager['id']}}">
                                                    {{$manager['name']}} {{$manager['surname']}} {{$manager['third_name']}}
                                                </a>
                                            </td>
                                            <td>{{$offer['cost']}} ₽</td>
                                            <td>
                                                <div class="choises">
                                                    @if($offer['is_frozen'] == 1)
                                                        <a class="froze" id="{{$offer['id']}}" title-tooltip="Разморозить"></a>
                                                    @elseif ($offer['is_frozen_hard'] == 1)
                                                    <a class="froze_hard" id="{{$offer['id']}}" title-tooltip="Оплатите для использования"></a>
                                                    @else
                                                        <a class="send" id="{{$offer['id']}}" title-tooltip="Отправить на исправление"></a>
                                                        <a class="info" id="{{$offer['id']}}" title-tooltip="Приостановить объявление"></a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

{{--                    <div class="section-sales__bottom">--}}
{{--                        <div class="section-sales__bottom_left">--}}
{{--                            <div class="count-select">--}}
{{--                                <span>Записей на странице</span>--}}
{{--                                <select name="cout_page">--}}
{{--                                    <option value="10">10</option>--}}
{{--                                    <option value="20">20</option>--}}
{{--                                    <option value="30">30</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <div class="count-view">--}}
{{--                                <span>1-10</span>--}}
{{--                                <p>записей из</p>--}}
{{--                                <span>152</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="section-sales__bottom_right">--}}
{{--                            <ul class="pagination">--}}
{{--                                <li>--}}
{{--                                    <a class="prev disabled" href="#">--}}
{{--                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"--}}
{{--                                             xmlns="http://www.w3.org/2000/svg">--}}
{{--                                            <path--}}
{{--                                                d="M14.5536 18.0464L14.5504 18.0433L8.87371 12.4662C8.74853 12.3017 8.70001 12.1423 8.70001 12C8.70001 11.8577 8.74853 11.6982 8.87371 11.5338L14.5504 5.95666L14.5504 5.95667L14.5536 5.95354C14.624 5.88306 14.6747 5.85008 14.7156 5.83189C14.7543 5.81467 14.8084 5.79999 14.9 5.79999C14.9917 5.79999 15.0457 5.81467 15.0844 5.83189C15.1254 5.85008 15.176 5.88306 15.2465 5.95354C15.4512 6.15828 15.4512 6.4417 15.2465 6.64643L15.2464 6.64642L15.2429 6.65002L10.3429 11.65L9.99994 12L10.3429 12.35L15.2429 17.35L15.2429 17.35L15.2465 17.3535C15.4512 17.5583 15.4512 17.8417 15.2465 18.0464C15.0417 18.2512 14.7583 18.2512 14.5536 18.0464Z"--}}
{{--                                                fill="#DBD9E0" stroke="black"/>--}}
{{--                                        </svg>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a class="current" href="#">1</a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="#">2</a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="#">3</a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="#">4</a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="#">5</a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="#">6</a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a class="sep" href="#">...</a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="#">10</a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a class="next" href="#">--}}
{{--                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"--}}
{{--                                             xmlns="http://www.w3.org/2000/svg">--}}
{{--                                            <path--}}
{{--                                                d="M15.54 11.29L9.87998 5.63998C9.78702 5.54625 9.67642 5.47185 9.55456 5.42108C9.4327 5.37032 9.30199 5.34418 9.16998 5.34418C9.03797 5.34418 8.90726 5.37032 8.78541 5.42108C8.66355 5.47185 8.55294 5.54625 8.45998 5.63998C8.27373 5.82734 8.16919 6.08079 8.16919 6.34498C8.16919 6.60916 8.27373 6.86261 8.45998 7.04998L13.41 12.05L8.45998 17C8.27373 17.1873 8.16919 17.4408 8.16919 17.705C8.16919 17.9692 8.27373 18.2226 8.45998 18.41C8.5526 18.5045 8.66304 18.5796 8.78492 18.6311C8.90679 18.6826 9.03767 18.7094 9.16998 18.71C9.30229 18.7094 9.43317 18.6826 9.55505 18.6311C9.67692 18.5796 9.78737 18.5045 9.87998 18.41L15.54 12.76C15.6415 12.6663 15.7225 12.5527 15.7779 12.4262C15.8333 12.2997 15.8619 12.1631 15.8619 12.025C15.8619 11.8869 15.8333 11.7503 15.7779 11.6238C15.7225 11.4973 15.6415 11.3836 15.54 11.29Z"--}}
{{--                                                fill="#1F1E21"/>--}}
{{--                                        </svg>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}

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
                        <textarea rows="15" name="desc" id="desc" required placeholder="Опишите, что следует изменить в объявлении">
                        </textarea>
                    </div>
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
                    <a class="btn `btn-accept`" id="defroze" href="#">Да</a>
                </div>
            </div>
        </div>
    </div>
@endsection
