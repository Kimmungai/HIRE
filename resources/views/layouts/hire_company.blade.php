<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{url('/css/main.css')}}">
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
<div class="container">
  @if(Auth::user()->admin_approved==0)
    <h1>アカウントは未承認です</h1>
  @endif
<nav class="nav-second">
    <ul>
      <li class="menu">
          <a class="menu" href="#"><i class="fa fa-bars" aria-hidden="true"></i>Menu</a>
      </li>
      <li>
          <a href="/company-faq"><i class="fa fa-question-circle" aria-hidden="true"></i>よくある質問</a>
      </li>
      <li>
          <a href="/"><i class="fa fa-info-circle" aria-hidden="true"></i>サービス流れ</a>
      </li>
        <li class="">
          <a href="/chat"><i class="fa fa-comments" aria-hidden="true"></i>メッセージ<span id="notification"></span></a>
      </li>
    　<li>
          <a href="/company_order_view_all"><i class="fa fa-list" aria-hidden="true"></i>依頼一覧<!--<span class="notify"></span>--></a>
      </li>
        <li>
          <a href="/my-bids"><i class="fa fa-list" aria-hidden="true"></i>提供履歴</a>
      </li>
    　<li>
      @if(Auth::user())
        <a class="toggle" href="#"><i class="fa fa-user" aria-hidden="true"></i>{{Auth::user()->last_name}}<i class="fa fa-caret-down" aria-hidden="true"></i></a>
      @else
      <a  href="/login"><i class="fa fa-user" aria-hidden="true"></i>Login<i class="fa fa-caret-down" aria-hidden="true"></i></a>
      @endif
          <ul class="submenu">
            @if(Auth::user())
              <li><a href="#" onclick="logout()"><i class="fa fa-sign-out" aria-hidden="true"></i>ログアウト</a></li>
            @else
              <li><a href="/login"><i class="fa fa-sign-out" aria-hidden="true"></i>ログイン</a></li>
            @endif
              <li><a href="/mypage"><i class="fa fa-user" aria-hidden="true"></i>会員情報</a></li>
          </ul>
      </li>
    </ul>
</nav>
  @yield('content')
  <!-- chat starts here -->
  @if(Auth::user())
  <!--<div class="chat">
      <div id="toggle-chat" class="chat-btn">
          <a class="but" href="#">
              <i id="chat" class="fa fa-comments" aria-hidden="true"></i><span id="notification"></span>
          </a>
      </div>
      <div class="chat-open">
          <div class="chat-container">
          <div class="contact-list">
              <header><h5>メッセージ</h5><a href="#" class="pull-right close"><i class="fa fa-times" aria-hidden="true"></i></a></header>
              <ul id="company-list">

              </ul>
          </div>
          <div class="contact-message">
          <header><a class="back" href="#" onclick="back_company_list()"><i class="fa fa-chevron-left" aria-hidden="true"></i></a> <h5 id="company_title" class="on"></h5> <a  href="#" class="pull-right close" onclick="close_chat_messages()"><i class="fa fa-times" aria-hidden="true"></i></a></header>
            <div class="scroll" id="message-list">

            </div>
          <div class="input">
              <textarea id="typedMessage"></textarea><a class="send" href="#" onclick="send_typed_message()">送信</a>
          </div>
          </div>
          </div>
      </div>
  </div>--><!--chat ends here-->
  @endif
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
            id:chatting_company
          },
          function(data,status){
            var messages=JSON.stringify(data);
            var messages_obj=JSON.parse(messages);
            var count=0;
            for(count=0;count<messages_obj.length;count++)
            {
              if(messages_obj[count].user_id=={{Auth::id()}})
              {
                var article_class='class="to"';
              }
              else {
                var article_class='class="from"';
              }
              var message='<article '+article_class+' id="msg-serial-'+messages_obj[count].id+'"> <div class="date">'+messages_obj[count].created_at+'</div><p>'+messages_obj[count].message+'</p> </article>';
              if($('#msg-serial-'+messages_obj[count].id).length==0)
              {
                  $('#message-list').append(message);
                  $(".contact-message .scroll").animate({scrollTop: $('.contact-message .scroll').get(0).scrollHeight}, 2000);
              }
            }
        });
  }
}
  function logout()
  {
    $('#logout-form').submit();
  }
  /*$('.open-chat').on('click',function(event){
    $('#chat').click();
  });*/
  /* chat starts here*/
  function checkMessages(){
  $.get("/check-company-messages",
        {
        },
        function(data,status){
          var count=0;
          $('#company-list').html('');
          for(count=0;count<data.length;count++)
          {
            if(data[count][2]){var unread=data[count][2];}else{var unread='';}
            if(data[count][3]==1){var online_class='class="on"';online_status=1;}else{var online_class='class="off"';online_status=0;}
            var list_item='<li id="item-'+data[count][1]+'"><a '+online_class+' href="#" onclick="open_company_chats('+data[count][1]+',\''+data[count][0]+'\','+online_status+')">'+data[count][0]+'<span class="unread">'+unread+'</span><i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>';
            var current_unread=$('#unread'+data[count][1]).text();
            $('#company-list').append(list_item);
          }
  });
  }
  function open_company_chats(id,name,online_status)
  {
    chatting_company=id;
    $('#company_title').removeClass();
    $('#company_title').html(name);
    if(online_status){$('#company_title').addClass('on');}else{$('#company_title').addClass('off');}
    $('#open_company_id').val(id);
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
              if(messages_obj[count].user_id=={{Auth::id()}})
              {
                var article_class='class="to"';
              }
              else {
                var article_class='class="from"';
              }
              var message='<article '+article_class+' id="msg-serial-'+messages_obj[count].id+'"> <div class="date">'+messages_obj[count].created_at+'</div><p>'+messages_obj[count].message+'</p> </article>';
              if($('#msg-serial-'+messages_obj[count].id).length==0)
              {
                  $('#message-list').append(message);
              }
            }
            $(".contact-list").animate({marginLeft: "-240px"});
            $(".contact-message .scroll").animate({scrollTop: $('.contact-message .scroll').get(0).scrollHeight}, 2000);
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
