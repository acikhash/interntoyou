<!doctype html>

<title>intern To You</title>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

<body style="font-family: Open Sans, sans-serif">
    <section class="px-6 py-8">
        <nav class="md:flex md:justify-between md:items-center">
            <div>
                <a href="/">
                    <img src="./images/logo.svg" alt="intern To You Logo" width="165" height="16">
                </a>
            </div>

            <div class="mt-8 md:mt-0">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                            in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </nav>

        <header class="max-w-xl mx-auto mt-20 text-center">
            <h1 class="text-4xl">
                Latest <span class="text-blue-500">Job Post</span>
            </h1>
            <p class="text-sm mt-14">
            <h2> Find your dream job from a famous and renowned company near you </h2>
            </p>

            <div class="space-y-2 lg:space-y-0 lg:space-x-4 mt-8">
                <form method="GET" action="#">
                    <!--  Filters by Company -->
                    <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl">
                        <x-input-label for="company" :value="__('Filter By Company')" />
                        <select class="flex-1 appearance-none bg-transparent py-2 pl-3 pr-9 text-sm font-semibold"
                            name="company">
                            <option value="-" selected>ALL
                            </option>
                            @foreach ($companies as $comp)
                                <option value={{ $comp->id }}>{{ $comp->name }}</option>
                            @endforeach
                        </select>
                        <svg class="transform -rotate-90 absolute pointer-events-none" style="right: 12px;"
                            width="22" height="22" viewBox="0 0 22 22">
                            <g fill="none" fill-rule="evenodd">
                                <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                                </path>
                                <path fill="#222"
                                    d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z"></path>
                            </g>
                        </svg>
                    </div>

                    <!-- Filters by Field-->
                    <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl">
                        <x-input-label for="jobfield" :value="__('Filter By Job Field')" />
                        <select class="flex-1 appearance-none bg-transparent py-2 pl-3 pr-9 text-sm font-semibold"
                            name="jobfield">
                            <option value="-" selected>ALL
                            </option>
                            @foreach ($jobfields as $field)
                                <option value={{ $field->id }}>
                                    {{ $field->description }}
                                </option>
                            @endforeach
                        </select>
                        <svg class="transform -rotate-90 absolute pointer-events-none" style="right: 12px;"
                            width="22" height="22" viewBox="0 0 22 22">
                            <g fill="none" fill-rule="evenodd">
                                <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                                </path>
                                <path fill="#222"
                                    d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z"></path>
                            </g>
                        </svg>
                    </div>

                    <!-- Search -->
                    <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl px-3 py-2">
                        <input type="text" name="search" placeholder="Find something" value="{{ old('search') }}"
                            class="bg-transparent placeholder-black font-semibold text-sm">
                        <x-primary-button>Search</x-primary-button>
                </form>
            </div>
        </header>

        <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">


            <div class="lg:grid lg:grid-cols-3">
                @foreach ($jobpost as $post)
                    <article
                        class="transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl">
                        <div class="py-6 px-5">
                            <div>
                                <img src={{ $post->office }} alt="Blog Post illustration" class="rounded-xl">
                            </div>

                            <div class="mt-8 flex flex-col justify-between">
                                <header>

                                    <div class="mt-4">
                                        <h1 class="text-3xl">
                                            {{ $post->job_title }}
                                        </h1>
                                        {{-- <h1 class="text-3xl">
                                            {{ $post->Company->name }}
                                        </h1> --}}
                                        <span class="mt-2 block text-gray-400 text-xs">
                                            Published <time>{{ $post->created_at }}</time>
                                        </span>
                                    </div>
                                </header>
                                <div class="text-sm mt-4">
                                    <p class="mt-4">
                                        {{ $post->description }}
                                    </p>
                                </div>
                                <footer class="flex justify-between items-center mt-8">
                                    <div>
                                        <a href="{{ route('post.show', $post->id) }}"
                                            class="text-blue-500 hover:text-blue-600 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 ">Details</a>

                                    </div>
                                </footer>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

        </main>

        <footer class="bg-gray-100 border border-black border-opacity-5 rounded-xl text-center py-16 px-10 mt-16">
            {{ $jobpost->links() }}

        </footer>
    </section>
</body>
