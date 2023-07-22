@props(['reply'])
<article style="float-defer-column: last; float: right; width: 1000px" class="flex bg-gray-100 border border-gray-200 p-6 rounded-xl space-x-4">
    <?php
        $user_id = $reply->user_id;
        $user = \App\Models\User::all()->firstWhere('id', $user_id);
    ?>
    <div class="flex-shrink-0">
        <img src="/images/ouz.png" alt="" width="60" height="60">
    </div>
    <div>
        <header class="mb-4">
            <div class="flex">
            <h3 class="font-bold">{{ $user->name }}</h3>
            @auth
                @if(auth()->user()->role == 2)
                        <a class="bg-red-500 text-white rounded-xl p-1 ml-4" href="/delete/reply/{{ $reply->id }}">Delete</a>
                @endif
            @endauth
                    </div>
            <p class="text-xs">
                Posted
                <time>{{ $reply->created_at->diffForHumans() }}.</time>
            </p>
        </header>
        <p>
            {{ $reply->comment }}
        </p>
    </div>
</article>
