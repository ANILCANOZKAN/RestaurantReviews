@props(['restaurant'])
<article
    class="transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl">
    <div class="py-6 px-5">
        <div>
            <img src="/images/illustration-3.png" alt="Blog Post illustration" class="rounded-xl">
        </div>

        <div class="mt-8 flex flex-col justify-between">
            <header>
                <div class="space-x-2 mb-2" >
                    <a href="#"
                       class="px-3 py-1 border border-blue-300 rounded-full text-blue-300 text-xs uppercase font-semibold"
                       style="font-size: 10px">{{ $restaurant->category->name }}</a>
                </div>
                <x-like :restaurant="$restaurant" />
                <div class="mt-3">
                    <h1 class="text-3xl">
                        {{ $restaurant->name }}
                    </h1>

                    <span class="mt-2 block text-gray-400 text-xs">
                                        <time>{{ $restaurant->created_at }}</time>
                                    </span>
                </div>
            </header>

            <div class="text-sm mt-4">
                <p>
                    {{ $restaurant->descriptions }}
                </p>
            </div>

            <footer class="flex justify-between items-center mt-8">
                <div class="flex items-center text-sm">
                    <img src="/images/lary-avatar.svg" alt="Lary avatar">
                    <div class="ml-3">
                        <h5 class="font-bold">{{ $restaurant->user->name }}</h5>
                        <h6>Mascot at Laracasts</h6>
                    </div>
                </div>

                <div>
                    <a href="/restaurants/{{ $restaurant->slug }}"
                       class="transition-colors duration-300 text-xs font-semibold bg-gray-200 hover:bg-gray-300 rounded-full
                       py-2 px-8"
                    >Read More</a>
                </div>
            </footer>
        </div>
    </div>
</article>
