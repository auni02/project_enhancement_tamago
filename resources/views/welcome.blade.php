<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EBRMs - Risk Management System</title>
  <link href="https://fonts.bunny.net/css?family=inter:400,500,700" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    html { scroll-behavior: smooth; }
  </style>
</head>
<body class="bg-white text-gray-800 font-inter">

  <!-- Header -->
  <header class="bg-white shadow sticky top-0 z-50">
    <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-4">
      <h1 class="text-2xl font-bold text-indigo-600">EBRMs</h1>
      <nav class="space-x-6 text-sm font-medium">
        <a href="#features" class="hover:text-indigo-600">Features</a>
        <a href="#how-it-works" class="hover:text-indigo-600">How It Works</a>
        <a href="#testimonials" class="hover:text-indigo-600">Testimonials</a>
        <a href="#contact" class="hover:text-indigo-600">Contact</a>
        <a href="/login" class="text-indigo-600 font-semibold hover:underline">Login</a>
      </nav>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="bg-gradient-to-br from-indigo-600 to-purple-600 text-white min-h-screen flex items-center justify-center text-center px-6">
    <div>
      <h2 class="text-4xl font-bold mb-4">Event-Based Risk Management</h2>
      <p class="text-lg mb-6 max-w-2xl mx-auto">
        Empower your organization to log, assess, and mitigate risks in real-time with our intuitive and secure system.
      </p>
      <a href="#features" class="bg-white text-indigo-700 font-semibold px-6 py-3 rounded shadow hover:bg-gray-100 transition">Learn More</a>
    </div>
  </section>

  <!-- Features -->
  <section id="features" class="py-20 bg-gray-50">
    <div class="max-w-6xl mx-auto px-6 text-center">
      <h3 class="text-3xl font-bold mb-12">Key Features</h3>
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-10 text-left">
        <div class="bg-white p-6 rounded shadow">
          <svg class="w-8 h-8 text-indigo-600 mb-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M3 10h18M9 16h6M12 3v18" />
          </svg>
          <h4 class="font-semibold text-lg mb-2">Risk Logging</h4>
          <p>Staff can log risk events instantly with date, category, and description fields.</p>
        </div>
        <div class="bg-white p-6 rounded shadow">
          <svg class="w-8 h-8 text-indigo-600 mb-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M5 13l4 4L19 7" />
          </svg>
          <h4 class="font-semibold text-lg mb-2">Admin Evaluation</h4>
          <p>Admins can score and assign risk treatments with ease and transparency.</p>
        </div>
        <div class="bg-white p-6 rounded shadow">
          <svg class="w-8 h-8 text-indigo-600 mb-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M12 8c-1.1 0-2 .9-2 2v6h4v-6c0-1.1-.9-2-2-2zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z" />
          </svg>
          <h4 class="font-semibold text-lg mb-2">Secure Access</h4>
          <p>MFA, hashed passwords, and role-based access control for all users.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- How It Works -->
  <section id="how-it-works" class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-6">
      <h3 class="text-3xl font-bold mb-12 text-center">How It Works</h3>
      <div class="grid md:grid-cols-2 gap-10 items-center">
        <div>
          <h4 class="text-xl font-semibold mb-4">For Staff</h4>
          <p class="mb-4">Log risks via a simple form. Track past reports, and update assigned mitigation tasks.</p>
          <h4 class="text-xl font-semibold mb-4">For Admins</h4>
          <p>Evaluate, assign mitigation steps, and approve resolutions. View all risk activity by company.</p>
        </div>
        <img src="https://placehold.co/500x300?text=EBRM+Dashboard" alt="dashboard mockup" class="rounded shadow" />
      </div>
    </div>
  </section>

  <!-- Testimonials -->
  <section id="testimonials" class="py-20 bg-indigo-50">
    <div class="max-w-6xl mx-auto px-6 text-center">
      <h3 class="text-3xl font-bold mb-12">What Our Users Say</h3>
      <div class="grid sm:grid-cols-3 gap-6">
        <blockquote class="bg-white p-6 rounded shadow">
          “This tool has made risk logging effortless for our staff.”
          <footer class="mt-2 text-sm text-gray-500">– Afiqah, Risk Officer</footer>
        </blockquote>
        <blockquote class="bg-white p-6 rounded shadow">
          “Real-time tracking and scoring help us make faster decisions.”
          <footer class="mt-2 text-sm text-gray-500">– Johan, Admin</footer>
        </blockquote>
        <blockquote class="bg-white p-6 rounded shadow">
          “Security features are top-notch. Highly recommend EBRMs!”
          <footer class="mt-2 text-sm text-gray-500">– Nurul, IT Lead</footer>
        </blockquote>
      </div>
    </div>
  </section>

  <!-- Contact -->
  <section id="contact" class="py-20 bg-white text-center">
    <h3 class="text-3xl font-bold mb-4">Get in Touch</h3>
    <p class="text-gray-600 mb-6">We’re here to answer your questions and help you get started.</p>
    <p><strong>Email:</strong> support@ebrm.com</p>
    <p><strong>Phone:</strong> +60 12-345 6789</p>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-100 text-center py-6 text-sm text-gray-600">
    &copy; {{ date('Y') }} EBRMs. All rights reserved.
  </footer>
</body>
</html>
