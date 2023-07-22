@if(auth()->user()->role == 2)
        <a class="bg-green-500 text-white font-bold p-1 rounded-xl hover:bg-green-600" href="/admin/section/restaurants">
            Administration
        </a>
@endif
