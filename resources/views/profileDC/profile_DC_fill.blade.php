<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Carseller</title>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <link rel="icon" href="./img/icon.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('/css/style.min.css')}}">
</head>
</html>
<body>
<?php $dealer=\App\Models\Dealer::find(\Illuminate\Support\Facades\Auth::user()['dealerId']) ?>
<section class="registration-application section-login filling-profile">
    <div class="container">
        <div class="section-registration__main section-login__main">
            @if(is_null(\App\Models\Dealer::find(\Illuminate\Support\Facades\Auth::user()['dealerId'])['full_name']))
                <div class="section-registration__main_top"><a class="btn back-btn" href="/profile-DC">Назад</a>
                    @else
                        <div class="section-registration__main_top"><a class="btn back-btn" href="/profile-DC/full">Назад</a>
                            @endif
                            <a style="cursor:pointer" data-toggle="modal" data-target="#exampleModalLogout" class="gray-badge">Заявка на изменение данных ДЦ</a>
                        </div>
                        <div class="title">Данные профиля дилерского центра</div>
                        <div class="desc">Чтобы начать работать с личным кабинетом и оплачивать аккаунт, необходимо заполнить
                            информацию о дилерском центре
                        </div>
                        <form id="profile" action="/profile-DC/change/set" method="post">
                            @csrf
                            <div class="form-group form-group-top"><h4>Данные ДЦ</h4></div>
                            <div class="form-group">
                                <label for="name_dc">Название ДЦ<b>*</b></label>
                                <input type="text" name="name_dc" id="name_dc" value="{{$dealer['title']}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="address_dc">Адрес ДЦ<b>*</b></label>
                                <input type="text" name="address_dc" id="address_dc" value="{{$dealer['address']}}" disabled>
                            </div>
                            <div class="form-group form-group-top">
                                <h4>Реквизиты</h4>
                                <p>(Понадобятся для оплаты акккаунта)</p>
                            </div>
                            <div class="form-group">
                                <label for="org_type">Тип организации<b>*</b></label>
                                <select name="org_type" id="org_type">
                                    <option value="" selected="selected" disabled="disabled">Выберите из списка</option>
                                    <option value="ИП">ИП</option>
                                    <option value="ООО">ООО</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="full_name">Полное наименование организации<b>*</b>
                                </label>
                                <input type="text" name="full_name" id="full_name" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="center_tel">Телефон дилерского центра<b>*</b></label>
                                <input type="tel" name="center_tel" id="center_tel" placeholder="+7">
                            </div>
                            <div class="form-group">
                                <label for="yur_address">Юридический адрес<b>*</b></label>
                                <input type="text" name="yur_address" id="yur_address" placeholder="Область, город, улица, дом">
                            </div>
                            <div class="form-group">
                                <label for="post_address">Почтовый адрес<b>*</b></label>
                                <input type="text" name="post_address" id="post_address" placeholder="Область, город, улица, дом, индекс">
                            </div>
                            <div class="form-group small-group">
                                <label for="inn">ИНН<b>*</b></label>
                                <input type="number" name="inn" id="inn" placeholder="">
                            </div>
                            <div class="form-group small-group">
                                <label for="kpp" id="lab_kpp">КПП (только для ООО)<b id = "req">*</b>
                                </label>
                                <input type="number" name="kpp" id="kpp" placeholder="">
                            </div>
                            <div class="form-group small-group">
                                <label for="bik">БИК<b>*</b></label>
                                <input type="number" name="bik" id="bik" placeholder="">
                            </div>
                            <div class="form-group small-group">
                                <label for="ogrn">ОГРН<b>*</b></label>
                                <input type="number" name="ogrn" id="ogrn" placeholder="">
                            </div>
                            <div class="form-group small-group">
                                <label for="okpo">ОКПО<b>*</b></label>
                                <input type="number" name="okpo" id="okpo" placeholder="">
                            </div>
                            <div class="form-group small-group">
                                <label for="okato">ОКАТО<b>*</b></label>
                                <input type="number" name="okato" id="okato" placeholder="">
                            </div>

                            <div class="form-group">
                                <label for="name_dir">Генеральный директор<b>*</b></label>
                                <input type="text" pattern="[А-Яа-яЁё]" name="name_dir" id="name_dir" placeholder="Фамилия Имя Отчество">
                            </div>
                            <div class="form-group">
                                <label for="mail_dc">Электронная почта ДЦ<b>*</b></label>
                                <input type="text" name="mail_dc" id="mail_dc" placeholder="Рабочая почта дилерского центра">
                            </div>
                            <div class="form-group">
                                <label for="site_dc">Сайт</label>
                                <input type="text" name="site_dc" id="site_dc" placeholder="Укажите ссылку на сайт (если есть)">
                            </div>
                            <div class="form-group-block">
                                <button class="btn" type="submit" id="save_profile" disabled>Сохранить</button>
                            </div>
                        </form>
                </div>
        </div>
</section>
<div class="modal fade" id="exampleModalLogout" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalCenterChoiseTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalCenterChoiseTitle">Заявка на изменение данных ДЦ</h4>
            </div>
            <div class="modal-body">
                <form class="recovery-form" action="/profile-DC/change/send-request" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="email">Опишите проблему</label>
                        <input type="text" name="message" id="message" required>
                    </div>
                    <button class="btn" type="submit" id="submit">Отправить</button>
                </form>
            </div>
        </div>
    </div>
</div>
<footer>
    <div class="footer-bottom">
        <div class="footer-bottom__left">
            <div class="support">Поддержка:</div>
            <a href="tel:88005353535">8 (800) 535 - 35 - 35</a>
            <div class="poloci">Политика обработки персональных данных</div>
        </div>
        <div class="footer-bottom__right">
            <div class="text">© 2022 Carsseller</div>
        </div>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js"></script>
<script src = "{{asset('js/jquery.nicescroll.min.js')}}"></script>
<script src = "{{asset('js/main.js')}}"></script>
<script src = "{{asset('js/move.js')}}"></script>
<script src = "{{asset('js/booststrap.js')}}"></script>
{{--    <script src = "{{asset('js/jquery.js')}}"></script>--}}
<script src = "{{asset('js/datatables.js')}}"></script>
</body>
