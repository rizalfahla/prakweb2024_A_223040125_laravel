<header class="antialiased fixed w-full z-50">
    <nav class="bg-gray-900 border-gray-800 px-4 lg:px-6 py-2.5 w-full">
        <div class="flex flex-wrap items-center justify-center">
            <div class="flex items-center w-full">                    
                <!-- Logo -->
                <a href="#" class="flex mr-4">
                    <span class="self-center text-2xl font-semibold text-gray-100">Gedang</span>
                </a>
                
                <!-- Search Form -->
                <form action="#" method="GET" class="hidden lg:block mx-auto">
                    @csrf
                    <label for="topbar-search" class="sr-only">Search</label>
                    <div class="relative mt-1 lg:w-96">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="text" name="email" id="topbar-search" class="bg-gray-800 border border-gray-700 text-gray-100 sm:text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full pl-9 p-2.5 placeholder-gray-500" placeholder="Search...">
                    </div>
                </form>

                <!-- Logout Button -->
                <div class="ml-4">
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-gray-100 bg-gray-700 hover:bg-gray-600 rounded-lg border border-gray-600 focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">
                            Log out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</header>
