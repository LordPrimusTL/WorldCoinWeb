<nav class="side-navbar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
        <div class="avatar"><img src="{{asset('images/profile/' . Auth::user()->image )}}" alt="..." class="img-fluid rounded-circle"></div>
        <div class="title">
            <h1 class="h4">{{Auth::user()->firstname . ' ' .Auth::user()->lastname}}</h1>
            <p>CMIC Admin</p>
        </div>
    </div>
    <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
    <ul class="list-unstyled">
        <li class="{{Request::is('admin/dashboard') ? "active" : " "}}"> <a href="{{route('admin_dashboard')}}"><i class="fa fa-user"></i>&nbsp;Users</a></li>
    </ul>
</nav>