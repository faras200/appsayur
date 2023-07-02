{{-- <nav class="navbar navbar-expand-lg navbar-dark bg-info">
    <div class="container">
      <a class="navbar-brand" href="/">P3D</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link {{ ($title === "Home")? 'active' : '' }}" href="/home">Home</a>
          <a class="nav-link  {{ ($title === "About")? 'active' : '' }}" href="/about">About</a>
          <a class="nav-link  {{ ($title === "Blog")? 'active' : '' }}" href="/blog">Blog</a>
        </div>
      </div>
    </div>
  </nav> --}}
  <nav class="navbar navbar-expand-lg  navbar-transparent navbar-fixed-top navbar-color-on-scroll" color-on-scroll=" " id="sectionsNav">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="presentation.html">P3D Himauntika UNIS TANGERANG</a>
        </div>

        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
          <li>
          <a href="/">
            <i class="material-icons">table</i> Dashboard
          </a>
        </li>
        <li><a class="nav-link {{ ($active === "home")? 'active' : '' }}" href="/home"><i class="material-icons">home</i>Home</a></li>
        <li> <a class="nav-link  {{ ($active === "about")? 'active' : '' }}" href="/about">About</a></li>
        <li><a class="nav-link  {{ ($active === "blog")? 'active' : '' }}" href="/blog">Blog</a></li>
        <li><a class="nav-link  {{ ($active === "categories")? 'active' : '' }}" href="/categories">Categories</a></li>
        <li><a class="nav-link  {{ ($active === "authors")? 'active' : '' }}" href="/authors">Authors</a></li>

        @auth
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Wellcome, {{ auth()->user()->name }}</a>
            <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="/dashboard"><i class="material-icons">dashboard</i>My Dashboard</a></li>
          <li class="divider"></li>
            <li>
              <form action="/logout" method="post">
                @csrf
                <button class="dropdown-item" type="submit"><i class="material-icons">logout</i>Logout</button>
              </form>
            </li>
            </ul>
        </li>
        @else
        <li><a class="nav-link btn btn-success btn-round {{ ($active === "login")? 'active' : '' }}" href="/login">Login</a></li>
        @endauth
        
          </ul>
        </div>
    </div>
  </nav>