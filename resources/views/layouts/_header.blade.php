<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-static-top">
    <div class="container">
        <!-- Branding Image -->
        <a href="{{ url('/') }}" class="navbar-brand">
            LaraBBS
        </a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side of navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a href="{{ route('topics.index') }}" class="nav-link">话题</a></li>
                <li class="nav-item {{ category_nav_active(1) }}"><a href="{{ route('categories.show', 1) }}" class="nav-link">分享</a></li>
                <li class="nav-item {{ category_nav_active(2) }}"><a href="{{ route('categories.show', 2) }}" class="nav-link">教程</a></li>
                <li class="nav-item {{ category_nav_active(3) }}"><a href="{{ route('categories.show', 3) }}" class="nav-link">问答</a></li>
                <li class="nav-item {{ category_nav_active(4) }}"><a href="{{ route('categories.show', 4) }}" class="nav-link">公告</a></li>
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">登录</a></li>
                <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">注册</a></li>
                @else
                <li class="nav-item">
                    <a href="{{ route('topics.create') }}" class="nav-link mt-1 mr-3 font-weight-bold">
                        <i class="fa fa-plus"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" role="button" class="nav-link dropdown-toggle" id="navbarDropdown" data-toggle="dropdown">
                        <img src="{{ Auth::user()->avatar }}" style="width: 30px; height: 30px;" alt="{{ Auth::user()->name }}">
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a href="{{ route('users.show', Auth::id()) }}" class="dropdown-item">
                            <i class="far fa-user mr-2"></i>
                            个人中心
                        </a>
                        <a href="{{ route('users.edit', Auth::id()) }}" class="dropdown-item">
                            <i class="far fa-edit mr-2"></i>
                            编辑资料
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item" id="logout">
                            <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('您确定要退出吗?')">
                                {{ csrf_field() }}
                                <button class="btn btn-block btn-danger" type="submit" name="button">退出</button>
                            </form>
                        </a>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>