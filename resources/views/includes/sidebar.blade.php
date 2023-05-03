<div x-cloak :class="{ 'w-72': sidebarOpen, 'w-0': !sidebarOpen }"
    class="
        fixed 
        top-0 
        bottom-0 
        start-0 
        z-30 
        w-72 
        h-full 
        min-h-screen 
        overflow-y-auto     
        border-e
        bg-white 
        dark:bg-gray-800 
        dark:border-gray-700 
        border-gray-100  
        dark:text-gray-400 
        text-gray-400 
        transition-all 
        duration-100 
        ease-in-out 
        shadow-lg 
        overflow-x-hidden
        ">


    <div class="flex flex-col items-stretch justify-between h-full">
        <div class="flex flex-col flex-1 w-full">
            <div class="flex items-center justify-center p-4 border-b dark:border-gray-700 border-gray-100 min-h-14">
                <h5 class="mb-0 font-semibold leading-normal" id="offcanvasExampleLabel">
                    {{ config('app.name', 'Laravel') }}
                </h5>
            </div>

            @if (auth()->user()->type == 'local')
                {{-- Sidebar Items --}}
                <div class="flex-1 overflow-y-auto">
                    @can('dashboard_menu')
                        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            <div class=" flex gap-2">
                                <x-svgs.dashboard></x-svgs.dashboard>
                                <div>{{ __('Dashboard') }}</div>
                            </div>
                        </x-responsive-nav-link>
                    @endcan

                    <x-custom-dropdown title="Settings">
                        <x-slot name="icon">
                            <x-svgs.gear></x-svgs.gear>
                        </x-slot>
                        <x-slot name="content"
                            contentClasses="{{ in_array(Route::current()->getName(), ['roles.index', 'permissions.index', 'users.index']) ? 'block' : 'hidden' }}">
                            @can('roles_menu')
                                <x-responsive-nav-link :href="route('roles.index')" :active="request()->routeIs('roles.index')">
                                    <div class=" flex gap-2">
                                        <x-svgs.user></x-svgs.user>
                                        <div>{{ __('Roles') }}</div>
                                    </div>
                                </x-responsive-nav-link>
                            @endcan
                            @can('permissions_menu')
                                <x-responsive-nav-link :href="route('permissions.index')" :active="request()->routeIs('permissions.index')">
                                    <div class=" flex gap-2">
                                        <x-svgs.lock></x-svgs.lock>
                                        <div>{{ __('Permissions') }}</div>
                                    </div>
                                </x-responsive-nav-link>
                            @endcan
                            @can('users_menu')
                                <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')">
                                    <div class=" flex gap-2">
                                        <x-svgs.users></x-svgs.users>
                                        <div>{{ __('Users') }}</div>
                                    </div>
                                </x-responsive-nav-link>
                            @endcan
                            @can('clients_menu')
                                <x-responsive-nav-link :href="route('clients.index')" :active="request()->routeIs('clients.index')">
                                    <div class=" flex gap-2">
                                        <x-svgs.users></x-svgs.users>
                                        <div>{{ __('Clients') }}</div>
                                    </div>
                                </x-responsive-nav-link>
                            @endcan
                        </x-slot>
                    </x-custom-dropdown>
                    @can('requirements_menu')
                        <x-responsive-nav-link :href="route('requirements.index')" :active="request()->routeIs('requirements.index')">
                            <div class=" flex gap-2">
                                <x-svgs.users></x-svgs.users>
                                <div>{{ __('Requirements') }}</div>
                            </div>
                        </x-responsive-nav-link>
                    @endcan

                    {{-- TODO: Add if condition here to view this only for clients --}}
                    {{-- <x-responsive-nav-link :href="route('client_page.index')" :active="request()->routeIs('client_page.index')">
                        <div class=" flex gap-2">
                            <x-svgs.users></x-svgs.users>
                            <div>{{ __('Client Page') }}</div>
                        </div>
                    </x-responsive-nav-link> --}}



                </div>
            @endif

        </div>
        <!-- User Section -->
        <div class=" pb-1 border-t dark:border-gray-700 border-gray-100">
            <div class="p-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}
                </div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                <div class=" flex gap-2">
                    <x-svgs.user></x-svgs.user>
                    <div>{{ __('Profile') }}</div>
                </div>
            </x-responsive-nav-link>

            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')"
                    onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    <div class=" flex gap-2">
                        <x-svgs.logout></x-svgs.logout>
                        <div>{{ __('Log Out') }}</div>
                    </div>
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
</div>
