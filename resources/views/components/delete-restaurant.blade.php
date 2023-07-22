@props(['restaurant'])
<form method="post" action="/delete/restaurant/{{ $restaurant->slug }}">
    @csrf
    <button type="submit" class="flex-inline font-bold px-2 mt-1 mb-1 text-red-500 rounded-full bg-white-500
                    hover:bg-red-500 border border-red-500 hover:text-white">X</button>
</form>
