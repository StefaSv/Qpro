// const numbers = [150,278,396,478,515,605,771,810,966,1012,1502]
// console.log(numbers)
// numbers.map(i=>x+=i, x=0).reverse()[0]
// const numbersCount = numbers.length
//
// const getNumber = (numbers, searchNumer) =>
//   numbers.find(it => Math.abs(it - averageNumbers) === Math.min(...numbers.map(it => Math.abs(it - averageNumbers))));
//
// const averageNumbers = x / numbersCount
// const nearNumber = getNumber(numbers, averageNumbers)
// console.log(nearNumber)
// const finalIndex = numbers.findIndex(i => i == nearNumber)
// console.log(finalIndex);






$(document).ready(() => {

    $(".section-notification__left_body").niceScroll();


    function checkSub(){
        console.log('Sub checked!');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'GET',
            url: '/subscription/check',
            success: function (data) {
                console.log(data);
            },
            error: function (textStatus, errorThrown) {
            },
        });
    }
    setInterval(checkSub,10000);
    setInterval(checkMessages, 10000);

    function get_messages(){
        console.log('Geted!');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'GET',
            url: '/support/get-messages',
            success: function (data) {
                if (typeof data[0] != "undefined" ){
                    data.forEach(function (elem){
                        console.log(elem[0]);
                        if(elem[1] == null) {
                            if (elem[0] == 1) {
                                $('.section-support__content').append('<div class="section-support__content_item new-message"><img style="max-width: 500px" src="' + elem[3] + '"><div class ="section-support__content_time">' + elem[2] + '</div></div>');
                            } else {
                                if (elem[0] == "b") {
                                    $('.section-support__content').append('<div class="end-conv"><div class="text-end-conv">Оператор закрыл ваш вопрос</div></div>');
                                } else {
                                    $('.section-support__content').append('<div class="section-support__content_item sended"><img style="max-width: 500px" src="' + elem[3] + '"><div class ="section-support__content_time">' + elem[2] + '</div></div>');
                                }
                            }
                        }
                        else if(elem[3] == null) {
                            if (elem[0] == 1) {
                                $('.section-support__content').append('<div class="section-support__content_item new-message"><p>' + elem[1] + '</p><div class ="section-support__content_time">' + elem[2] + '</div></div>');
                            } else {
                                if (elem[0] == "b") {
                                    $('.section-support__content').append('<div class="end-conv"><div class="text-end-conv">Оператор закрыл ваш вопрос</div></div>');
                                } else {
                                    $('.section-support__content').append('<div class="section-support__content_item sended"><p>' + elem[1] + '</p><div class ="section-support__content_time">' + elem[2] + '</div></div>');
                                }
                            }
                        }
                        else {
                            if (elem[0] == 1) {
                                $('.section-support__content').append('<div class="section-support__content_item new-message"><p>' + elem[1] + '</p><img style="max-width: 500px" src="' + elem[3] + '"><div class ="section-support__content_time">' + elem[2] + '</div></div>');
                            } else {
                                if (elem[0] == "b") {
                                    $('.section-support__content').append('<div class="end-conv"><div class="text-end-conv">Оператор закрыл ваш вопрос</div></div>');
                                } else {
                                    $('.section-support__content').append('<div class="section-support__content_item sended"><p>' + elem[1] + '</p><img style="max-width: 500px" src="' + elem[3] + '"><div class ="section-support__content_time">' + elem[2] + '</div></div>');
                                }
                            }
                        }
                    });
                }
            },
            error: function (data, textStatus, errorThrown) {
                console.log(data);
            },
        });
    }
    get_messages();

    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });
    // $.ajax({
    //     type: 'GET',
    //     url: '/profile-DC/compose-check/{id}',
    //     data: {
    //         'loc_id': e.target.id,
    //     },
    //     success: function (data) {
    //         console.log(data);
    //     },
    //     error: function (data, textStatus, errorThrown) {
    //
    //     },
    // });

    function checkMessages(){
        console.log('Checked!');
        let room_id = $('#room_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'GET',
            url: '/support/check-new',
            data: {
                'room_id' : room_id,
            },
            success: function (data) {
                if (typeof data[0] != "undefined" ){
                    data.forEach(function (elem){
                        console.log(elem[0]);
                        $('.section-support__content').append('<div class="section-support__content_item new-message"><p>' + elem[0] + '</p><div class ="section-support__content_time">' + elem[1] + '</div>');
                    });
                }
            },
            error: function (data, textStatus, errorThrown) {
                console.log(data);
            },
        });
    }

    $('li').click(function (e) {
        let id = this.id;
        $('li').addClass("active");
        $('.active').removeClass('active');
        console.log(id);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'GET',
            url: '/statistics/sort',
            data:{
                'id' : id
            },
            success: function (data) {
                console.log(data);
                $('.cards-row').empty();
                data.forEach(function (elem) {
                    console.log(elem);
                    $('.cards-row').prepend('<div class="card-element"><div class="card-header"> <img class="card-pic" src = '+elem[4]+' alt="profile"> <a class="card-fullname" href="/sales/profile-manager/'+elem[0]+'">'+elem[1]+' '+elem[2]+' '+elem[3]+'</a> <div class="card-rating"> <img src='+elem[9]+'>'+elem[5]+' </div></div> <div class="card-content"> <div class="card-content-line"> <a class="card-content-line-title">Объявления:</a> <a class="card-content-line-data">'+elem[6]+'</a> </div> <div class="card-content-line"> <a class="card-content-line-title">Чаты:</a> <a class="card-content-line-data">'+elem[7]+'</a> </div> <div class="card-content-line"> <a class="card-content-line-title">Просмотры объявлений:</a> <a class="card-content-line-data">'+elem[8]+'</a> </div> </div></div>');

                });
                },
            error: function (data, textStatus, errorThrown) {
                console.log(data);
            },
        });
    });

  $('#send_message_btn').click(function () {
      var check = 1;
      var data = new FormData();
      var message = $('#message').val();
      data.append('message', message);
      console.log(data);

      jQuery.each(jQuery('#file')[0].files, function(i, file) {
          data.append('file-'+i, file);
          console.log(file['size']);
          if(file['size'] > 52428800){check = 0}
      });

      if (check == 1) {
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $.ajax({
              type: 'POST',
              url: '/support/send-message',
              data: data,
              contentType: false,
              processData: false,
              success: function (data) {
                  console.log(data);
                  console.log(data[1]);

                  if (data[0] == null) {
                      $('.section-support__content').append('<div class="section-support__content_item sended"><img style="max-width: 500px" src="' + data[2] + '"><div class="section-support__content_time">' + data[1] + '</div></div>');
                  }else if (data[2] == null){
                      $('.section-support__content').append('<div class="section-support__content_item sended"><p>' + data[0] + '</p><div class="section-support__content_time">' + data[1] + '</div></div>');
                  }else {
                      $('.section-support__content').append('<div class="section-support__content_item sended"><p>' + data[0] + '</p><img style="max-width: 500px" src="' + data[2] + '"><div class="section-support__content_time">' + data[1] + '</div></div>');
                  }
                  $('#message').replaceWith('<textarea rows="1" name="message" id="message" placeholder="Начните писать..."></textarea>');
              },
              error: function (data, textStatus, errorThrown) {
                  console.log(data);
              },
          });
      }else{

      }
  });

  //увольнение
  $('.fire').click(function (e){
      let id = this.id;
      $('.btn-accept').replaceWith('<a class="btn btn-accept" href="/user/fire/'+id+'">Да</a>');
      $('#exampleModalCenterChoise').modal('show');
      //console.log(e.target.id);
  });

  //отправка на исправление
  $('.send').on('click',function (e){
      let id = this.id;
      $('#exampleModalCenterRead').append('<input id="offer_id" hidden value="'+id+'">').modal('show');
  });

  $('#send_re').on('click',function (e){
      $('#exampleModalCenterRead').modal('show');
  });

  $('#send_ch').on('click',function (){
      let offer_id = $('#offer_id').val();
      let text = $('#desc').val();
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
          type: 'POST',
          url: '/advertisement/send_change',
          data:{
              'offer_id' : offer_id,
              'text': text,
          },
          success: function (data) {
              console.log(data);
              if (data['success'] == true){
                  $('#exampleModalCenterRead').modal('hide');
                  $.toast({
                      text: '<a style = " width: 318px;  height:20px;  font-family:Gilroy; font-style:normal; font-weight:600; font-size:14px; line-height: 20px; color: #5D30C3;  flex:none;  order:0;  flex-grow:0">Объявление отправлено на исправление!</a>', // Text that is to be shown in the toast

                      allowToastClose: false, hideAfter: 5000, stack: true, position: 'top-right',

                      bgColor: '#ffffff', textColor: '#9900ff', textAlign: 'left', loader: false,  loaderBg: '#9EC600',
                  });
              }
          },
          error: function (data, textStatus, errorThrown) {
              console.log(data);
          },
      });
  });

    //заморозка
    $('.info').on('click',function (e){
        let id = this.id;
        $('#exampleModalCenterStop').append('<input id="offer_id" hidden value="'+id+'">');
        $('#exampleModalCenterStop').append('<input id="type_send" hidden value="icon">');
        $('#exampleModalCenterChoise').modal('show');
    });

    $('#send_fr').on('click',function (e){
        $('#exampleModalCenterChoise').modal('show');
    });

    $('#info_choice').on('click',function (e){
        $('#exampleModalCenterChoise').modal('hide');
        $('#exampleModalCenterStop').modal('show');
    });

    $('#info_send').on('click',function (){
        let offer_id = $('#offer_id').val();
        let text = $('#desc_stop').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/advertisement/froze',
            data:{
                'offer_id' : offer_id,
                'text': text,
                'type': "icon",
            },
            success: function (data) {
                console.log(data);
                if (data['success'] == true){
                  if(data['type'] == "button"){
                    $('#send_re').remove();
                    $('#send_fr').remove();
                    $('.profile-manager__head_right').append('<a class="btn-border" data-toggle="modal" href="#" data-target="#exampleModalCenterDefroze" id="send_defr">Разморозить объявленине</a>');
                  }
                  if(data['type'] == "icon"){
                    $('.send').remove();
                    $('.info').remove();
                    $('.choises').append('<a class="froze" id="'+data['id']+'" title-tooltip="Разморозить"></a>');
                    $('.choises a').each(function () {
                      var tooltipTitle = $(this).attr('title-tooltip');
                      $( this ).mouseenter(function(){
                        $( this ).append( "<span class='custom-tooltip'>"+tooltipTitle+"</span>" );
                      });
                      $( this ).mouseleave(function(){
                        $( this ).find( ".custom-tooltip" ).remove();
                      });
                      $('.froze').on('click',function (){
                        let id = this.id;
                        $('.modal-footer').append('<input id="offer_id" value="'+id+'" hidden>');
                        $('.modal-footer').append('<input id="type_send" value="icon" hidden>');
                        $('#exampleModalCenterDefroze').modal('show');
                    });
                    });
                  }
                    $('#exampleModalCenterStop').modal('hide');
                    $.toast({
                        text: '<a style = " width: 318px;  height:20px;  font-family:Gilroy; font-style:normal; font-weight:600; font-size:14px; line-height: 20px; color: #5D30C3;  flex:none;  order:0;  flex-grow:0">Объявление заморожено!</a>', // Text that is to be shown in the toast

                        allowToastClose: false, hideAfter: 5000, stack: true, position: 'top-right',

                        bgColor: '#ffffff', textColor: '#9900ff', textAlign: 'left', loader: false,  loaderBg: '#9EC600',
                    });
                }
            },
            error: function (data, textStatus, errorThrown) {
                console.log(data);
            },
        });
    });

  // $('.info').click(function (e){
  //     let id = this.id;
  //     $('#info_choice');
  //     $('#exampleModalCenterChoise').modal('show');
  // });

  //разморозка
    $('.froze').on('click',function (){
        let id = this.id;
        $('.modal-footer').append('<input id="offer_id" value="'+id+'" hidden>');
        $('.modal-footer').append('<input id="type_send" value="icon" hidden>');
        $('#exampleModalCenterDefroze').modal('show');
    });


  $('#defroze').on('click',function (){
      let offer_id = $('#offer_id').val();
      let type_send = $('#type_send').val();
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
          type: 'POST',
          url: '/advertisement/unfroze',
          data:{
              'offer_id' : offer_id,
              'type_send': type_send,
          },
          success: function (data) {
              console.log(data);
              if (data['success'] == true){
                  if(data['type'] == "button") {
                      $('#send_defr').remove();
                      $('.profile-manager__head_right').append('<a class="btn-border" href="#" id="send_re">Отправить на исправление</a>');
                      $('.profile-manager__head_right').append('<a class="btn-border" href="#" id="send_fr">Приостановить объявление</a>');
                  }
                  if(data['type'] == "icon") {
                      $('.froze').remove();
                      $('.choises').append('<a class="send" id="' + data['id'] + '" title-tooltip="Отправить на исправление"></a>');
                      $('.choises').append('<a class="info" id="' + data['id'] + '" title-tooltip="Приостановить объявление"></a>');
                      
                      $('.choises a').each(function () {
                        var tooltipTitle = $(this).attr('title-tooltip');
                        $( this ).mouseenter(function(){
                          $( this ).append( "<span class='custom-tooltip'>"+tooltipTitle+"</span>" );
                        });
                        $( this ).mouseleave(function(){
                          $( this ).find( ".custom-tooltip" ).remove();
                        });
                      });
                      $('.info').click(function (e){
                        let id = this.id;
                        $('#info_choice');
                        $('#exampleModalCenterChoise').modal('show');
                      });
                      $('.send').on('click',function (e){
                        let id = this.id;
                        $('#exampleModalCenterRead').append('<input id="offer_id" hidden value="'+id+'">').modal('show');
                      });
                  }
                  $('#exampleModalCenterDefroze').modal('hide');
                }
          },
          error: function (data, textStatus, errorThrown) {
              console.log(data);
          },
      });
  });

  $('#choice_pay').click(function () {
      let info = $('.info-dc__main .info-text');
      let num_null =  0;
      for (let i = 0; i < info.length; i++) {
          console.log(info[i].id);
          $('#choice_pay_form').append('<input id="'+info[i].id+'" name="'+info[i].id+'" value="'+info[i].id+'" type="hidden"></input>');
          if(info[i].id == ""){
              num_null += 1;
          }
      }
      console.log(num_null);
      if (num_null == 0){
          let val = $('#select2-tariff-container').attr('title');
          $('#choice_pay_form').append('<input id="days" name="days" value="'+val+'" type="hidden"></input>');
          $('#exampleModalReceipt').modal('show');
      }else{
          $('#exampleModalWarn').modal('show');
      }
  });

  $('.section-notification__left_item').click(function () {
      $(this).removeClass('new-message choises');

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
          type: 'POST',
          url: '/notification/read',
          data: {
              'id' : this.id,
          },
          success: function (data) {
              console.log(data);
          },
          error: function (data, textStatus, errorThrown) {
              console.log(textStatus);
              console.log(errorThrown);
          },
      });
      let title  = this.children[1].id;
      let message  = this.children[2].id;
      console.log(title);
      $('#titleB').replaceWith('<h3 id="titleB">'+title+'</h3>');
      $('div.section-notification__right_full-text').replaceWith('<div class="section-notification__right_full-text">'+message+'</div>');
      let num_notif = $('.num-notifications').first()[0].id - 1;
      if(num_notif != 0) {
          $('.num-notifications').replaceWith('<a class="num-notifications" id="' + num_notif + '">' + num_notif + '</a>');
      }else{
          $('.num-notifications').replaceWith('');
      }
  });

  $('.read-all').click(function () {
      let need_to_read = $('.section-notification__left_item, new-message, choises');
      need_to_read.removeClass('new-message choises');
      $('.num-notifications').replaceWith('');
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
          type: 'POST',
          url: '/notification/read',
          data: {
              'id' : "all",
              'user_id': this.id,
          },
          success: function (data) {
              console.log(data);
          },
          error: function (data, textStatus, errorThrown) {
              console.log(data);

          },
      });

  });


  $('#reg').click(function (){
      let phone = $('#phone').val();
      phone = phone.split(' ').join('');
      phone = phone.split('+').join('');
      phone = phone.split('-').join('');
      phone = phone.split('(').join('');
      phone = phone.split(')').join('');
      console.log(phone);
      let name = $('#name').val();
      let last_name = $('#last_name').val();
      let email = $('#email').val();
      let password = 123456;
      // let reg = $('#registration1').prepend('<input id="name" value="'+name+' " type="hidden"></input>');
      // reg.prepend('<input id="sur-name" value="'+last_name+' " type="hidden"></input>');
      // reg.prepend('<input id="phone" value="'+phone+' " type="hidden"></input>');
      // reg.prepend('<input id="email" value="'+email+'" type="hidden"></input>');
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      // console.log(last_name);
      // console.log(password);
      // console.log(name);
      // console.log(phone);
      // console.log(email);
        $.ajax({
            type: 'POST',
            url: '/registration/set',
            data: {
                'phone' : phone,
                'name': name,
                'surname': last_name,
                'email': email,
                'password': password,
            },
            success: function (data) {
                console.log(data);
                if (data['success'] == 'true'){
                    $('#exampleModalCenterRead').modal('show');
                }
                if (data['success'] == 'false'){
                    let err_mail = $('#err_mail');
                    let err_phone = $('#err_phone');
                    console.log(err_mail.length, err_phone.length);
                    if (data['error'] == 'email_registered' && err_mail.length == 0) {
                        $('#div_e_mail').append('<a id="err_mail"  style="color: #d05050">Почта уже зарегестрирована</a>');
                    } else if (data['error'] != 'email_registered') {
                        err_mail.remove();
                    }
                    if (data['error'] == 'phone_registered' && err_phone.length == 0) {
                        $('#div_phone').append('<a id="err_phone" style="color: #d05050">Телефон уже зарегестрирован</a>');
                    } else if (data['error'] != 'phone_registered') {
                        err_phone.remove();
                    }
                }
            },
            error: function (data, textStatus, errorThrown) {
                console.log(data);

            },
        });
  });

    $('#profile_send_data').click(function (){
        console.log(phone);
        var data = new FormData();
        let name = $('#first_name').val();
        let last_name = $('#last_name').val();
        let third_name = $('#third_name').val();
        data.append('name', name);
        data.append('last_name', last_name);
        data.append('third_name', third_name);
        console.log(data);

        jQuery.each(jQuery('#avatar_file')[0].files, function(i, file) {
            data.append('file', file);
            console.log(file['size']);
            if(file['size'] > 52428800){check = 0}
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/profile-data/set',
            data: data,
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                if (data['success'] == true){
                        $.toast({
                            title: "Заголовок",
                            text: '<a style = " width: 318px;  height:20px;  font-family:Gilroy; font-style:normal; font-weight:600; font-size:14px; line-height: 20px; color: #5D30C3;  flex:none;  order:0;  flex-grow:0">Данные успешно сохранены!</a>', // Text that is to be shown in the toast
                            allowToastClose: false, // Boolean value true or false
                            hideAfter: 5000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                            stack: true, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                            position: 'top-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values

                            bgColor: '#ffffff',  // Background color of the toast
                            textColor: '#9900ff',  // Text color of the toast
                            textAlign: 'left',  // Text alignment i.e. left, right or center
                            loader: false,  // Whether to show loader or not. True by default
                            loaderBg: '#9EC600',  // Background color of the toast loader
                        });
                }
            },
            error: function (data, textStatus, errorThrown) {
                console.log(data);

            },
        });
    });

    $('#recovery').click(function (){
        var data = new FormData();
        let email = $('#email').val();
        data.append('email', email);
        console.log(data);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/login/recovery/check',
            data: data,
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                if (data['success'] == true){
                    $.toast({
                        text: '<a style = " width: 196px;  height:20px;  font-family:Gilroy; font-style:normal; font-weight:600; font-size:14px; line-height: 20px; color: #5D30C3;  flex:none;  order:0;  flex-grow:0">Новый пароль отправлен Вам на почту!</a><a style="width: 318px;\n' +
                            'height: 60px;\n' +
                            'font-family: \'Gilroy\';\n' +
                            'font-style: normal;\n' +
                            'font-weight: 500;\n' +
                            'font-size: 14px;\n' +
                            'line-height: 20px;\n' +
                            'color: #98969E;\n' +
                            'flex: none;\n' +
                            'order: 1;\n' +
                            'align-self: stretch;\n' +
                            'flex-grow: 0;">Проверьте свою почту, письмо должно прийти в течение 10 минут. Если письмо не пришло, проверьте папку «Спам».</a>', // Text that is to be shown in the toast
                        allowToastClose: false, // Boolean value true or false
                        hideAfter: 10000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                        stack: true, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                        position: 'top-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values

                        bgColor: '#ffffff',  // Background color of the toast
                        textColor: '#9900ff',  // Text color of the toast
                        textAlign: 'left',  // Text alignment i.e. left, right or center
                        loader: false,  // Whether to show loader or not. True by default
                        loaderBg: '#9EC600',  // Background color of the toast loader
                    });
                }
            },
            error: function (data, textStatus, errorThrown) {
                console.log(data);

            },
        });
    });

    $('#save_pass').click(function (){
        var data = new FormData();
        let old_password = $('#old_password').val();
        let new_password = $('#new_password').val();
        let repeat_new_password = $('#repeat_new_password').val();
        data.append('old_password', old_password);
        data.append('new_password', new_password);
        data.append('repeat_new_password', repeat_new_password);
        console.log(data);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/profile-data/password-change',
            data: data,
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);

                if (data['success'] == true){
                    $('#err_pass').remove();
                    $('#err_new').remove();
                    $.toast({
                        text: '<a style = "width: 196px;  height:20px;  font-family:Gilroy; font-style:normal; font-weight:600; font-size:14px; line-height: 20px; color: #5D30C3;  flex:none;  order:0;  flex-grow:0">Пароль успешно изменён!</a>',
                        allowToastClose: false, // Boolean value true or false
                        hideAfter: 5000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                        stack: true, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                        position: 'top-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values

                        bgColor: '#ffffff',  // Background color of the toast
                        textColor: '#9900ff',  // Text color of the toast
                        textAlign: 'left',  // Text alignment i.e. left, right or center
                        loader: false,  // Whether to show loader or not. True by default
                        loaderBg: '#9EC600',  // Background color of the toast loader
                    });
                }
                if (data['success'] == false){
                    let err_pass = $('#err_pass');
                    let err_new = $('#err_new');
                    console.log(err_pass.length, err_new.length);
                    if (data['error'] == 'password_wrong' && err_pass.length == 0) {
                        console.log('неправильный пароль');
                        $('#old_pass_err').append('<a id="err_pass"  style="color: #d05050">Текущий пароль указан неверно</a>');
                    }  else if (data['error'] != 'password_wrong') {
                        err_pass.remove();
                    }
                    if (data['error'] == 'new_different' && err_new.length == 0) {
                        $('#new_pass_err').append('<a id="err_new" style="color: #d05050">Новые пароли не совпадают</a>');
                    } else if (data['error'] != 'password_wrong') {
                        err_new.remove();
                    }
                }
            },
            error: function (data, textStatus, errorThrown) {
                console.log(data);

            },
        });
    });



  $('select').select2({
    dropdownCssClass : 'no-search', val: null,dropdownParent: $('.select2-container')
  });
  $('select').select2({
    dropdownCssClass : 'no-search',
    dropdownParent: $('.count-select')
  });
  let getVal = undefined;



    $('#org_type').select2().on('change.select2', function() {
        getVal = $(this).val();
        console.log(getVal);
        if ( getVal == 'ИП') {
            let kpp = $("#kpp").prop("disabled", true);
            kpp.prop("required", false);
            kpp.css("background", '#a0a0a0');
            $('#req').remove();
        }
        if ( getVal != 'ИП') {
            let kpp = $("#kpp").prop("disabled", false);
            kpp.prop("required", true);
            kpp.css("background", '#ffffff');
            $('#lab_kpp').append('<b id = \'req\'>*</b>');
        }
    });

    $('#region').select2().on('change.select2', function(e) {
        if ( getVal != '') {
            $("#brand").prop("disabled", false);
        }
        let loc_id = $('#region').val();
        let brand_id = $('#brand').val();
        console.log(loc_id);
        console.log(brand_id);
        if ( brand_id != '') {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'GET',
                url: '/registration/set-dealers',
                data: {
                    'loc_id': loc_id,
                    'brand_id': brand_id,
                },
                success: function (data) {
                  console.log(data);
                  if (data.length != 0){
                    $('#center').empty();
                    $('#center').select2({data:data});
                  };
                  if (data.length == 0){
                    var atad = [{id:0,text: "Выберите из списка", disabled:true},];
                    console.log(atad);
                    $('#center').empty();
                    $('#center').select2({data:atad , placeholder:"Выберите из списка"});
                  };
                },
                error: function (data, textStatus, errorThrown) {
                    console.log(data);

                },
            });
        }
    });

    //выбор диллерского центра
    $('#send_request').on('click', function(e) {
      let center = $('#center').val();
      console.log(center);
      if(center != null){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/registration/check',
            data: {
              'center': center,
            },
            success: function (data) {
              window.location.href=data['ref'];
            },
            error: function (data, textStatus, errorThrown) {
                console.log(data);
            },
        });
      }else{
        $('#center_choice').append('<a id="err_center"  style="color: #d05050">Выберите дилерский центр или зарегистрируйте новый</a>');
      }
  });


    $('#center').select2().on('change.select2', function(e) {
          $("#send_request").removeAttr("disabled");
          $('err_center').remove();
  });
    $('#tariff').select2();
    $('#brand').select2().on('change.select2', function(e) {
      let loc_id = $('#region').val();
      let brand_id = $('#brand').val();
      console.log(loc_id);
      console.log(brand_id);
        if ( brand_id != '') {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'GET',
                url: '/registration/set-dealers',
                data: {
                    'loc_id': loc_id,
                    'brand_id': brand_id,
                },
                success: function (data) {
                    console.log(data);
                    if (data.length != 0){
                      $('#center').empty();
                      $('#center').select2({data:data});
                    };
                    if (data.length == 0){
                      var atad = [{id:0,text: "Выберите из списка", disabled:true},];
                      console.log(atad);
                      $('#center').empty();
                      $('#center').select2({data:atad , placeholder:"Выберите из списка"});
                    };
                },
                error: function (data, textStatus, errorThrown) {
                    console.log(data);

                },
            });
            $("#center").prop("disabled", false);
            $('.not-found-center').removeClass('disabled');
        }
    });
    $('#select2-center-container').on('chang.select2', function(e) {
        getVal = this.attr;
        console.log(getVal);
        if ( getVal != '') {
            $("#send_request").removeAttr('disabled');
        }
    });
    $('#tariff').select2().on('change.select2', function(e) {
        getVal = e.target.value;
        console.log(getVal);
        if ( getVal != '') {
            $("#brand").prop("disabled", false);
        }
    });


    $('.check').click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        console.log(e.target.id);
        $.ajax({
            type: 'GET',
            url: '/profile-DC/compose-check/{id}',
            data: {
                'loc_id': e.target.id,
            },
            success: function (data) {
                console.log(data);
            },
            error: function (data, textStatus, errorThrown) {

            },
        });
    })



  $('.section-login-first').each(function () {
    setTimeout(() => {
      document.querySelector('.popup-recovery-success').classList.add('show')
    }, 1000)
    setTimeout(() => {
      document.querySelector('.popup-recovery-success').classList.remove('show')
    }, 10000)
  })

    $('form#profile_form').validate({
        // debug: true,
        errorClass: 'error help-inline',
        // validClass: 'success',
        errorElement: 'span',
        highlight: function(element, errorClass, validClass) {
            $(element).parents("div.form-group").addClass(errorClass).removeClass(validClass);
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents(".error").removeClass(errorClass).addClass(validClass);
        },
        rules: {
            'first_name': {
                required: true,
            },
            'last_name': {
                required: true,
            },
        },
        messages: {
            'first_name': {
                required: 'Пожалуйста, введите имя',
            },
            'last_name': {
                required: 'Пожалуйста, введите фамилию',
            },
        },
    });

  $('form#registration').validate({
    // debug: true,
    errorClass: 'error help-inline',
    // validClass: 'success',
    errorElement: 'span',
    highlight: function(element, errorClass, validClass) {
      $(element).parents("div.form-group").addClass(errorClass).removeClass(validClass);
    },
    unhighlight: function(element, errorClass, validClass) {
      $(element).parents(".error").removeClass(errorClass).addClass(validClass);
    },
    rules: {
      'name': {
        required: true,
      },
      'last-name': {
        required: true,
      },
      'phone': {
        required: true,
      },
      'agree': {
        required: true,
      },
      'email': {
        required: true,
        email: true,
      },
    },
    messages: {
      'name': {
        required: 'Пожалуйста, введите имя',
      },
      'last_name': {
        required: 'Пожалуйста, введите фамилию',
      },
      'phone': {
        required: 'Пожалуйста, введите телефон',
      },
      'agree': {
        required: '',
      },
      'email': {
        required: 'Пожалуйста, введите e-mail',
        email: "Введите корректный e-mail, name@domain.com"
      },
    },
  });

  $('form#registration').find('input').on('blur keyup', function() {
    if ($("form#registration").valid()) {
      $('#reg').removeAttr('disabled');
    } else {
      $('#reg').attr('disabled', 'disabled');
    }
  });
  $('form#registration').find('input#agree').on('change', function(){
    if ($("form#registration").valid()) {
      $('#reg').prop('disabled', false);
    } else {
      $('#reg').prop('disabled', 'disabled');
    }
  });

  $('form#request').validate({
    // debug: true,
    errorClass: 'error help-inline',
    // validClass: 'success',
    errorElement: 'span',
    highlight: function(element, errorClass, validClass) {
      $(element).parents("div.form-group").addClass(errorClass).removeClass(validClass);
    },
    unhighlight: function(element, errorClass, validClass) {
      $(element).parents(".error").removeClass(errorClass).addClass(validClass);
    },
    rules: {
      'name': {
        required: true,
      },
      'agree': {
        required: true,
      },
      'email': {
        required: true,
        email: true,
      },
    },
    messages: {
      'name': {
        required: 'Пожалуйста, введите название',
      },
      'agree': {
        required: '',
      },
      'email': {
        required: 'Пожалуйста, введите e-mail',
        email: "Введите корректный e-mail, name@domain.com"
      },
    },
  });

  $('form#request').find('input').on('blur keyup', function() {
    if ($("form#request").valid()) {
      $('#send_request').removeAttr('disabled');
    } else {
      $('#send_request').attr('disabled', 'disabled');
    }
  });
  $('form#request').find('input#agree').on('change', function(){
    if ($("form#request").valid()) {
      $('#send_request').prop('disabled', false);
    } else {
      $('#send_request').prop('disabled', 'disabled');
    }
  });


  $('form#profile').validate({
    // debug: true,
    errorClass: 'error help-inline',
    // validClass: 'success',
    errorElement: 'span',
    highlight: function(element, errorClass, validClass) {
      $(element).parents("div.form-group").addClass(errorClass).removeClass(validClass);
    },
    unhighlight: function(element, errorClass, validClass) {
      $(element).parents(".error").removeClass(errorClass).addClass(validClass);
    },
    rules: {
      'full_name': {
        required: true,
      },
      'center_tel': {
        required: true,
      },
      'yur_address': {
        required: true,
      },
      'post_address': {
        required: true,
      },
      'inn': {
          required: true,
          digits:true,
          minlength: 10,
      },
      'kpp': {
          required: true,
          digits:true,
          rangelength: [9, 9],
      },
      'okpo': {
          required: true,
          digits:true,
          rangelength: [8, 10],
      },
      'bik': {
          required: true,
          digits:true,
          rangelength: [9, 9]
      },
      'ogrn': {
          required: true,
          digits:true,
          rangelength: [13, 13]
      },
      'okato': {
          required: true,
          digits:true,
          rangelength: [2, 11]
      },
      'name_dir': {
        required: true,
      },
      'mail_dc': {
        required: true,
        email: true,
      },
    },
    messages: {
      'full_name': {
        required: 'Пожалуйста, введите имя',
      },
      'center_tel': {
        required: 'Пожалуйста, введите телефон',
      },
      'yur_address': {
        required: 'Пожалуйста, введите адрес',
      },
      'inn': {
        required: 'Пожалуйста, введите ИНН',
          digits: 'ИНН должен содержать только цифры',
          minlength: 'Неверная длина ИНН',
      },
      'kpp': {
        required: 'Пожалуйста, введите КПП',
          digits: 'КПП должен содержать только цифры',
          rangelength: 'Неверная длина КПП',
      },
      'bik': {
        required: 'Пожалуйста, введите БИК',
          digits: 'БИК должен содержать только цифры',
          rangelength: 'Неверная длина БИК',
      },
      'ogrn': {
        required: 'Пожалуйста, введите ОГРН',
          digits: 'ОГРН должен содержать только цифры',
          rangelength: 'Неверная длина ОГРН',
      },
      'okpo': {
        required: 'Пожалуйста, введите ОКПО',
          digits: 'ОКПО должен содержать только цифры',
          rangelength: 'Неверная длина ОКПО',
      },
      'okato': {
        required: 'Пожалуйста, введите ОКАТО',
          digits: 'ОКАТО должен содержать только цифры',
          rangelength: 'Неверная длина ОКАТО',
      },
      'name_dir': {
        required: 'Пожалуйста, введите имя',
      },
      'post_address': {
        required: 'Пожалуйста, введите почтовый адрес',
      },
      'mail_dc': {
        required: 'Пожалуйста, введите e-mail',
        email: "Введите корректный e-mail, name@domain.com"
      },
    },
  });

  $('form#profile').find('input').on('blur keyup', function() {
    if ($("form#profile").valid()) {
      $('#save_profile').removeAttr('disabled');
    } else {
      $('#save_profile').attr('disabled', 'disabled');
    }
  });

  $("input[type='tel']").mask("+7 (999) 999-99-99");
  $('.for-input-pass input').keydown(function(e){
    $(this).val('');
  });

  $('.for-input-pass input').keyup(function(e){
    var $wrap = $('.for-input-pass');
    var $inputs = $wrap.find('input[type="number"]');
    var val = $(this).val();
    if (val != '') {
      $(this).addClass('selected')
    } else {
      $(this).removeClass('selected')
    }
    // Ввод только цифр
    if(val == val.replace(/[0-9]/, '')) {
      $(this).val('');
      return false;
    }

    $(this).keyup(function(e) {
      var len = $(this).val().length;

      if (len === 1) {

        $(this).next().focus().select();
      } else if (e.keyCode === 8) {
        $(this).prev().focus().select();
      } else if (e.keyCode === 46) {
        $(this).prev().focus().select();
      }
    });

    // Передача фокуса следующему innput
    $inputs.eq($inputs.index(this) + 1).focus();

    // Заполнение input hidden
    var fullval = '';
    $inputs.each(function(){
      fullval = fullval + (parseInt($(this).val()) || '0');
    });
    $wrap.find('input[type="hidden"]').val(fullval);
    let inputCount = $('.for-input-pass input.selected[type=number]').length;
    if(inputCount === 4) {
      $('#verif').removeAttr('disabled')
    } else {
      $('#verif').attr('disabled', 'disabled')
    }
  });
  $(document).on({
    mouseenter: function () {
      console.log('asd');
      var c = $(this).parent();
      c.find('span').removeClass('active');
      $(this).addClass('active');

      var i = c.find('span').index($(this)),
        cp = c.parent();
      console.log(i);
      cp.find('img').hide();
      cp.find('img').eq(i).show();
    },
    mouseleave: function () {
      //stuff to do on mouse leave
    }
  }, ".for-image span");

  $('.choises a').each(function () {
    var tooltipTitle = $(this).attr('title-tooltip');
    $( this ).mouseenter(function(){
      $( this ).append( "<span class='custom-tooltip'>"+tooltipTitle+"</span>" );
    });
    $( this ).mouseleave(function(){
      $( this ).find( ".custom-tooltip" ).remove();
    });
  });
  // $('.modal-footer .btn-accept').on('click', function () {
  //   $('#exampleModalCenterChoise').modal('hide');
  //   setTimeout(() => {
  //     $('#exampleModalCenterStop').modal('show');
  //   }, 500)
  // });

    $('.check').each(function () {
        var tooltipTitle = $(this).attr('title-tooltip');
        $( this ).mouseenter(function(){
            $( this ).append( "<span class='custom-tooltip'>"+tooltipTitle+"</span>" );
        });
        $( this ).mouseleave(function(){
            $( this ).find( ".custom-tooltip" ).remove();
        });
    });




  $('textarea').each(function () {
    this.setAttribute('style', 'height:' + (this.scrollHeight) + '392px;overflow-y:hidden;');
  }).on('input', function () {
    this.style.height = 'auto';
    this.style.height = (this.scrollHeight) + 'px';
  });

})

