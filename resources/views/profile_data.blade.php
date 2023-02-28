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
            <li><a href="/statistics">Статистика</a></li>
            <li><a href="/notification">Уведомления</a></li>
            <li><a href="/support">Служба поддержки</a></li>
        </ul>
    </div>
</header>
<section class="inactive-profile main-section">
    <?php $user = \Illuminate\Support\Facades\Auth::user(); ?>
    <div class="container">
        <div class="section-personal-data">
            <div class="section-personal-data__main">
                <div class="section-personal-data__head">
                    <h4>Личные данные</h4>
                    <a class="password" data-toggle="modal" data-target="#exampleModalChangePostPhone" href="#">Запросить изменение телефона или почты</a>
                </div>
                <form class="section-personal-data__body" action="/profile-data/set" method="post"
                      enctype="multipart/form-data"
                >
                    @csrf
                    <div class="section-personal-data__avatar">
                        <div class="section-personal-data__avatar_image">
                            @if(isset($user['avatar']))
                            <img src="{{asset($user['avatar'])}}" alt="avatar">
                            @else
                            <img src="{{asset('/img/avatar.jpg')}}" alt="avatar">
                            @endif
                        </div>
                        <div class="section-personal-data__avatar_right">
                            <label for="avatar_file">Добавить фото</label>
                            <input type="file" name="avatar_file" id="avatar_file">
                            <p>Размер фото должен быть не более 512х512 px, а вес не более 5 Мб.</p>
                        </div>
                    </div>
                    <div class="form-group small-group">
                        <label for="last_name">Фамилия <b>*</b></label>
                        <input type="text" name="last_name" id="last_name" value="{{$user['surname']}}" required>
                    </div>
                    <div class="form-group small-group">
                        <label for="phone">Номер телефона <b>*</b></label>
                        <input type="tel" name="phone" id="phone" value="{{$user['phone']}}" disabled>
                    </div>
                    <div class="form-group small-group">
                        <label for="first_name">Имя <b>*</b></label>
                        <input type="text" name="first_name" id="first_name" value="{{$user['name']}}" required>
                    </div>
                    <div class="form-group small-group">
                        <label for="email">Рабочий e-mail <b>*</b></label>
                        <input type="text" name="email" id="email" value="{{$user['email']}}" disabled>
                    </div>
                    <div class="form-group small-group">
                        <label for="third_name">Отчество</label>
                        <input type="text" name="third_name" id="third_name" value="{{$user['third_name']}}">
                    </div>
                    <div class="form-group justify-content-end flex-row mb-0">
                        <button class="btn" type="submit">Сохранить изменения</button>
                    </div>
                </form>
            </div>
            <div class="section-personal-data__main">
                <div class="section-personal-data__head">
                    <h4>Сменить пароль</h4>
                    <a href="#">Забыли пароль?</a>
                </div>
                <form class="section-personal-data__body" action="/profile-data/password-change" method="post">
                    @csrf
                    <div class="form-group password-form-group">
                        @error('old_password')
                        <div class="form-group not-registered">
                        @enderror
                        <label for="old_password">Старый пароль</label>
                        <input class="@error('old_password') is-invalid @enderror" type="password" name="old_password" id="old_password" placeholder="" required>
                        <div class="show-password"></div>
                        @error('old_password')
                        <span class="error">Пароль неверный!</span>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group password-form-group small-group">
                        <label for="new_password">Новый пароль</label>
                        <input type="password" name="new_password" id="new_password" placeholder="" required>
                        <div class="show-password"></div>
                    </div>
                    <div class="form-group password-form-group small-group">
                        <label for="repeat_new_password">Повторите новый пароль</label>
                        <input type="password" name="repeat_new_password" id="repeat_new_password" placeholder="" required>
                        <div class="show-password"></div>
                    </div>
                    <div class="form-group justify-content-end flex-row mb-0">
                        <button class="btn" type="submit">Сохранить пароль</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalChangePostPhone" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalChangePostPhone" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalChangePostPhone">Будет отправлен запрос на изменение ваших данных</h4>
                </div>
                <div class="modal-body">
                    <form id= "rty" method="post" action="/profile/phone-mail/change-request">
                        @csrf
                        <div class="form-group">
                            <label >Что вы хотите изменить?<b>*</b></label>
                            <div class="radio-line">
                                <div class="form-group radio">
                                    <input type="checkbox" name="phone" id="phone1" required value="phone">
                                    <label for="phone1">Номер</label>
                                </div>
                                <div class="form-group radio">
                                    <input type="checkbox" name="email" id="email1" required value="email">
                                    <label for="email1">E-mail</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-gray" href="#" data-dismiss="modal">Отмена</a>
                    <button class="btn" form = "rty">Отправить</button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
