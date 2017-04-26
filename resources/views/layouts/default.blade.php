<!DOCTYPE html>
<html><head>
    <title>@yield('pageTitle') | DeepQuiz</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="" />
    <meta name="copyright" content="" />
    <link rel="stylesheet" type="text/css" href="css/kickstart.css" media="all" />                  <!-- KICKSTART -->
    <link rel="stylesheet" type="text/css" href="css/main.css" media="all" />                          <!-- CUSTOM STYLES -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/kickstart.js"></script>                                  <!-- KICKSTART -->
</head><body>

<!-- Menu Horizontal -->
<ul class="menu">
    <li class="current"><a href="/phpquiz/">Intro</a></li>
    <li><a href="">Item 2</a></li>
    <li><a href=""><span class="icon" data-icon="R"></span>Item 3</a>
        <ul>
            <li><a href=""><i class="fa fa-car"></i> Sub Item</a></li>
            <li><a href=""><i class="fa fa-arrow-circle-right"></i> Sub Item</a>
                <ul>
                    <li><a href=""><i class="fa fa-comments"></i> Sub Item</a></li>
                    <li><a href=""><i class="fa fa-check"></i> Sub Item</a></li>
                    <li><a href=""><i class="fa fa-cutlery"></i> Sub Item</a></li>
                    <li><a href=""><i class="fa fa-cube"></i> Sub Item</a></li>
                </ul>
            </li>
            <li class="divider"><a href=""><i class="fa fa-file"></i> li.divider</a></li>
        </ul>
    </li>
    <li><a href="">Item 4</a></li>
</ul>

<div class="grid">

    <!-- ===================================== END HEADER ===================================== -->

    <div>
        <div class="col_9">
            @yield('content')
        </div>


        <div class="col_3">
            <h5>Further Reading</h5>
            <ul class="icons">
                <li><a target="_blank" href="https://github.com/kamranahmedse/developer-roadmap">Developer Roadmap</a></li>
                <li><a target="_blank" href="https://www.amazon.com/Objects-Patterns-Practice-MATT-ZANDSTRA/dp/1484219953/ref=sr_1_1?ie=UTF8&qid=1490696546&sr=8-1&keywords=php+objects+patterns+and+practice">PHP Objects, Patterns and Practice</a></li>
                <li><a target="_blank" href="http://www.phpu.cc/books/phppro/">PHP Beginner To Pro</a></li>
            </ul>

            <h5><a style="text-decoration: dotted !important; color: black" href="http://www.phpexperts.pro/">PHP Experts.pro</a></h5>
            <i class="fa fa-twitter-square fa-3x"></i>
            <i class="fa fa-facebook-square fa-3x"></i>
            <i class="fa fa-linkedin-square fa-3x"></i>
            <i class="fa fa-github-square fa-3x"></i>

            <h5>Button w/Icon</h5>
            <a class="button orange small" href="#"><i class="fa fa-rss"></i> Donate</a>
        </div>

    </div>

</div><!-- END GRID -->

<!-- ===================================== START FOOTER ===================================== -->
<div class="clear"></div>
<div id="footer">
    &copy; Copyright 2017 All Rights Reserved. This website was built with <a href="http://www.99lime.com">HTML KickStart</a> and <a href="https://laravel.com/">Laravel</a>.
</div>

</body></html>