$('.section-personal-data__body .password-form-group').each(function () {

  $(this).find('.show-password').on('click', function(){
    let input = $(this).closest('.password-form-group').find('input');
    let eye = $(this).closest('.password-form-group').find('.show-password');

    if ($(input).attr('type') === 'password'){
      $(eye).toggleClass('hide');
      $(input).attr('type', 'text');
    } else {
      $(eye).toggleClass('hide');
      $(input).attr('type', 'password');
    }
  });

  $(this).find('input[type="password"]').keyup(function(){
    if ($(this).val().length > 0) {
        $(this).closest('.password-form-group').addClass('for-button')
      }
      if ($(this).val().length < 1 ) {
        $(this).closest('.password-form-group').removeClass('for-button')
      }
  });





})

$('.section-login-first').each(function () {
  const checkLength = function(evt) {
    if (loginField.value.length > 5 && passwordField.value.length > 5) {
      button.removeAttribute('disabled')
    }
    if (loginField.value.length < 5 || passwordField.value.length < 5) {
      button.setAttribute('disabled','')
    }
  }

  const checkPassword = function(che) {
    if (passwordField.value.length > 0) {
      passwordFormGroup.classList.add('for-button')
    }
    if (passwordField.value.length < 1) {
      passwordFormGroup.classList.remove('for-button')
    }
  }

  const loginField = document.querySelector('input[id="login"]')
  const passwordField = document.querySelector('input[id="password"]')
  const passwordFormGroup = document.querySelector('.password-form-group')
  let button = document.querySelector('#submit')
  loginField.addEventListener('keyup', checkLength)
  passwordField.addEventListener('keyup', checkLength)
  passwordField.addEventListener('keyup', checkPassword)
  let showPassword = document.querySelectorAll('.show-password');

  showPassword.forEach(item =>
    item.addEventListener('click', toggleType)
  );
  showPassword.forEach(item =>
    item.addEventListener('click', toggleEye)
  );


  function toggleType() {
    let input = document.querySelector('input[name="password"]');
    if (input.type === 'password') {
      input.type = 'text';
    } else {
      input.type = 'password';
    }
  }
  function toggleEye() {
    this.classList.toggle('hide')
  }


})





