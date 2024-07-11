<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="/logout" role="button">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="shad-button_ghost">
                        <img src="{{ asset('storage/images/logout.png') }}" alt="logout" style="max-width: 15px; max-height: 15px;">
                    </button>
                    
                </form>
            </a>
        </li>
    </ul>
</nav>