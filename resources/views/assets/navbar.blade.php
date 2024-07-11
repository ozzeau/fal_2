<section class="topbar md:hidden flex justify-between py-4 px-5">
    <a href="{{ route('home') }}" class="flex items-center gap-3">
        <img src=" {{ asset('storage/icons/lost-found.png') }}" alt="logo" class="h-10"> <!-- Adjust height as needed -->
    </a>
    <div class="flex items-center gap-4">
        <a href="{{route('userPage')}}" class="flex items-center gap-3">
            <img src="{{ asset('storage/users/'.Auth::user()->image ) }}" alt="profile" class="h-8 w-8 rounded-full"> <!-- Adjust height and width as needed -->
        </a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="shad-button_ghost">
                <img src="{{ asset('storage/icons/logout.svg') }}" alt="logout" class="h-6"> <!-- Adjust height as needed -->
            </button>
        </form>
    </div>
</section>