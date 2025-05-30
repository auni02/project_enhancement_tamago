<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <title>{{ config('app.name', 'EBRMs') }} - Login</title>

  <link href="https://fonts.bunny.net/css?family=inter:400,500,700" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    html { scroll-behavior: smooth; }
  </style>
</head>
<body class="min-h-screen bg-gradient-to-tr from-indigo-900 via-indigo-800 to-purple-800 font-inter flex items-center justify-center px-4 py-12">

  <div class="max-w-7xl w-full flex flex-col md:flex-row items-center md:justify-between gap-12">

    <!-- Left: Welcome Message -->
    <div class="md:w-1/2 text-white space-y-6 max-w-lg">
      <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">
        Welcome to <span class="text-purple-300">EBRMs</span>
      </h1>
      <p class="text-lg text-indigo-200">
        You are now in the <strong>login page</strong>. Please log in to continue managing risks efficiently and securely.
      </p>
      <p class="text-indigo-300 text-sm">
        Don't have an account?
        <a href="{{ route('register') }}" class="underline hover:text-purple-200 font-medium">Register here</a>.
      </p>
    </div>

    <!-- Right: Login Form Box -->
    <div class="md:w-1/2 w-full max-w-md bg-white rounded-3xl shadow-2xl px-8 py-10">

      <!-- Logo -->
      <div class="flex justify-center mb-8">
        <a href="/">
          <x-application-logo class="w-20 h-20 text-indigo-700" />
        </a>
      </div>

      <!-- Form Slot -->
      <div class="space-y-6 text-gray-800">
        {{ $slot }}
      </div>

    </div>

  </div>

</body>
</html>
