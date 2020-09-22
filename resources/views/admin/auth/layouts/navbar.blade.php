<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
    <div class="container">
        <div class="navbar-wrapper">
            <a class="navbar-brand" href="javascript:;">Login Page</a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                {{-- <li class="nav-item  {{ Str::contains(url()->current(), 'register') ? 'active' : ''  }}">
                    <a href="{{ route('registrationForm') }}" class="nav-link">
                        <i class="material-icons">person_add</i>
                        Register
                    </a>
                </li> --}}
                <li class="nav-item {{ Str::contains(url()->current(), 'login') ? 'active' : ''  }}">
                    <a href="{{ route('loginForm') }}" class="nav-link">
                        <i class="material-icons">fingerprint</i>
                        Login
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="material-icons">home</i>
                        Home
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>