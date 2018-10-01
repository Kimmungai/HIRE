<html>
<head>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css" rel="stylesheet">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title></title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{url('/css/chat.css')}}">
<link rel="stylesheet" href="{{url('/css/main.css')}}">
<link rel="stylesheet" href="{{url('/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{url('/css/new.css')}}">
<!--<script src="{{url('/js/modernizr-custom.js')}}"></script>-->
<script src="{{url('/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{url('/js/jquery-ui.min.js')}}"></script>
<script src="{{url('/js/jquery.timepicker.min.js')}}"></script>

</head>
<body>
  <nav>
    <link href="http://hiremitsumori.com/css/style.css" rel="stylesheet" media="screen,print">
    <link href="http://hiremitsumori.com/css/bootstrap-grid.min.css" rel="stylesheet" media="screen,print">
    <link href="http://hiremitsumori.com/font/typicons.min.css" rel="stylesheet" media="screen,print">
    <div class="container">
        <div class="top">
        <h1>ハイヤー手配の一括見積もりは東京ハイヤークラブ</h1>
        </div>
        <ul class="topnav" id="myTopnav">
            <li><a href="{{url('/')}}"><img class="logo" src="http://hiremitsumori.com/img/logo.png"></a></li>
            <li><a href="http://hiremitsumori.com/#about" class="smooth" target="_blank">ABOUT<br><small>当サービスについて</small></a></li>
            <li><a href="http://hiremitsumori.com/#plan" class="smooth" target="_blank">PLAN<br><small>ご利用プラン</small></a></li>
            <li><a href="http://hiremitsumori.com/#lineup" class="smooth" target="_blank">LINEUP<br><small>ラインナップ</small></a></li>
            <li><a href="http://hiremitsumori.com/#flow" class="smooth" target="_blank">FLOW<br><small>申込み手順</small></a></li>
            <li><a href="http://hiremitsumori.com/#contact" class="smooth" target="_blank">CONTACT<br><small>お問い合わせ</small></a></li>
            <li><a href="http://excia.jp/companyprofile" target="_blank" class="smooth">COMPANY<br><small>会社概要</small></a></li>
            <li class="menu">
                <a href="javascript:void(0);" onclick="myFunction()">☰ MENU</a>
            </li>
            <li>
                <a href="tel:03-5565-7763" class="phone">
                <div class="icon"><i class="typcn typcn-phone"></i></div>
                <div class="tel">
                    <p>お電話でのお問い合わせは</p>
                    <p><span>03-5565-7763</span></p>
                </div>
                </a>
            </li>
        </ul>
    </div>
  </nav>
  @yield('content')
  <footer>
      <link href="http://hiremitsumori.com/css/style.css" rel="stylesheet" media="screen,print">
      <link href="http://hiremitsumori.com/css/bootstrap-grid.min.css" rel="stylesheet" media="screen,print">
      <link href="http://hiremitsumori.com/font/typicons.min.css" rel="stylesheet" media="screen,print">
      <div class="container">
          <div class="row">
              <div class="col-md-4">
                  <img src="http://hiremitsumori.com/img/logo.png">
                  <ul>
                      <li><a href="http://excia.jp/contact" target="_blank">■ お問い合わせ</a></li>
                      <li><a href="http://excia.jp/privacypolicy" target="_blank">■ 個人情報に基づく表示</a></li>
                  </ul>
              </div>
              <div class="col-md-8">
                  &nbsp;
                  <p>運営会社　株式会社エクシア</p>
                  <p>〒104-8139</p>
                  <p>東京都中央区銀座3-9-11紙パルプ会館10F </p>
                  <p>TEL. 03-5565-7763　FAX. 03-5565-7764 </p>
                  <p class="copy">Copyright © EXCIA Co.,Ltd. All rights reserved.</p>
              </div>
          </div>
      </div>
      <input type="hidden" id="chatting_company">
      <input type="hidden" id="chatting_company_name">
  </footer>
  <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
  </form>
  <script src="{{url('/js/main.js')}}"></script>

  <script>
  $(document).ready(function(){
      var chatting_company=0;
      checkMessages();
    $('#typedMessage').keypress(function(e){
      if(e.which==13)
      {
        e.preventDefault();
        send_typed_message()
      }
    });
  });

  //load messages dynamically
  setInterval(all_unread_messages, 1000);
  setInterval(dynamic_messages, 1000);
  function close_chat_messages(){
    chatting_company=0;
    checkMessages();
  }
  function back_company_list(){
    chatting_company=0;
    checkMessages();
  }
  function dynamic_messages()
  {
    if(chatting_company)
    {
      $.get("/retrieve-messages/",
            {
              id:$('#chatting_company').val()
            },
            function(data,status){
              var messages=JSON.stringify(data);
              var messages_obj=JSON.parse(messages);
              var count=0;
              for(count=0;count<messages_obj.length;count++)
              {
                //var created_at= new Date(messages_obj[count].created_at);
                //var human_date=created_at.toLocaleTimeString()+' | '+created_at.toLocaleDateString();
                var human_date=messages_obj[count].created_at;
                if(messages_obj[count].user_id === {{Auth::id()}})
                {
                  var message='<div class="outgoing_msg" id="msg-serial-'+messages_obj[count].id+'"> <div class="sent_msg"> <p>'+messages_obj[count].message+'</p><span class="time_date">'+human_date+'</span> </div></div>';
                }
                else {
                  var message='<div class="incoming_msg" id="msg-serial-'+messages_obj[count].id+'"> <div class="incoming_msg_img"> <img src="{{url("/img/car-icon.png")}}" > </div><div class="received_msg"> <div class="received_withd_msg"> <p>'+messages_obj[count].message+'</p><span class="time_date"> '+human_date+'</span></div></div></div>';
                }

                if($('#msg-serial-'+messages_obj[count].id).length==0)
                {
                    $('#msg_history').append(message);
                    //$("#msg_history").animate({ scrollTop: $('#msg_history').offset().top }, 1000);
                    //$(".mesgs").animate({scrollTop: $('#msg_history').get(0).scrollHeight}, 1000);
                    //$(".mesgs #msg_history").animate({scrollTop: $('.mesgs #msg_history').get(0).scrollHeight}, 2000);
                    //$(".mesgs #msg_history").animate({scrollTop: $('.mesgs #msg_history').get(0).scrollHeight}, 100);
                }
              }

              //
          });
    }
  }

    function logout()
    {
      $('#logout-form').submit();
    }
    $('.open-chat').on('click',function(event){
      $('#chat').click();
    });
    /* chat starts here*/
    function checkMessages(){
    $.get("/check-messages",
          {
          },
          function(data,status){
            var count=0;
            //$('#company-list').html('');
            //$('#selected-chat-companies').html('');
            for(count=0;count<data.length;count++)
            {
              if(data[count][2]){var unread=data[count][2];}else{var unread='';}
              if(data[count][3]==1){var online_class='class="on"';online_status=1;}else{var online_class='class="off"';online_status=0;}
            //  var list_item='<li id="item-'+data[count][1]+'"><a '+online_class+' href="#" onclick="open_company_chats('+data[count][1]+',\''+data[count][0]+'\','+online_status+')">'+data[count][0]+'<span class="unread">'+unread+'</span><i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>';
              //var current_unread=$('#unread'+data[count][1]).text();
              //$('#company-list').append(list_item);
              if($('#chatting_company').val() === data[count][1]){active_status="active_chat";}else{active_status="";}
              var selected_chat_company='<div class="chat_list " id="item-'+data[count][1]+'" onclick="open_company_chats('+data[count][1]+',\''+data[count][0]+'\','+online_status+')"> <div class="chat_people"> <div class="chat_img"> <img src="{{url("/img/car-icon.png")}}" > </div><div class="chat_ib"> <h5>'+data[count][0]+' <span id="new-msg-'+data[count][1]+'" class="badge unread">'+unread+'</span></h5></div></div></div>';
              if($('#item-'+data[count][1]).length==0)
              {
                $('#selected-chat-companies').append(selected_chat_company);
              }
              $('#new-msg-'+data[count][1]+'').html(unread);

            }

    });
    }
    function open_company_chats(id,name,online_status)
    {
      chatting_company=id;
      //
      $('#chatting_company').val(id);
      $('#chatting_company_name').val(name);
      $('.chat_list').removeClass("active_chat");
      //$('#company_title').html(name);
      //if(online_status){$('#company_title').addClass('on');}else{$('#company_title').addClass('off');}
      //$('#open_company_id').val(id);
      $('.type_msg').removeClass('hidden');
      $('.messaging').removeClass('active_chat');
      $('#item-'+id).addClass('active_chat');
      $('#msg_history').html('');
      $.get("/retrieve-messages/",
            {
              id:id
            },
            function(data,status){
              var messages=JSON.stringify(data);
              var messages_obj=JSON.parse(messages);
              var count=0;
              for(count=0;count<messages_obj.length;count++)
              {
                //var created_at= new Date(messages_obj[count].created_at);
                //var human_date=created_at.toLocaleTimeString()+' | '+created_at.getMonth();
                var human_date=messages_obj[count].created_at;
                if(messages_obj[count].user_id=={{Auth::id()}})
                {
                  var message='<div class="outgoing_msg" id="msg-serial-'+messages_obj[count].id+'"> <div class="sent_msg"> <p>'+messages_obj[count].message+'</p><span class="time_date">'+messages_obj[count].created_at+'</span> </div></div>';
                }
                else {
                  var message='<div class="incoming_msg" id="msg-serial-'+messages_obj[count].id+'"> <div class="incoming_msg_img"> <img src="{{url("/img/car-icon.png")}}" > </div><div class="received_msg"> <div class="received_withd_msg"> <p>'+messages_obj[count].message+'</p><span class="time_date"> '+human_date+'</span></div></div></div>';
                }
                //var message='<article '+article_class+' id="msg-serial-'+messages_obj[count].id+'"> <div class="date">'+messages_obj[count].created_at+'</div><p>'+messages_obj[count].message+'</p> </article>';

                if($('#msg-serial-'+messages_obj[count].id).length==0)
                {
                    $('#msg_history').append(message);
                    //$("#msg_history").animate({scrollTop: $('#msg_history').get(0).scrollHeight}, 1000);
                  //$(".mesgs #msg_history").animate({scrollTop: $('.mesgs #msg_history').get(0).scrollHeight}, 1000);
                }
              }

              //$(".contact-list").animate({marginLeft: "-240px"});
              $(".mesgs #msg_history").animate({scrollTop: $('.mesgs #msg_history').get(0).scrollHeight}, 2000);
          });
    }
    function send_typed_message()
    {
        var message = $('#typedMessage').val();
        if(message != '' && chatting_company)
        {
          $.get("/save-typed-message/",
                {
                  message:message,
                  id: chatting_company
                },
                function(data,status){
              });
          $('#typedMessage').val('');
        }
    }
    function all_unread_messages()
    {
          $.get("/all-unread-messages/",
                {
                },
                function(data,status){
                  if(data ==='0' ){
                    $('#notification').removeClass('notify');
                    $('#notification').hide();}
                  else{
                      $('#notification').show();
                      $('#notification').addClass('notify');
                      $('#notification').html(data);}
              });
              checkMessages();

    }
    /* chat ends here*/
  </script>
</body>
</html>
