<!-- Header -->
@include('assets.header')

<style>
    .pb-full {
        padding-bottom: 100%;
    }

    .search-bar:focus+.fa-search {
        display: none;
    }

    @media screen and (min-width: 768px) {
        .post:hover .overlay {
            display: block;
        }
    }
</style>

<!-- Navbar -->
@include('assets.navbar')

<!-- Main Layout Container -->
<div class="flex h-full">

    <!-- Fixed Sidebar -->
    <section class="navbar-container">
        <nav class="leftsidebar flex flex-col justify-between items-start px-5 py-2 hidden md:flex border-r-4 border-purple-500" style="border-top-right-radius: 100px; border-bottom-right-radius: 100px;">
            @include('assets.sidebar')
        </nav>
    </section>

    <!-- Main Content -->
    <section class="flex-1 ml-auto mr-0 md:ml-64 p-4 md:p-8">
        <div class="lg:w-8/12 lg:mx-auto mb-8">
            <!-- Header Section (Rendered Once) -->
            <header class="flex flex-wrap items-center">
                <div class="md:w-3/12 md:ml-16">
                    <!-- Profile Image -->
                    @php
                    $profileImage = Auth::user()->image ? asset('storage/users/' . Auth::user()->image) : asset('storage/icons/profile-placeholder.svg');
                    @endphp
                    <img class="w-20 h-20 md:w-40 md:h-40 object-cover rounded-full border-2 border-pink-600 p-1" src="{{ $profileImage }}" alt="Profile">
                </div>

                <!-- Profile Meta for Medium Screens -->
                <div class="w-8/12 md:w-7/12 ml-4">
                    <div class="md:flex md:flex-wrap md:items-center mb-4">
                        <h2 class="text-3xl font-light md:mr-2 mb-2 sm:mb-0">{{ Auth::user()->Fname }} {{ Auth::user()->Lname }}</h2>
                        <span class="fas fa-certificate fa-lg text-blue-500 relative mr-6 text-xl transform -translate-y-2" aria-hidden="true">
                            <i class="fas fa-check text-white text-xs absolute inset-x-0 ml-1 mt-px"></i>
                        </span>
                        <a href="edit" class="bg-blue-500 px-2 py-1 text-white font-semibold text-sm rounded block text-center sm:inline-block">Edit Profile</a>
                    </div>

                    <!-- User Meta for Medium Screens -->
                    <div class="hidden md:block">
                        <h1 class="font-semibold">@ {{ Auth::user()->username }}</h1>
                        <span>Email: {{ Auth::user()->email }}</span>
                        <p>Phone Number: {{ Auth::user()->gsm }}</p>
                    </div>
                </div>
            </header>
            <br>
            <!-- Posts Section -->
            <div class="px-px md:px-3">
                <!-- Insta Features -->
                <ul class="flex items-center justify-around md:justify-center space-x-12 uppercase tracking-widest font-semibold text-xs text-gray-600 border-t">
                    <li class="md:border-t md:border-gray-700 md:-mt-px md:text-gray-700">
                        <div class="inline-block p-3">
                            <i class="fas fa-th-large text-xl md:text-xs"></i>
                            <span class="hidden md:inline">Posts</span>
                        </div>
                    </li>
                </ul>

                <!-- Flexbox Grid (Posts Loop) -->
                <div class="flex flex-wrap -mx-px md:-mx-3 justify-center md:justify-start">
                    @foreach($posts as $post)
                    <!-- Column -->
                    <div class="w-1/3 p-px md:px-3">
                        <!-- Post Item -->
                        <a href="#">
                            <article class="post bg-gray-100 text-white relative pb-full md:mb-6 rounded-lg overflow-hidden">
                                @php
                                $postImage = asset('storage/posts/' . $post->image);
                                @endphp
                                <img class="w-full h-full absolute left-0 top-0 object-cover rounded-lg" src="{{ $postImage }}" alt="Image">
                                <i class="fas fa-square absolute right-0 top-0 m-1"></i>
                                <div class="overlay bg-gray-800 bg-opacity-25 w-full h-full absolute left-0 top-0 hidden">
                                    <form action="{{ route('psts.delete', ['id' => $post->id]) }}" class="flex justify-center items-center space-x-4 h-full" method="post">
                                        @csrf
                                        @method('delete')
                                        <span class="p-2">
                                            <button class="bg-red-500 text-white px-2 py-1 rounded flex items-center" type="submit" onclick="return confirmDelete()">
                                                <img src="{{ asset('storage/icons/delete.svg') }}" alt="" class="mr-2">
                                                Delete
                                            </button>
                                        </span>
                                    </form>
                                </div>
                            </article>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Bottom Bar -->
<section class="bottom-bar fixed bottom-0 w-full">
    @include('assets.bottombar')
</section>

<!-- Delete Confirmation Script -->
<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this post?');
    }

    function deletePost(postId) {
        if (confirmDelete()) {
            // User confirmed, make AJAX request to delete post
            axios.delete(`/posts/${postId}`)
                .then(response => {
                    // Handle success, e.g., remove post from UI
                    console.log('Post deleted successfully.');
                    // Optionally, update UI to reflect deletion
                })
                .catch(error => {
                    // Handle error
                    console.error('Error deleting post:', error);
                });
        }
    }
</script>