@extends('assets.header')

<section class="topbar md:hidden flex justify-between py-4 px-5">
    <a href="{{ route('home') }}" class="flex items-center gap-3">
        <img src="{{ asset('storage/images/logo.svg') }}" alt="logo" class="h-8">
    </a>
    <div class="flex items-center gap-4">
        <a href="{{ route('userPage') }}" class="flex items-center gap-3">
            <img src="{{ asset('storage/users/'.Auth::user()->image ) }}" alt="profile" class="h-8 w-8 rounded-full">
        </a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="shad-button_ghost">
                <img src="{{ asset('storage/icons/logout.svg') }}" alt="logout" class="h-6">
            </button>
        </form>
    </div>
</section>

<section class="navbar-container">
    <nav class="leftsidebar flex flex-col justify-between items-start px-5 py-2 hidden md:flex border-r-4 border-purple-500" style="border-top-right-radius: 100px; border-bottom-right-radius: 100px;">
        @include('assets.sidebar')
    </nav>
</section>

<section class="flex flex-1 h-full">
    <div class="content-container flex flex-1">
        <div class="home-container p-16 mb-20" style="width: 100%;">
            <div style=" display: flex; align-items: center;">
                <img src="{{ asset('storage/icons/add-post.svg') }}" width="40" height="40" alt="add" style="margin-right: 10px;">
                <h2 class="h2-bold text-left w-full" style="font-size: 28px; font-weight: bold;">Create Post</h2>
            </div>

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('store') }}" enctype="multipart/form-data">
                @csrf
                <div class="space-y-2 flex flex-col">
                    <label class="font-bold">Caption</label>
                    <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                    <textarea name="caption" class="w-full rounded-lg" style="color: white; padding: 10px; background-color: #333333; min-height: 150px; resize: vertical;"></textarea>
                </div>

                <div class="space-y-2">
                    <label class="font-bold">Add Photos</label>
                    <div>
                        <div id="fileUploader" class="file_uploader-box w-full rounded-lg" style="height: 300px; display: flex; flex-direction: column; justify-content: center; align-items: center; border: 2px dashed #ccc;">
                            <img src="{{ asset('storage/icons/add-post.svg') }}" width="40" height="40" alt="Add Post">
                            <h3 class="base-medium text-light-2 mb-2 mt-6">Drag photo here</h3>
                            <p class="text-light-4 small-regular mb-6">SVG, PNG, JPG, JPEG</p>
                            <label for="fileInput" class="bg-gray-900 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded-full cursor-pointer">
                                Select from computer
                                <input type="file" id="fileInput" style="display: none;" name="file" multiple>
                            </label>
                        </div>
                        <div id="filePreviewContainer" class="file-preview-container" style="margin-top: 20px; display: flex; flex-wrap: wrap; gap: 10px;"></div>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="font-bold">Add Location</label>
                    <input type="text" name="location" class="w-full rounded-lg" style="color: white; padding: 10px; background-color: #333333;">
                </div>

                <div class="space-y-2">
                    <label class="font-bold">Add categorie (separated by comma ",")</label>
                    <input type="text" name="categorie" class="w-full rounded-lg" style="color: white; padding: 10px; background-color: #333333;">
                </div>

                <div class="flex gap-4 items-center justify-end mt-6  mb-20">
                    <input type="reset" class="bg-black text-white font-bold py-2 px-4 rounded-full" value="Cancel">
                    <input type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded-full" value="Create Post">
                </div>
                <div class="mb-12"></div>
            </form>
        </div>
    </div>
</section>

<section class="bottom-bar fixed bottom-0 w-full">
    @include('assets.bottombar')
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileUploader = document.getElementById('fileUploader');
        const fileInput = document.getElementById('fileInput');
        const filePreviewContainer = document.getElementById('filePreviewContainer');
        const postForm = document.querySelector('form');

        fileUploader.addEventListener('dragover', (e) => {
            e.preventDefault();
            fileUploader.style.borderColor = '#555';
        });

        fileUploader.addEventListener('dragleave', () => {
            fileUploader.style.borderColor = '#ccc';
        });

        fileUploader.addEventListener('drop', (e) => {
            e.preventDefault();
            fileUploader.style.borderColor = '#ccc';
            handleFiles(e.dataTransfer.files);
        });

        fileInput.addEventListener('change', () => {
            handleFiles(fileInput.files);
        });

        postForm.addEventListener('reset', () => {
            filePreviewContainer.innerHTML = ''; // Clear previews on reset
            fileInput.value = ''; // Clear file input
        });

        function handleFiles(files) {
            filePreviewContainer.innerHTML = ''; // Clear previous previews
            Array.from(files).forEach(file => {
                if (file.type.startsWith('image/')) {
                    const fileElement = document.createElement('div');
                    fileElement.style.display = 'flex';
                    fileElement.style.flexDirection = 'column';
                    fileElement.style.alignItems = 'center';
                    fileElement.style.padding = '10px';
                    fileElement.style.border = '1px solid #ccc';
                    fileElement.style.borderRadius = '5px';

                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(file);
                    img.style.width = '100px';
                    img.style.height = '100px';
                    img.style.objectFit = 'cover';
                    img.onload = () => URL.revokeObjectURL(img.src);
                    fileElement.appendChild(img);

                    filePreviewContainer.appendChild(fileElement);
                }
            });

            const fileCount = document.createElement('p');
            fileCount.textContent = `${files.length} file(s) selected`;
            filePreviewContainer.appendChild(fileCount);
        }
    });
</script>