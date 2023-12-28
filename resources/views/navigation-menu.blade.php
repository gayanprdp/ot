<nav  x-data="{ open: false }" class="hidden-print bg-sky-700 border-b border-sky-300 print:hidden">
    <!-- Primary Navigation Menu -->
    
    

      
    <div class="max-w mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('OT.dashboard') }}">
                        <strong class="text-white">Over Time</strong> <p class="text-sm text-sky-200">Records Management System</p>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex text-white">
                    <x-jet-nav-link class="text-white hover:text-sky-300" href="{{ route('OT.dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-jet-nav-link>
                </div>

                <!--
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('post.index') }}" :active="request()->routeIs('post.index')">
                        {{ __('test') }}
                    </x-jet-nav-link>
                </div>
                

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @if (Auth::user()->user_level=='1')
                    <x-jet-nav-link href="{{ route('manage.user') }}" :active="request()->routeIs('manage.user')">
                        {{ __('Manage User') }}
                    </x-jet-nav-link>
                    @endif
                </div>
-->

                <!--
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    
                    <x-jet-nav-link href="{{ route('manage.employee', ['param' =>  Auth::user()->institute ]) }}" :active="request()->routeIs('manage.employee')">
                        {{ __('Manage Employees') }}
                    </x-jet-nav-link>
                    
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    
                    <x-jet-nav-link href="{{ route('manage.institute') }}" :active="request()->routeIs('manage.institute')">
                        {{ __('Manage Institute') }}
                    </x-jet-nav-link>
                    
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    
                    <x-jet-nav-link href="{{ route('manage.designation') }}" :active="request()->routeIs('manage.designation')">
                        {{ __('Manage Designation') }}
                    </x-jet-nav-link>
                    
                </div>
                
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    
                    <x-jet-nav-link href="{{ route('ot.list', ['param' =>  Auth::user()->institute ]) }}" :active="request()->routeIs('ot.list')">
                        {{ __('OT List') }}

                    </x-jet-nav-link>
                    
                </div>

                -->


               


            </div>


            <div class="hidden sm:flex sm:items-center sm:ml-6">
                
                <!-- Teams Dropdown -->
                
                    <div class="ml-3 relative">
                        <x-jet-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <div class="static">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-semibold rounded-md text-gray-100 bg-sky-700 hover:bg-sky-700 hover:text-gray-400 focus:outline-none focus:bg-sky-700 active:bg-sky-700 transition">
                                        
                                        OT Sheets  &nbsp;

                                       


                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>

                                    </button>
                                       
                                        @if ((Auth::user()->user_level == 12) && (Session::get('notification')==0)&& ($nitifi != 0))
                                        <div class="bg-red-500 rounded-lg px-2 py-1 text-neutral-50 text-center absolute top-4 right-6 ">                                    
                                            
                                            
                                                                                                                                 
                                        </div>
                                        @endif 
                                    </div>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <!-- Team Switcher -->
                                    <div class="block px-4 py-2 text-xs text-gray-300">
                                        {{ __('OT Sheets') }}
                                    </div>
                                    

                                    <!-- Team Settings -->
                                    <x-jet-dropdown-link href="{{ route('ot.list', ['param' =>  Auth::user()->institute ]) }}">
                                        {{ __('Manage OT Sheets') }}
                                       
                                        @if ((Auth::user()->user_level == 12) && (Session::get('notification')==0) && ($nitifi != 0))                                        
                                        <div class="bg-red-500 rounded-lg px-2 py-1 text-neutral-50 text-center absolute opacity-75 hover:opacity-100 top-9 right-20 ">                                    
                                            
                                          
                                                                                                                                 
                                        </div>
                                        @endif 

                                        
                                    </x-jet-dropdown-link>

                                    <!--<x-jet-dropdown-link href="{{ route('ot.list.completed', ['param' =>  Auth::user()->institute ]) }}">
                                        {{ __('Processed OT Sheets') }}
                                    </x-jet-dropdown-link>-->

                                    <x-jet-dropdown-link href="{{ route('ot.list.status', ['param' =>  Auth::user()->institute ,'param2' =>  'I'] ) }}">
                                        {{ __('OT Sheets Status') }}
                                    </x-jet-dropdown-link>

                                   

                                   

                                    

                                    <div class="border-t border-gray-100"></div>

                                    

                                    
                                </div>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>


            

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                
                <!-- Teams Dropdown -->
                
                    <div class="ml-3 relative">
                        <x-jet-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-semibold rounded-md text-gray-100 bg-sky-700 hover:bg-sky-700 hover:text-gray-400 focus:outline-none focus:bg-sky-700 active:bg-sky-700 transition">
                                        
                                        Manage
                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>

                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <!-- Team Switcher -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Settings') }}
                                    </div>
                                    

                                    <!-- Team Settings -->
                                    <x-jet-dropdown-link href="{{ route('manage.designation') }}">
                                        {{ __('Manage Designations') }}
                                    </x-jet-dropdown-link>

                                    @if (Auth::user()->user_level=='1')
                                        <x-jet-dropdown-link href="{{ route('manage.institute') }}">
                                            {{ __('Manage Institutes') }}
                                        </x-jet-dropdown-link>

                                       
                                    @endif

                                    <x-jet-dropdown-link href="{{ route('manage.employee', ['param' =>  Auth::user()->institute ]) }}">
                                        {{ __('Manage Employees') }}
                                    </x-jet-dropdown-link>


                                    @if (Auth::user()->user_level=='1')
                                    <x-jet-dropdown-link href="{{ route('manage.user') }}" >
                                        {{ __('Manage User Accounts') }}
                                    </x-jet-dropdown-link>
                                    @endif

                                    

                                    <div class="border-t border-gray-100"></div>

                                    

                                    
                                </div>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                
                    
                

                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-semibold rounded-md text-gray-100 bg-sky-700 hover:bg-sky-700 hover:text-gray-400 focus:outline-none focus:bg-sky-700 active:bg-sky-700 transition">
                                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-semibold rounded-md text-gray-100 bg-sky-700 hover:bg-sky-700 hover:text-gray-400 focus:outline-none focus:bg-sky-700 active:bg-sky-700 transition">
                                        {{ Auth::user()->name }}

                                        @foreach (\App\Models\user_designations::where('id', '=',Auth::user()->designation_id)->get() as $data)
                                        ({{$data->designation}})
                                        @endforeach  

                                        
                            

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            
                                <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}                                
                                </x-jet-dropdown-link>
                            

                                @if (Auth::user()->user_level=='1')
                                <x-jet-dropdown-link href="{{ route('manage.user') }}">
                                {{ __('Manage Users') }}                                
                                </x-jet-dropdown-link>
                                @endif
                            
                            

                            

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-jet-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}"
                                         @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-jet-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="shrink-0 mr-3">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-jet-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-jet-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                   @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-jet-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-jet-responsive-nav-link>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-jet-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                            {{ __('Create New Team') }}
                        </x-jet-responsive-nav-link>
                    @endcan

                    <div class="border-t border-gray-200"></div>

                    <!-- Team Switcher -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Switch Teams') }}
                    </div>

                    @foreach (Auth::user()->allTeams() as $team)
                        <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    

    <div class="bg-sky-700  text-neutral-50 text-center  fixed bottom-0 w-full left-0"> 
        <div class="text-xs p-1">Designed and Developed by National Information and Communication Center (NAICC) - Department of Agriculture</div>
    </div>
</nav>



