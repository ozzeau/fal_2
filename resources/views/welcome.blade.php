<a href="login">Login</a>
<br>
<a href="register">Register</a>
@if(Auth::check())
    {{-- User is authenticated --}}
    <p>Welcome, {{ Auth::user()->name }}</p>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
            Logout
        </button>
    </form>
@else
    {{-- User is not authenticated --}}
    <p>Please log in to continue.</p>
@endif

