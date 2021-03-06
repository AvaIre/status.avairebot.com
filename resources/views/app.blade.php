<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ isset($title) ? $title . ' - ' : null }}AvaIre - A multipurpose Discord bot made for fun</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="author" content="Alexis Tan">
    <meta name="description" content="AvaIre - A multipurpose Discord bot made for fun">
    <meta name="keywords" content="avaire, nodejs, javascript, discord-bot, discord, status">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--[if lte IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link href='https://fonts.googleapis.com/css?family=Miriam+Libre:400,700|Source+Sans+Pro:200,400,700,600,400italic,700italic' rel='stylesheet' type='text/css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ mix('assets/css/avaire.css') }}">
    @yield('styles')
</head>
<body class="@yield('body-class', 'home')">

    <div class="masthead-container">
        <div class="logo-container">
            <a href="https://avairebot.com/">
                <img src="https://avairebot.com/assets/img/banner-simple.png" alt="">
            </a>
        </div>
    </div>

    <div class="wrapper">
        @yield('content')
    </div>

    <footer class="main">
        <p class="text-center">
            Created by <a target="blank" href="https://senither.com">Alexis Tan</a>, powered by <a target="blank" href="https://m.do.co/c/9f589c4101c3">DigitalOcean</a> and <a target="blank" href="http://getbootstrap.com/">Bootstrap</a>
            <br>"Discord", "Discord App", and any associated logos are registered trademarks of Hammer &amp; Chisel, inc.
        </p>
    </footer>
    @yield('scripts')
</body>
</html>
