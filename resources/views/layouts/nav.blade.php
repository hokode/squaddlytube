<nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">
             <i class="fas fa-film mr-2"></i>
                Squaddly Tube
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link nav-link-1 {{(request()->is('home')) || (request()->is('/'))  ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-2 {{(request()->is('videos')) || (request()->is('videos/*/edit'))  ? 'active' : '' }}" aria-current="page" href="{{ url('videos') }}">Videos</a>
                </li>
               
               
                
              

                @guest
                    @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link nav-link-3 {{(request()->is('login'))  ? 'active' : '' }}" href="{{ route('login') }}">
                            Sign In
                        </a>
                    </li>
                    @endif

                   
                @else

                   

                <li class="nav-item">
                    <a class="nav-link nav-link-4 {{(request()->is('videos/create'))  ? 'active' : '' }}" href="{{ route('videos.create') }}">Upload Videos</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link nav-link-5"> Welcome {{ Auth::user()->name }} </a>
                </li>

                    <li class="nav-item">
        <a class="nav-link nav-link-6" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Log Out</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                    </li>

                   
                @endguest
            </ul>
            </div>
        </div>
    </nav>
