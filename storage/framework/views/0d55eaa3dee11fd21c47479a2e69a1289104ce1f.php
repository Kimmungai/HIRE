<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/main.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
<body>
<div class="container">
<nav class="nav-second">
    <ul>
      <li>
          <a class="" href="#"><i class="fa fa-question-circle" aria-hidden="true"></i>よくある質問</a>
      </li>
      <li>
          <a class="" href="#"><i class="fa fa-info-circle" aria-hidden="true"></i>サービスの流れ</a>
      </li>
    　<li>
          <a class="" href="#"><i class="fa fa-comments" aria-hidden="true"></i>メッセージ</a>
      </li>
    　<li>
          <a class="" href="#"><i class="fa fa-list" aria-hidden="true"></i>注文履歴</a>
      </li>
    　<li>
          <a class="" href="#"><i class="fa fa-plus-circle" aria-hidden="true"></i>新しいご注文</a>
      </li>
    　<li>
          <a class="" href="#"><i class="fa fa-user" aria-hidden="true"></i>user335<i class="fa fa-caret-down" aria-hidden="true"></i></a>
          <ul class="submenu">
              <li><i class="fa fa-sign-out" aria-hidden="true"></i><a href="#">ログアウト</a></li>
              <li><i class="fa fa-user" aria-hidden="true"></i><a href="#">会員情報</a></li>
          </ul>
      </li>
      <li class="menu">
          <a class="hidden" href="#">Menu</a>
      </li>
    </ul>
</nav>
<div class="hero">
    <h2>注文内容</h2>
</div>
  <?php echo $__env->yieldContent('content'); ?>
<script src="<?php echo e(url('js/main.js')); ?>"></script>
</body>
</html>
