<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Admin Panel</title>

    <!-- Tailwind via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- ✅ Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


    <style>
        #loader {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: #e9f5ec;
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

        .spinner {
            border: 6px solid #c9e7d6;
            border-top: 6px solid #256d46;
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
<body class="font-sans antialiased bg-[#e9f5ec] text-[#256d46]">
    <!-- Loading Screen -->
    <div id="loader">
        <div class="spinner"></div>
    </div>

    <div class="flex min-h-screen">
        @include('layouts.navigation-admin')

        <div class="flex-1 flex flex-col">
            @isset($header)
                <header class="bg-[#c9e7d6] shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 text-[#16492e] font-semibold">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="flex-1 p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- ✅ Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        window.addEventListener('load', () => {
            const loader = document.getElementById('loader');
            loader.classList.add('hide');
        });
    </script>
</body>
</html>
