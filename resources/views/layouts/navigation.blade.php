<div x-data="{ open: false }" class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md hidden sm:block">
        <div class="h-16 flex items-center justify-center border-b">
            <a href="{{ route('dashboard') }}">
                <x-application-logo class="h-10 w-auto text-indigo-600" />
            </a>
        </div>

        <nav class="mt-4">
            @php $role = Auth::user()->role; @endphp

            @if ($role === 'super-admin')
                <x-nav-link :href="route('superadmin.dashboard')" :active="request()->routeIs('superadmin.dashboard')" class="block px-6 py-3 hover:bg-gray-100">
                    🛠 Super Admin Panel
                </x-nav-link>
                <x-nav-link :href="route('pending.users')" :active="request()->routeIs('pending.users')" class="block px-6 py-3 hover:bg-gray-100">
                    ⏳ Pending Users
                </x-nav-link>
            @elseif ($role === 'admin')
                <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="block px-6 py-3 hover:bg-gray-100">
                    ⚙️ Admin Panel
                </x-nav-link>
            @elseif ($role === 'staff')
                <x-nav-link :href="route('staff.dashboard')" :active="request()->routeIs('staff.dashboard')" class="block px-6 py-3 hover:bg-gray-100">
                    👷 Staff Panel
                </x-nav-link>
            @endif

            <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')" class="block px-6 py-3 hover:bg-gray-100">
                👤 Profile
            </x-nav-link>

            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <x-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="block px-6 py-3 hover:bg-gray-100">
                    🚪 Log Out
                </x-nav-link>
            </form>
        </nav>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Optional: Top Bar on mobile -->
        <header class="bg-white shadow px-4 py-3 flex items-center justify-between sm:hidden">
            <button @click="open = !open" class="text-gray-600 focus:outline-none">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path :class="{ 'hidden': open, 'inline-flex': !open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <span>{{ Auth::user()->name }}</span>
        </header>

        <!-- Mobile Sidebar Dropdown -->
        <div x-show="open" class="sm:hidden bg-white w-full shadow-md p-4 space-y-2">
            @if ($role === 'super-admin')
                <x-responsive-nav-link :href="route('superadmin.dashboard')" :active="request()->routeIs('superadmin.dashboard')">
                    Super Admin Panel
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('pending.users')" :active="request()->routeIs('pending.users')">
                    Pending Users
                </x-responsive-nav-link>
            @elseif ($role === 'admin')
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    Admin Panel
                </x-responsive-nav-link>
            @elseif ($role === 'staff')
                <x-responsive-nav-link :href="route('staff.dashboard')" :active="request()->routeIs('staff.dashboard')">
                    Staff Panel
                </x-responsive-nav-link>
            @endif

            <x-responsive-nav-link :href="route('profile.edit')">
                Profile
            </x-responsive-nav-link>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                    Log Out
                </x-responsive-nav-link>
            </form>
        </div>

        <!-- Actual Content Goes Here -->
        <main class="flex-1 overflow-y-auto p-6">
            {{ $slot ?? '' }}
        </main>
    </div>
</div>
