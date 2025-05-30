<div x-data="{ open: true }" class="flex min-h-screen">
  <!-- Sidebar -->
  <div :class="open ? 'w-64' : 'w-20'" class="bg-gradient-to-b from-[#A9746E] to-[#7C4A27] text-white flex flex-col shadow-lg transition-all duration-300 ease-in-out">

    <!-- Toggle Button -->
    <div class="flex items-center justify-between p-4 border-b border-[#6B3E20]">
      <span x-show="open" class="font-bold text-lg">Menu</span>
      <button @click="open = !open" class="text-white focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" :class="open ? '' : 'rotate-180'" class="h-5 w-5 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
      </button>
    </div>

    <!-- User info -->
    <div class="p-4 border-b border-[#6B3E20] flex items-center gap-4">
      <img src="{{ auth()->user()->profile_photo_url ?? 'https://via.placeholder.com/40' }}" alt="Avatar" class="w-10 h-10 rounded-full object-cover shadow-md" />
      <div x-show="open" class="overflow-hidden">
        <p class="font-extrabold text-sm tracking-wide truncate">{{ auth()->user()->name ?? 'Super Admin' }}</p>
        <p class="text-xs text-[#D2B48C] truncate">{{ auth()->user()->email ?? 'admin@example.com' }}</p>
      </div>
    </div>

    <!-- Nav -->
    <nav class="flex-1 px-2 py-6 space-y-4 overflow-y-auto scrollbar-thin scrollbar-thumb-[#7C4A27] scrollbar-track-transparent">
      <a href="{{ route('superadmin.dashboard') }}"
         class="relative flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-[#8B5E3C] hover:shadow-md transition-colors duration-300
         {{ request()->routeIs('superadmin.dashboard') ? 'bg-[#6B3E20] shadow-lg font-semibold' : 'font-medium' }}">
         @if(request()->routeIs('superadmin.dashboard'))
         <span class="absolute left-0 top-0 h-full w-1 bg-yellow-400 rounded-r-lg animate-pulse"></span>
         @endif
         <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6"/>
         </svg>
         <span x-show="open" class="truncate">Dashboard</span>
      </a>

      <a href="{{ route('pending.users') }}"
         class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-[#8B5E3C] hover:shadow-md transition-colors duration-300
         {{ request()->routeIs('pending.users') ? 'bg-[#6B3E20] shadow-lg font-semibold' : 'font-medium' }}">
         <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
         </svg>
         <span x-show="open" class="truncate">Pending Users</span>
      </a>

      <hr class="border-[#6B3E20]" x-show="open" />

      <a href="{{ route('profile.edit') }}"
         class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-[#8B5E3C] hover:shadow-md transition-colors duration-300 font-medium">
         <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.2 0 4.27.57 6.004 1.57M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
         </svg>
         <span x-show="open" class="truncate">Profile</span>
      </a>

      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"
            class="w-full flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-[#8B5E3C] hover:shadow-md transition-colors duration-300 font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7"/>
            </svg>
            <span x-show="open" class="truncate">Log Out</span>
        </button>
      </form>
    </nav>

    <footer class="p-4 text-xs text-[#D2B48C] border-t border-[#6B3E20] text-center select-none">
      <span x-show="open">&copy; {{ date('Y') }} EBRMs. All rights reserved.</span>
    </footer>
  </div>

  <!-- Main content -->
  <div class="flex-1 bg-gray-100 p-6">
    <!-- Your page content goes here -->
  </div>
</div>

<!-- Add Alpine.js if not included already -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
