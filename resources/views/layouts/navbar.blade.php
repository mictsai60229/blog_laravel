<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="index.html">Start Bootstrap</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
            <a class="nav-link" href="home">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="post">Post</a>
            </li>

            @auth
            <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @endauth

            @guest
            <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}" onclick="event.preventDefault(); document.getElementById('login-form').submit();">
                Login
            </a>
            </li>
            <form id="login-form" action="{{ route('login') }}" method="GET" style="display: none;">
            </form>
            @endguest
        </ul>
        </div>
    </div>
</nav>