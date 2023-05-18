<header class="header" id="header">
    <i class="header__toggle bx bx-menu" id="header__toggle"></i>
    <div class="header__container container">
        @guest
            <div class="header__authorisation ms-1">
                <a class="nav-link me-1 me-sm-3" href="{{ route('login') }}">
                    <button type="button" class="btn btn-primary">Вход</button>
                </a>
                <a class="nav-link" href="{{ route('register') }}">
                    <button type="button" class="btn btn-secondary">Регистрация</button>
                </a>
            </div>
        @else
            <div class="dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                   role="button"
                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <box-icon type='solid' name='user' size="md" color='#0066ff' border='circle'></box-icon>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('profile') }}">Профиль</a>
                    <a class="dropdown-item" href="{{ route('home') }}">Помощь</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        Выйти
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        @endguest
    </div>
</header>
