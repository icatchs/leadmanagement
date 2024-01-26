<nav class="navbar navbar-expand-lg navbar-dark bg-gradient-success" >
      <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">Track Leads</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link " href="/">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="{{ route('plans') }}">Plans</a>
            </li>
            @if (Route::has('login'))
                @auth
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('/home') }}">Dashboard</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                    @endif
                @endauth
            @endif
            <li class="nav-item">
              <a class="nav-link" href="{{ route('contactus') }}">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>