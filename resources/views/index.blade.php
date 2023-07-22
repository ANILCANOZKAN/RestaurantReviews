<x-layout>
    @include('_restaurant-header')
    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        <div class="lg:grid lg:grid-cols-3">
            @if($restaurants->count())
                @foreach($restaurants as $restaurant)
                    <x-restaurant-card :restaurant="$restaurant"/>
                @endforeach
            @else
                <div class="text-center">
                {{ 'Üzgünüz. Henüz restoran yok.' }}
                </div>
            @endif
        </div>
    </main>
</x-layout>
