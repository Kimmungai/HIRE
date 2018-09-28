<!doctype html>
<html lang="ja" ng-app="validate">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{url('/css/main.css')}}">
        <!--<script src="{{url('/js/modernizr-custom.js')}}"></script>-->
        <script src="{{url('js/jquery-3.2.1.min.js')}}"></script>
        <script src="{{url('js/jquery-ui.min.js')}}"></script>
        <script src="{{url('js/jquery.timepicker.min.js')}}"></script>
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
                <li><a href="index.html" target="_blank"><img class="logo" src="http://hiremitsumori.com/img/logo.png"></a></li>
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
        <div class="container form-register" ng-controller="ValidateCtrl">
        <nav class="nav-second">
            <ul>
              <li>
                  <a class="" href="#"><i class="fa fa-question-circle" aria-hidden="true"></i>よくある質問</a>
              </li>
              <li>
                  <a class="" href="/"><i class="fa fa-info-circle" aria-hidden="true"></i>サービスの流れ</a>
              </li>
            　<li class="open-chat">
                  <a class="" href="#"><i class="fa fa-comments" aria-hidden="true"></i>メッセージ</a>
              </li>
            　<li>
                  <a class="" href="/client_order_view_all"><i class="fa fa-list" aria-hidden="true"></i>注文履歴</a>
              </li>
            　<li>
                  <a class="" href="/new_order"><i class="fa fa-plus-circle" aria-hidden="true"></i>新しいご注文</a>
              </li>
            　<li>

                    @if(Auth::user())
                      <a href="#" class="toggle" ><i class="fa fa-user" aria-hidden="true"></i>{{Auth::user()->company_name}}<i class="fa fa-caret-down" aria-hidden="true"></i></a>
                    @else
                    <a href="/login"><i class="fa fa-user" aria-hidden="true"></i>Login<i class="fa fa-caret-down" aria-hidden="true"></i></a>
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
              <li class="menu">
                  <a class="hidden" href="#">Menu</a>
              </li>
            </ul>
        </nav>
    @yield('content')
    <!-- chat starts here -->
<div class="chat">
    <div id="toggle-chat" class="chat-btn">
        <a class="but" href="#">
            <i id="chat" class="fa fa-comments" aria-hidden="true"></i><span class="notify">2</span>
        </a>
    </div>
    <div class="chat-open">
        <div class="chat-container">
        <div class="contact-list">
            <header><h5>メッセージ</h5><a href="#" class="pull-right close"><i class="fa fa-times" aria-hidden="true"></i></a></header>
            <ul>
                <li><a class="on" href="#">株式会社2<span class="unread">2</span><i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
                <li><a class="off" href="#">株式会社3<i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
                <li><a class="on" href="#">株式会社4<i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
                <li><a class="off" href="#">株式会社5<i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
                <li><a class="off" href="#">株式会社6<i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
                <li><a class="off" href="#">株式会社2<i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
                <li><a class="off" href="#">株式会社2<i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
                <li><a class="off" href="#">株式会社2<i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
                <li><a class="off" href="#">株式会社3<i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
                <li><a class="off" href="#">株式会社4<i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
            </ul>
        </div>
        <div class="contact-message">
        <header><a class="back" href="#"><i class="fa fa-chevron-left" aria-hidden="true"></i></a> <h5 class="on">株式会社1</h5> <a href="#" class="pull-right close"><i class="fa fa-times" aria-hidden="true"></i></a></header>
        <div class="scroll">
        <article class="to">
            <div class="date">2017/08/12 14:00</div>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vehicula est non lacinia fringilla. </p>
        </article>
        <article class="from">
            <div class="date">2017/08/12 14:00</div>
            <span class="name">田中　正和</span>
            <p>Cras rutrum hendrerit erat, ut rhoncus eros rhoncus sed. Donec pellentesque est a justo porta viverra. Praesent et arcu tellus. </p>
        </article>
        <article class="from">
            <div class="date">2017/08/12 14:00</div>
            <span class="name">田中　正和</span>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vehicula est non lacinia fringilla. </p>
        </article>
        <article class="to">
            <div class="date">2017/08/12 14:00</div>
            <p>Cras rutrum hendrerit erat, ut rhoncus eros rhoncus sed. Donec pellentesque est a justo porta viverra. Praesent et arcu tellus. </p>
        </article>
        </div>
        <div class="input">
            <textarea></textarea><a class="send" href="#">送信</a>
        </div>
        </div>
        </div>
    </div>
</div><!--chat ends here-->
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
    <script>
      function logout()
      {
        $('#logout-form').submit();
      }
      $('.open-chat').on('click',function(event){
        event.preventDefault();
        $('#chat').click();
      });
    </script>
    <script src="{{url('js/angular.min.js')}}"></script>
    <script src="{{url('js/main.js')}}"></script>
    <script src="{{url('js/app.js')}}"></script>
  </body>
</html>
