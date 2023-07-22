<header class="max-w-xl mx-auto mt-20 text-center">
    <h1 class="text-4xl">
        <span class="font-bold">Restaurants Reviews</span>
    </h1>
    <div class="space-y-2 lg:space-y-0 lg:space-x-4 mt-4">
        <!--  Category -->
        <div class="relative lg:inline-flex bg-gray-100 rounded-xl">
            <div x-data="{ show: false}" @click.away = "show = false">
                <button @click="show = !show" class ="py-2 pl-3 pr-9 text-sm font-semibold
                        w-32 text-left inline-flex">
                    {{ isset($currentCategory) ? ucwords($currentCategory->name) : "Categories" }}
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
                    <a href="/" class = "block text-left px-3 text-sm
                            leading-6 hover:bg-blue-500 focus:bg-blue-500 hover:text-white focus:text-white
                            {{ isset($currentCategory) ? "" : 'bg-green-500 text-white' }}">
                        All</a>
                    @foreach ($categories as $category)
                        <a href="?category={{ $category->slug }}&{{ http_build_query(request()->except('category', 'page')) }}"
                           class = "block text-left px-3 text-sm
                            leading-6 hover:bg-blue-500 focus:bg-blue-500 hover:text-white focus:text-white
                            {{ isset($currentCategory) && $currentCategory->slug == $category->slug ? 'bg-green-500 text-white' : "" }}
                                ">
                            {{ ucWords($category->name) }}</a>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Other Filters -->
        <!-- Search -->
        <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl">
                    <div class="relative lg:inline-flex bg-gray-100 rounded-xl">
                        <div x-data="{ show: false}" @click.away = "show = false">
                            <button @click="show = !show" class ="py-2 pl-3 pr-9 text-sm font-semibold
                        w-32 text-left inline-flex">
                                Filtrele
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
                                <a href="/"
                                   class = "block text-left px-3 text-sm
                            leading-6 hover:bg-blue-500 focus:bg-blue-500 hover:text-white focus:text-white">
                                    Hepsi</a>
                                    <a href="/rating/1"
                                       class = "block text-left px-3 text-sm
                            leading-6 hover:bg-blue-500 focus:bg-blue-500 hover:text-white focus:text-white">
                                        Rating > 1</a>
                                <a href="/rating/2"
                                   class = "block text-left px-3 text-sm
                            leading-6 hover:bg-blue-500 focus:bg-blue-500 hover:text-white focus:text-white">
                                    Rating > 2</a>
                                <a href="/rating/3"
                                   class = "block text-left px-3 text-sm
                            leading-6 hover:bg-blue-500 focus:bg-blue-500 hover:text-white focus:text-white">
                                    Rating > 3</a>
                                <a href="/rating/4"
                                   class = "block text-left px-3 text-sm
                            leading-6 hover:bg-blue-500 focus:bg-blue-500 hover:text-white focus:text-white">
                                    Rating > 4</a>
                    </div>
        </div>
    </div>
</header>
