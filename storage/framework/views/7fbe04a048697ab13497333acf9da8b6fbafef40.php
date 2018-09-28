<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/main.css">
    </head>
<body>
<div class="container">
<nav class="nav-second">
    <ul>
      <li class="menu">
          <a class="menu" href="#"><i class="fa fa-bars" aria-hidden="true"></i>Menu</a>
      </li>
      <li>
          <a href="#"><i class="fa fa-question-circle" aria-hidden="true"></i>よくある質問</a>
      </li>
      <li>
          <a href="#"><i class="fa fa-info-circle" aria-hidden="true"></i>サービス流れ</a>
      </li>
        <li>
          <a href="#"><i class="fa fa-comments" aria-hidden="true"></i>メッセージ</a>
      </li>
    　<li>
          <a href="#"><i class="fa fa-list" aria-hidden="true"></i>依頼一覧<span class="notify">3</span></a>
      </li>
        <li>
          <a href="#"><i class="fa fa-list" aria-hidden="true"></i>提供履歴</a>
      </li>
    　<li>
          <a href="#"><i class="fa fa-user" aria-hidden="true"></i>hire123<i class="fa fa-caret-down" aria-hidden="true"></i></a>
          <ul class="submenu">
              <li><a href="#"><i class="fa fa-sign-out" aria-hidden="true"></i>ログアウト</a></li>
              <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i>会員情報</a></li>
          </ul>
      </li>
    </ul>
</nav>
<div class="hero">
    <h2>依頼内容</h2>
</div>
  <?php echo $__env->yieldContent('content'); ?>
<script src="<?php echo e(url('js/main.js')); ?>"></script>
</body>
</html>
