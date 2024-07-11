    <!-- Header -->
    @include('assets.header')
    @include('assets.navbar')

    <!-- Navbar Container -->
    <section class="navbar-container">
        <nav class="leftsidebar flex flex-col justify-between items-start px-5 py-2 hidden md:flex border-r-4 border-purple-500" style="border-top-right-radius: 100px; border-bottom-right-radius: 100px;">
            @include('assets.sidebar')
        </nav>
    </section>

    <!-- Topbar (for smaller screens) -->


    <!-- Main Content Section -->
    <section class="flex flex-1 h-full">
        <div class="content-container flex flex-1 flex-col md:flex-row">
            <!-- Left Content (Profile Update Form) -->
            <div class="w-full md:w-3/5 p-10 border-r border-gray-600 mx-auto mb-4">
                <center>
                    <form action="{{ route('user.update') }}" method="POST" class="w-full max-w-lg flex flex-col items-center mb-6" enctype="multipart/form-data">
                        @csrf
                        <div class="text-center mb-6">
                            <img src="{{  !empty($data->image) ? asset('storage/users/' . $data->image ): asset('storage/icons/profile-placeholder.svg') }}" alt="Profile Picture" class="w-32 h-32 rounded-full mx-auto hover:opacity-80 transition duration-300">
                        </div>
                        <div class="text-center mb-6">
                            <input type="file" id="fileInput" class="hidden" name="image">
                            <label for="fileInput" class="cursor-pointer px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                                <span id="fileInputLabel">Add Profile Pic</span>
                            </label>
                        </div>

                        <div class="space-y-4 w-full">
                            @if(session('success'))
                            <p class="text-green-500 text-sm mt-2 ml-2">{{ session('success') }}</p>
                            @endif
                            @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            <p class="text-red-500 text-sm mt-2 ml-2">{{ $error }}</p>
                            @endforeach
                            @endif
                            <div class="w-full">
                                <label for="Fname" class="text-sm font-medium text-gray-300 mb-">First Name</label>
                                <input type="text" id="Fname" name="Fname" value="{{ old('Fname', $data->Fname) }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md dark:bg-gray-800 text-black py-3 px-3">
                            </div>
                            <div class="w-full">
                                <label for="Lname" class="block text-sm font-medium text-gray-300 mb-1">Last Name</label>
                                <input type="text" id="Lname" name="Lname" value="{{ old('Lname', $data->Lname) }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md dark:bg-gray-800 text-black py-3 px-3">
                            </div>
                            <div class="w-full">
                                <label for="username" class="block text-sm font-medium text-gray-300 mb-1">Username</label>
                                <input type="text" id="username" name="username" value="{{ old('username', $data->username) }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md dark:bg-gray-800 text-black py-3 px-3">
                            </div>
                            <div class="w-full">
                                <label for="gsm" class="block text-sm font-medium text-gray-300 mb-1">Phone number</label>
                                <input type="number" id="gsm" name="gsm" value="{{ old('gsm', $data->gsm) }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md dark:bg-gray-800 text-black py-3 px-3">
                            </div>
                            <div class="w-full">
                                <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email', $data->email) }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md dark:bg-gray-800 text-black py-3 px-3">
                            </div>
                            <div class="w-full">
                                <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Password</label>
                                <input type="password" id="password" name="password" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md dark:bg-gray-800 text-black py-3 px-3">
                            </div>
                            <br>
                            <input type="submit" value="Change" class="w-full py-3 px-4 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                        </div>
                    </form>
                </center>
            </div>

            <!-- Right Content (Settings Links) -->
            <div class="w-full md:w-1/3 p-6 flex flex-col items-center mb-6 md:mb-0">
                <h3 class="text-lg font-bold mb-2 text-left w-full">Settings</h3>
                <div class="space-y-2 w-full">
                    <a href="edit" class="flex gap-2 items-center p-2 font-bold bg-gray-800 rounded-lg hover:bg-gray-700 transition duration-300">
                        <img src="{{ asset('storage/icons/people.svg') }}" alt="" class='group-hover:invert-white' />
                        <span>Change personal information</span>
                    </a>
                    <a href="{{route('userPage')}}" class="flex gap-2 items-center mb-4 p-2 font-bold bg-gray-800 rounded-lg hover:bg-gray-700 transition duration-300">
                        <img src="{{ asset('storage/icons/people.svg') }}" alt="" class='group-hover:invert-white' />
                        <span>user page</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="md5">

        </div>
    </section>

    <!-- Bottom Bar -->
    <section class="bottom-bar">
        @include('assets.bottombar')
    </section>