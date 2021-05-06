<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid container">
        <a class="navbar-brand" href="{{ route('home') }}">Test</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                @if (Auth::check())
                    <li class="nav-item"><a href="{{ route('dashboard') }}" class="nav-link me-3">{{ Auth::user()->getUsername() }}</a></li> 
                    <li class="nav-item"><a href="{{ route('auth.signout') }}" class="nav-link">Выйти</a></li>
                @else
                    <li class="nav-item"><a href="{{ route('auth.signin') }}" class="nav-link me-3">Войти</a></li>
                    <li class="nav-item"><a href="{{ route('auth.signup') }}" class="nav-link">Зарегистрироваться</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>