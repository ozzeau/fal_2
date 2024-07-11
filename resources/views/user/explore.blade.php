@include('assets.header')
@include('assets.navbar')

<section class="navbar-container">
    <nav class="leftsidebar flex flex-col justify-between items-start px-5 py-2 hidden md:flex border-r-4 border-purple-500" style="border-top-right-radius: 100px; border-bottom-right-radius: 100px;">
        @include('assets.sidebar')
    </nav>
</section>

<section class="flex flex-1 h-full">
    <div class="content-container flex flex-1">
        <div class="home-container p-16" style="width: 100%;">
            <div style="margin-bottom: 30px; display: flex; align-items: center;">
                <img src="{{ asset('storage/icons/add-post.svg') }}" width="40" height="40" alt="add" style="margin-right: 10px;">
                <h2 class="h2-bold text-left w-full" style="font-size: 28px; font-weight: bold;">Enter a keyword: </h2>
            </div>
            <br>

            <div class="relative">
                <input type="text" id="search-input" class="w-full p-3 pl-10 rounded-full border border-gray-300 text-black" placeholder="Search">
                <img src="{{ asset('storage/icons/search.svg') }}" class="absolute left-3 top-1/2 transform -translate-y-1/2" width="20" height="20" alt="search">
            </div>
        </div>
    </div>
</section>

<section class="flex flex-1 h-full">
    <div class="content-container flex flex-1">
        <div class="home-container w-full md:w-3/4 lg:w-3/5 xl:w-2/3 p-4 md:p-14">
            <div class="home-posts m-4 md:m-10">
                <h2 class="h3-bold md:h2-bold text-left w-full font-bold text-2xl md:text-3xl mb-6 md:mb-10">Results</h2>
                <ul class="flex flex-col flex-1 gap-4 md:gap-9 w-full" id="posts-list">
                    @foreach($posts as $post)
                    <li class="post p-4 rounded-lg shadow-md mb-6 hidden" data-author="{{ $post->author->Fname }}" data-caption="{{ $post->caption }}" data-location="{{ $post->location }}" data-categorie="{{ $post->categorie }}">
                        <div class="flex items-center mb-2 md:mb-4">
                            <div class="flex-shrink-0 w-10 h-10">
                                <img src="{{ !empty(Auth::user()->image) ? asset('storage/users/' . Auth::user()->image) : asset('storage/icons/profile-placeholder.svg') }}" alt="User Image" class="w-full h-full object-cover rounded-full">
                            </div>
                            <div class="ml-3">
                                <p class="font-semibold">{{ $post->author->Fname }}</p>
                                <p class="text-gray-500 text-sm">{{ $post->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                        <div class="post-content">
                            <div class="flex justify-center items-center">
                                <img src="{{ asset('storage/posts/' . $post->image) }}" alt="Content Image" class="h-auto w-full rounded-lg">
                            </div>
                        </div>
                        <div class="post-actions mt-3 md:mt-4 flex justify-between">
                            <button class="text-blue-500 flex items-center">
                                <svg width="30" height="30" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <!-- SVG path here -->
                                </svg>
                            </button>
                            <a href="message/{{$post->user_id}}" class="flex items-center justify-center text-blue-500">
                                <img src="{{ asset('storage/icons/chat.svg') }}" alt="Chat Icon" class="mr-1">
                                Contact
                            </a>
                        </div>
                        <p class="text-center mt-3 md:mt-4">{{ $post->caption }}</p>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="bottom-bar fixed bottom-0 w-full">
    @include('assets.bottombar')
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search-input');
        const postsList = document.getElementById('posts-list');
        const posts = postsList.getElementsByClassName('post');

        searchInput.addEventListener('input', function() {
            const filter = searchInput.value.toLowerCase();

            Array.from(posts).forEach(post => {
                const author = post.getAttribute('data-author').toLowerCase();
                const caption = post.getAttribute('data-caption').toLowerCase();
                const location = post.getAttribute('data-location').toLowerCase();
                const categorie = post.getAttribute('data-categorie').toLowerCase();

                if (author.includes(filter) || caption.includes(filter) || location.includes(filter) || categorie.includes(filter)) {
                    post.classList.remove('hidden');
                } else {
                    post.classList.add('hidden');
                }
            });
        });
    });
</script>