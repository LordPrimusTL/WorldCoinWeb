<div class="header" style="background-color:green;">
    <div class="container">
        <div class="w3_agile_logo">
            <h1><a href="{{route('home')}}"><span>W</span>orld Coins</a></h1>
        </div>
        <div class="agile_header_social">
            <ul class="agileits_social_list">
                <li><a href="#" class="w3_agile_facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="" class="agile_twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#" class="w3_agile_dribble"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>
                <li><a href="#" class="w3_agile_vimeo"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>
            </ul>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
<!-- header -->
<!-- banner -->
<div style="background-color:yellow;">
    <div class="container">
        <nav class="navbar navbar-default">
            <div class="navbar-header navbar-left">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
                <nav class="link-effect-12">
                    <ul class="nav navbar-nav w3_agile_nav">
                        <li class="{{Request::is('/') ? 'active' : ''}}"><a href="{{route('home')}}"><span>Home</span></a></li>
                        <li><a href="#"><span>Contact Us</span></a></li>
                        <li><a href="{{route('about')}}"><span>About Us</span></a></li>
                        <li class="dropdown {{Request::is('register') || Request::is('login') ? 'active' : ''}}">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span data-hover="Short Codes">Accounts</span> <b class="caret"></b></a>
                            <ul class="dropdown-menu agile_short_dropdown">
                                <li><a href="{{route('register')}}">Register</a></li>
                                <li><a href="{{route('login')}}">Login</a></li>
                            </ul>
                        </li>
                        <li><a href="{{route('contact')}}"><span>Mail Us</span></a></li>
                    </ul>
                    <div class="w3_agileits_search_form">
                        <form action="#" method="post">
                            <input type="search" name="Search" placeholder="Search" required="">
                            <input type="submit" value=" ">
                        </form>
                    </div>
                </nav>
            </div>
        </nav>
    </div>
    <br/>
</div>