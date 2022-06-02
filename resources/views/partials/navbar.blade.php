<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{url('/')}}">Posts</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            @auth
            <!-- @if(auth()->check()) -->
            <li class="nav-item">
                <a class="nav-link" href="/teams">Teams</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/news">News</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/news/create">Create news</a>
            </li>
            <!-- @endif -->
            @endauth
           
            @guest
            <!-- @if(!auth()->check()) -->
            <li class="nav-item">
                <a class="nav-link" href="/register">Register</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('login')}}">Login</a>
            </li>
            <!-- @endif -->
            @endguest

            @auth
            <li class="nav-item">
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="btn btn-link">{{auth()->user()->name}}, Logout</button>
                </form>
            </li>
            @endauth
        </ul>
    </div>
</nav>
