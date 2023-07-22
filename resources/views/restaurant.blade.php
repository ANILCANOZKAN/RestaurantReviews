<x-layout>
    <body style="font-family: Open Sans, sans-serif">
        <main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
            <article class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
                <div class="col-span-4 lg:text-center lg:pt-14 mb-10">
                    <img src="{{ isset($post->thumbnail) ? asset('storage/'.$post->thumbnail): '/images/illustration-4.png' }}" alt="" class="rounded-xl">
                    <p class="mt-4 block text-gray-400 text-xs">
                        <time>Dating at {{ $restaurant->created_at->diffForHumans() }}</time>
                    </p>

                    <div class="flex items-center lg:justify-center text-sm mt-4">
                        <img src="{{ isset($post->author->PP) ? asset('storage/'.$post->author->PP):  '/images/lary-avatar.svg' }}"
                             width="80"
                             height="80"
                             class="rounded-3xl"
                             alt="Lary avatar">
                        <div class="ml-3 text-left">
                            <a href="?author={{ $restaurant->user->id }}">
                                <h5 class="font-bold">{{ $restaurant->user->name }}</h5>
                                <h6>{{ $restaurant->user->email }}</h6></a>
                        </div>
                    </div>
                </div>

                <div class="col-span-8">
                    <div class="hidden lg:flex justify-between mb-6">
                        @auth
                            @if(auth()->user()->role == 1)
                                <a href="/index"
                                   class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500">
                                    <svg width="22" height="22" viewBox="0 0 22 22" class="mr-2">
                                        <g fill="none" fill-rule="evenodd">
                                            <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                                            </path>
                                            <path class="fill-current"
                                                  d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z">
                                            </path>
                                        </g>
                                    </svg>
                                    Back to Restaurants
                                </a>
                                @endauth
                            @else
                        <a href="/"
                           class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500">
                            <svg width="22" height="22" viewBox="0 0 22 22" class="mr-2">
                                <g fill="none" fill-rule="evenodd">
                                    <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                                    </path>
                                    <path class="fill-current"
                                          d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z">
                                    </path>
                                </g>
                            </svg>
                            Back to Restaurants
                        </a>
                            @endif
                        <div class="m-auto">
                            <x-like :restaurant="$restaurant" />
                        </div>
                    </div>
                    <a href= "/restaurants/{{ $restaurant->slug }}"><h1 class="flex-inline text-3xl">
                            {{ $restaurant->name }}
                        </h1></a>

                    <div class="space-y-4 mt-4 lg:text-lg leading-loose space-y-4">
                        {!! $restaurant->descriptions !!}
                    </div>
                </div>

            </article>
            <section class="col-span-8 col-start-5 mt-10 space-y-6">
                @auth
                    <x-comment-store :restaurant="$restaurant" />
                @else
                    <span class="font-bold ">Yorum yapmak için Giriş Yap ya da Kayıt Ol.</span>
                @endauth
            </section>
            @php
                $comments = \App\Models\Rating::all()->where('restaurant_id', $restaurant->id)->sortByDesc('created_at');
            @endphp
            @foreach( $comments as $comment)
                    <x-restaurant-comment :comment="$comment" />
            @endforeach
        </main>
    </body>
</x-layout>
