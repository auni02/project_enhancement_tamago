<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Super Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Simple fade-out animation for loader */
        #loader {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: #F5F1EC; /* soft cream/brownish white */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease;
        }
        #loader.hide {
            opacity: 0;
            visibility: hidden;
        }

        /* Spinner style */
        .spinner {
            border: 6px solid #D7C4A3; /* light brown */
            border-top: 6px solid #8B5E3C; /* dark brown */
            border-radius: 50%;
            width: 48px;
            height: 48px;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg);}
            100% { transform: rotate(360deg);}
        }
    </style>
</head>
<body class="font-sans antialiased bg-[#F5F1EC] text-[#8B5E3C]">
    <!-- Loading Screen -->
    <div id="loader">
        <div class="spinner"></div>
    </div>

    <div class="flex min-h-screen">
        @include('layouts.navigation-superadmin')

        <div class="flex-1 flex flex-col">
            @isset($header)
                <header class="bg-[#D7C4A3] shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 text-[#4B342F] font-semibold">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="flex-1 p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        // Hide loader after page loads smoothly
        window.addEventListener('load', () => {
            const loader = document.getElementById('loader');
            loader.classList.add('hide');
        });
    </script>
</body>
</html>
