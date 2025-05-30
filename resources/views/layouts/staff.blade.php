<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Staff Panel</title>

    <!-- Tailwind via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Optional: Custom Loader CSS -->
    <style>
        #loader {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: #f1f8fa;
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
            border: 6px solid #d1e9f0;
            border-top: 6px solid #A0C3D2;
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
<body class="font-sans antialiased bg-[#f1f8fa] text-[#2c4d58]">

    <!-- 🔄 Loader -->
    <div id="loader">
        <div class="spinner"></div>
    </div>

    <!-- 🌟 Main Layout -->
    <div class="flex min-h-screen">
        @include('layouts.navigation-staff')

        <div class="flex-1 flex flex-col">
            @isset($header)
                <header class="bg-[#d1e9f0] shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 text-[#2c4d58] font-semibold">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="flex-1 p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- ✅ Toast Success -->
    @if (session('success'))
    <script>
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
    </script>
    @endif

    <!-- 🔁 Loader Script -->
    <script>
        window.addEventListener('load', () => {
            const loader = document.getElementById('loader');
            loader.classList.add('hide');
        });
    </script>

</body>
</html>
