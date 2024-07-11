<!-- resources/views/layouts/header.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Document')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        /* Always dark mode styles */
        .bg-black {
            --tw-bg-opacity: 1;
            background-color: rgba(0, 0, 0, var(--tw-bg-opacity));
        }

        .text-white {
            --tw-text-opacity: 1;
            color: rgba(255, 255, 255, var(--tw-text-opacity));
        }

        .bg-indigo-600 {
            --tw-bg-opacity: 1;
            background-color: rgba(99, 102, 241, var(--tw-bg-opacity));
        }

        .hover\:bg-indigo-700:hover {
            --tw-bg-opacity: 1;
            background-color: rgba(62, 68, 153, var(--tw-bg-opacity));
        }

        .text-black {
            color: #000;
        }

        /* Adjusted input size */
        .py-3 {
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
        }

        /* Increase vertical padding */
        .px-4 {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        /* Increase horizontal padding */
        .content-container {
            margin-left: 280px;
            /* Adjust according to the width of your navbar */
        }

        @media (max-width: 724px) {
            .content-container {
                margin-left: 0;
            }
        }

        .w-70 {
            width: 70%;
        }

        .w-30 {
            width: 30%;
        }

        @media (max-width: 1024px) and (orientation: landscape) {
            .home-creators {
                display: none;
            }
        }

        .py-4 {
            padding-top: 1rem;
            /* Adjust as needed */
            padding-bottom: 1rem;
            /* Adjust as needed */
        }

        .h3-bold {
            font-weight: bold;
        }

        .bottom-bar {
            margin-top: auto;
            background-color: black;
            display: flex;
            justify-content: space-around;
            margin-bottom: 4px;
            /* Remove bottom margin */
            position: fixed;
            bottom: 0;
            width: 100%;
            margin-bottom: 0;
        }

        .bottom-bar a {
            text-decoration: none;
            color: white;
            text-align: center;
            padding: 10px;
            margin: 5px;
        }

        .bottom-bar img {
            width: 24px;
            height: 24px;
        }

        .bottom-bar p {
            font-size: 10px;
            margin-top: 5px;
        }

        .bottom-bar a:not(:last-child) {
            margin-right: 16px;
            /* Add margin between <a> tags */
        }

        @media (min-width: 821px) {
            .bottom-bar {
                display: none;
            }
        }

        /* Hover effect for list items */
        .leftsidebar-link {
            transition: transform 0.3s ease;
            height: 60px;
        }

        .leftsidebar-link:hover {
            background-color: #877EFF;
            /* Change to desired color */
            border-radius: 8px;
            /* Add round corners */
            transform: scale(1);
            /* Larger hover effect */
        }

        /* Hover effect for list item links */
        .leftsidebar-link:hover a {
            color: #fff;
            /* Change to desired color */
        }

        /* Hover effect for list item images */
        .leftsidebar-link:hover img {
            filter: brightness(0) invert(1);
            /* Change the image color to white */
        }

        /* Adjusted navbar position */
        .leftsidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            width: 280px;
            /* Adjust width as needed */
        }

        .flex.flex-col.gap-6 {
            width: 230px;
            /* Set the desired width */
            gap: 16px;
            /* Set the desired gap value */
        }

        /* Media query to hide sidebar on smaller screens */
        @media (max-width: 770px) {
            .leftsidebar {
                display: none;
            }
        }

        .post {
            position: relative;
            background-color: black;
            border-radius: 0.5rem;
            /* Rounded corners */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Gray shadow */
        }

        .post .top-line {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background-color: #5a67d8;
            /* Change this color as needed */
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
        }

        #loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 9999;
            transition: opacity 0.3s ease;
        }
    </style>
</head>

<body class="bg-black text-white py-0">
    <div id="loading-screen" class="fixed inset-0 flex items-center justify-center w-full h-[100vh] text-white-900 text-gray-100 bg-gray-950 z-50" style="display: none;">
        <div>
            <h1 class="text-xl md:text-7xl font-bold flex items-center">L
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" class="animate-spin" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2ZM13.6695 15.9999H10.3295L8.95053 17.8969L9.5044 19.6031C10.2897 19.8607 11.1286 20 12 20C12.8714 20 13.7103 19.8607 14.4956 19.6031L15.0485 17.8969L13.6695 15.9999ZM5.29354 10.8719L4.00222 11.8095L4 12C4 13.7297 4.54894 15.3312 5.4821 16.6397L7.39254 16.6399L8.71453 14.8199L7.68654 11.6499L5.29354 10.8719ZM18.7055 10.8719L16.3125 11.6499L15.2845 14.8199L16.6065 16.6399L18.5179 16.6397C19.4511 15.3312 20 13.7297 20 12L19.997 11.81L18.7055 10.8719ZM12 9.536L9.656 11.238L10.552 14H13.447L14.343 11.238L12 9.536ZM14.2914 4.33299L12.9995 5.27293V7.78993L15.6935 9.74693L17.9325 9.01993L18.4867 7.3168C17.467 5.90685 15.9988 4.84254 14.2914 4.33299ZM9.70757 4.33329C8.00021 4.84307 6.53216 5.90762 5.51261 7.31778L6.06653 9.01993L8.30554 9.74693L10.9995 7.78993V5.27293L9.70757 4.33329Z"></path>
                </svg> ading . . .
            </h1>
        </div>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var loadingScreen = document.getElementById('loading-screen');

            function showLoadingScreen() {
                loadingScreen.style.display = 'flex';
                setTimeout(function() {
                    loadingScreen.style.opacity = '1';
                }, 10);
            }

            function hideLoadingScreen() {
                loadingScreen.style.opacity = '0';
                setTimeout(function() {
                    loadingScreen.style.display = 'none';
                }, 300);
            }

            showLoadingScreen();

            window.addEventListener('load', function() {
                hideLoadingScreen();
            });

            // Optional: Show loading screen on AJAX start and hide on AJAX complete
            document.addEventListener('ajaxStart', function() {
                showLoadingScreen();
            });

            document.addEventListener('ajaxComplete', function() {
                hideLoadingScreen();
            });
        });
    </script>