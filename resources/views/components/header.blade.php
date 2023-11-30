<header class="bg-success text-dark bg-opacity-10">
    <div class="container d-flex justify-content-between align-items-center">
        <a href="{{ route('post.index') }}" class="d-flex justify-content-between align-items-center">
            <img src="{{ asset('images/friends.png') }}" alt="みんなの掲示板のロゴ" width="70">
            <h1 class="fs-4 fw-bold">みんなの<span class="header__title"></span>掲示板</h1>
        </a>
        <nav class="navbar">
            <ul class="d-flex">
                @auth
                <li class="nav-item"><a class="nav-link active text-dark p-2" aria-current="page"
                        href="{{ route('profile.edit') }}">アカウント設定</a></li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" class="nav-link p-2">
                        @csrf
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();">ログアウト</a>
                        </form>
                    </li>
                    @endauth
                    @guest
                <li class="nav-item">
                    <a class="nav-link text-dark p-2" href="{{ route('register') }}">ユーザー登録</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark p-2" href="{{ route('login') }}">ログイン</a>
                </li>
                @endguest
            </ul>
        </nav>
    </div>
</header>