<!doctype html>

<title>Laravel From Scratch Blog</title>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="/like.css">
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script   src="https://code.jquery.com/jquery-3.1.1.min.js"   integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="   crossorigin="anonymous"></script>


<body style="font-family: Open Sans, sans-serif">
<section class="px-6 py-8">
    <nav class="md:flex md:justify-between md:items-center">
        <div>
            <a href="/">
                <img src="/images/logo.svg" alt="Laracasts Logo" width="165" height="16">
            </a>
        </div>
        @guest
        <div class="relative px-9 lg:inline-flex bg-gray-100 rounded-xl">
            <div x-data="{ show: false}" @click.away = "show = false">
                <button @click="show = !show" class ="py-2 pl-7 pr-9 text-sm font-semibold
                        w-32 inline-flex">
                    Kayıt Ol
                    <svg class="transform -rotate-90 absolute pointer-events-none" style="right: 12px;" width="22"
                         height="22" viewBox="0 0 22 22">
                        <g fill="none" fill-rule="evenodd">
                            <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                            </path>
                            <path fill="#222"
                                  d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z"></path>
                        </g>
                    </svg>


                </button>
                <div x-show = "show" class = "py-2 absolute bg-gray-100 w-full mt-2
                        rounded-xl z-50 overflow-auto max-h-52" style="display: none">
                    <form method="post" action="/register">
                        @csrf
                        <label class="pl-2" for="name">Ad-Soyad</label>
                        <input class="rounded-xl w-full pl-2"
                               id="name"
                               name="name"
                               placeholder="Ad-Soyad"
                               type="text"
                               required>
                        @error('name')
                        <p class="text-red-500 text-xs mt-1"> Burası boş bırakılamaz. </p>
                        @enderror
                        <label class="pl-2" for="email">E-mail</label>
                    <input class="rounded-xl w-full pl-2"
                           id="email"
                           name="email"
                           placeholder="E-mail"
                           type="email"
                    required>
                        @error('email')
                        <p class="text-red-500 text-xs mt-1"> {{ $message }} </p>
                        @enderror
                        <label class="pl-2" for="password">Parola</label>
                        <input class="rounded-xl w-full pl-2"
                               id="password"
                               name="password"
                               placeholder="Parola"
                               type="password"
                               required>
                        @error('password')
                        <p class="text-red-500 text-xs mt-1"> {{ $message }} </p>
                        @enderror
                        <button type="submit" class="text-white bg-blue-400 hover:bg-white hover:text-blue-400 rounded-xl mt-2 ml-2 p-1">Kayıt Ol</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="relative px-9 lg:inline-flex bg-gray-100 rounded-xl">
            <div x-data="{ show: false}" @click.away = "show = false">
                <button @click="show = !show" class ="py-2 pl-7 pr-9 text-sm font-semibold
                        w-32 inline-flex">
                    Giriş Yap
                    <svg class="transform -rotate-90 absolute pointer-events-none" style="right: 12px;" width="22"
                         height="22" viewBox="0 0 22 22">
                        <g fill="none" fill-rule="evenodd">
                            <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                            </path>
                            <path fill="#222"
                                  d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z"></path>
                        </g>
                    </svg>


                </button>
                <div x-show = "show" class = "py-2 absolute bg-gray-100 w-full mt-2
                        rounded-xl z-50 overflow-auto max-h-52" style="display: none">
                    <form method="post" action="/login">
                        @csrf
                        <label class="pl-2" for="email">E-mail</label>
                        <input class="rounded-xl w-full pl-2"
                               id="email"
                               name="email"
                               placeholder="E-mail"
                               type="email"
                               required>
                        @error('email')
                        <p class="text-red-500 text-xs mt-1"> {{ $message }} </p>
                        @enderror
                        <label class="pl-2" for="password">Parola</label>
                        <input class="rounded-xl w-full pl-2"
                               id="password"
                               name="password"
                               placeholder="Parola"
                               type="password"
                               required>
                        @error('password')
                        <p class="text-red-500 text-xs mt-1"> {{ $message }} </p>
                        @enderror
                        <button type="submit"
                                class="text-white bg-blue-400 hover:bg-white hover:text-blue-400 rounded-xl
                                mt-2 ml-2 p-1">Giriş Yap</button>
                    </form>
                </div>
            </div>
        </div>
        @endguest
        @auth
            <x-adminSection />
            <x-createRestaurant />
            <div class="mt-8 md:mt-0">
                <span>{{ auth()->user()->name }}</span>
                <a href="/logout" class="bg-blue-500 ml-3 hover:bg-blue-600 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">
                    ÇIKIŞ
                </a>
            </div>
        @endauth
    </nav>
        {{ $slot }}
</section>
@if(session()->has('success'))
    <div x-data="{ show: true}"
         x-init="setTimeout(() => show = false, 4000)"
         x-show="show"
         class="fixed bg-green-500 text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm"
    >
        <p>{{ session('success') }}</p>
    </div>
@endif
</body>
