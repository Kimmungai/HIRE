<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{url('/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{url('/css/simple-sidebar.css')}}">
        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script src="{{url('/js/bootstrap.min.js')}}"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                        東京ハイヤークラブ
                </li>
                <li>
                    <a href="/admin-company-accounts">ハイヤー会社一覧<small>1</small></a>
                </li>
                <li>
                    <a href="/admin-client-accounts" class="current">お客様一覧</a>
                </li>
                <li>
                    <a href="/admin-orders">依頼一覧</a>
                </li>
                <li>
                    <a href="/admin-transactions">取引一覧</a>
                </li>
                <li>
                    <a href="/admin-message-hist">メッセージ履歴</a>
                </li>
                <li>
                    <a href="/admin-trash">ゴミ箱</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        @yield('content')

    </div>
    <!-- /#wrapper -->
    <script src="/js/main.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
</body>

</html>
