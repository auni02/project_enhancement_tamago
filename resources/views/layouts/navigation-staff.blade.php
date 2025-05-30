<div x-data="{ open: true }" class="flex min-h-screen">
  <div :class="open ? 'w-64' : 'w-20'" class="bg-[#2563EB] text-white flex flex-col shadow-lg transition-all duration-300 ease-in-out">

    <div class="flex items-center justify-between p-4 border-b border-white/20">
      <span x-show="open" class="font-bold text-lg">Menu</span>
      <button @click="open = !open" class="text-white focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" :class="open ? '' : 'rotate-180'" class="h-5 w-5 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
      </button>
    </div>

    <div class="p-4 border-b border-white/20 flex items-center gap-4">
      <img src="{{ auth()->user()->profile_photo_url ?? 'https://via.placeholder.com/40' }}" alt="Avatar" class="w-10 h-10 rounded-full object-cover shadow-md" />
      <div x-show="open" class="overflow-hidden">
        <p class="font-extrabold text-sm tracking-wide truncate">{{ auth()->user()->name ?? 'Staff' }}</p>
        <p class="text-xs text-white/80 truncate">{{ auth()->user()->email ?? 'staff@example.com' }}</p>
      </div>
    </div>

    <nav class="flex-1 px-2 py-6 space-y-4 overflow-y-auto scrollbar-thin scrollbar-thumb-white/30 scrollbar-track-transparent">
      <a href="{{ route('staff.dashboard') }}"
         class="no-underline text-white relative flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-white/20 hover:shadow-md transition-colors duration-300
         {{ request()->routeIs('staff.dashboard') ? 'bg-white/30 shadow-lg font-semibold' : 'font-medium' }}">
         @if(request()->routeIs('staff.dashboard'))
         <span class="absolute left-0 top-0 h-full w-1 bg-yellow-400 rounded-r-lg animate-pulse"></span>
         @endif
         <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6"/>
         </svg>
         <span x-show="open" class="truncate">Dashboard</span>
      </a>

      <a href="{{ route('staff.logrisk') }}"
         class="no-underline text-white flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-white/20 hover:shadow-md transition-colors duration-300
         {{ request()->routeIs('staff.logrisk') ? 'bg-white/30 shadow-lg font-semibold' : 'font-medium' }}">
         <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6a4 4 0 014-4h4" />
         </svg>
         <span x-show="open" class="truncate">Log Risk</span>
      </a>

      <a href="{{ route('staff.risks.my_history') }}"
         class="no-underline text-white flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-white/20 hover:shadow-md transition-colors duration-300
         {{ request()->routeIs('staff.risks.my_history') ? 'bg-white/30 shadow-lg font-semibold' : 'font-medium' }}">
         <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
         </svg>
         <span x-show="open" class="truncate">History Log Risk</span>
      </a>

      <a href="{{ route('staff.tasks.my_task') }}"
         class="no-underline text-white flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-white/20 hover:shadow-md transition-colors duration-300
         {{ request()->routeIs('staff.tasks.my_task') ? 'bg-white/30 shadow-lg font-semibold' : 'font-medium' }}">
         <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
         </svg>
         <span x-show="open" class="truncate">List of Tasks</span>
      </a>

      <a href="{{ route('profile.edit') }}"
         class="no-underline text-white flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-white/20 hover:shadow-md transition-colors duration-300 font-medium">
         <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.2 0 4.27.57 6.004 1.57M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
         </svg>
         <span x-show="open" class="truncate">Profile</span>
      </a>

      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"
            class="w-full flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-white/20 hover:shadow-md transition-colors duration-300 font-medium text-white no-underline">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7"/>
            </svg>
            <span x-show="open" class="truncate">Log Out</span>
        </button>
      </form>
    </nav>

    <footer class="p-4 text-xs text-white/80 border-t border-white/20 text-center select-none">
      <span x-show="open">&copy; {{ date('Y') }} EBRMs. All rights reserved.</span>
    </footer>
  </div>

  <div class="flex-1 bg-gray-100 p-6">
    <!-- Staff page content here -->
  </div>
</div>

<!-- Alpine.js CDN -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
