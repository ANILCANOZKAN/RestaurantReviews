@props(['comment'])
@php
    $user_id = $comment->user_id;
    $user = \App\Models\User::all()->firstWhere('id', $user_id);
    @endphp
<link rel="stylesheet" href="public/style.css">
<div class="header">
    <article class="">
    <div class="flex-shrink-0">
        <img src="/images/ouz.png" alt="" width="60" height="60">
    </div>
    <div>
        <header class="mb-4">
                <h3 class="font-bold">{{ $user->name }}</h3>
            <x-userlike :rate="$comment" />
            @auth
                @if(auth()->user()->role == 2)
            <div style="float: right" class="ml-2">
                <a class="bg-red-500 text-white rounded-xl p-1" href="/delete/comment/{{ $comment->id }}">Delete</a>
            </div>
                    @endif
            @endauth
            <p class="text-xs">
                Posted
                <time>{{ $comment->created_at->diffForHumans() }}.</time>
            </p>
        </header>
        <p>
            {{ $comment->comment }}
        </p>
        @auth
            @php
        $owner = \App\Models\Restaurant::all()->firstWhere('id', $comment->restaurant_id);
        $owner = $owner->user_id;
    @endphp
            @if($owner == auth()->id())
            <button type="button"
                    data-toggle="reply-form-{{ $comment->id }}"
                    class="rounded-xl bg-blue-500 mt-2 text-white hover:bg-blue-600 p-1"
                    data-target="comment-{{$comment->id}}-reply-form">
                Cevapla</button>
        <form method="POST" action="createReply/{{ $comment->id }}" class="reply-form d-none" id="{{$comment->id}}">
            @csrf
            <textarea placeholder=" Cevaplayın." id="comment" name="comment" rows="4" required></textarea>
            <button type="submit" class="rounded-xl bg-blue-500 mt-2 text-white hover:bg-blue-600 p-1">Gönder</button>
            <button type="button" class="rounded-xl bg-blue-500 mt-2 text-white hover:bg-blue-600 p-1" data-toggle="reply-form-{{ $comment->id }}" data-target="comment-{{$comment->id}}-reply-form">Geri</button>
        </form>
            @endif
        @endauth
    </div>
    </article>
</div>
<?php
$reply = \App\Models\Reply::firstWhere('rating_id', $comment->id);
if($reply != null){ ?>
<x-comment-reply :reply="$reply" />
<?php } ?>

<style>
    * {
        box-sizing: border-box;
    }
    body {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
        line-height: 1.4;
        color: rgba(0, 0, 0, 0.85);
        background-color: #f9f9f9;

    }
    .comment-thread {
        width: 700px;
        max-width: 100%;
        margin: auto;
        padding: 0 30px;
        background-color: #fff;
        border: 1px solid transparent; /* Removes margin collapse */
    }
    .m-0 {
        margin: 0;
    }
    .sr-only {
        position: absolute;
        left: -10000px;
        top: auto;
        width: 1px;
        height: 1px;
        overflow: hidden;
    }

    /* Reply */

    .comment {
        position: relative;
        margin: 20px auto;
    }
    .comment-heading {
        display: flex;
        align-items: center;
        height: 50px;
        font-size: 14px;
    }
    .comment-voting {
        width: 20px;
        height: 32px;
        border: 1px solid rgba(0, 0, 0, 0.2);
        border-radius: 4px;
    }
    .comment-voting button {
        display: block;
        width: 100%;
        height: 50%;
        padding: 0;
        border: 0;
        font-size: 10px;
    }
    .comment-info {
        color: rgba(0, 0, 0, 0.5);
        margin-left: 10px;
    }
    .comment-author {
        color: rgba(0, 0, 0, 0.85);
        font-weight: bold;
        text-decoration: none;
    }
    .comment-author:hover {
        text-decoration: underline;
    }
    .replies {
        margin-left: 20px;
    }

    /* Adjustments for the comment border links */

    .comment-border-link {
        display: block;
        position: absolute;
        top: 50px;
        left: 0;
        width: 12px;
        height: calc(100% - 50px);
        border-left: 4px solid transparent;
        border-right: 4px solid transparent;
        background-color: rgba(0, 0, 0, 0.1);
        background-clip: padding-box;
    }
    .comment-border-link:hover {
        background-color: rgba(0, 0, 0, 0.3);
    }
    .comment-body {
        padding: 0 20px;
        padding-left: 28px;
    }
    .replies {
        margin-left: 28px;
    }

    /* Adjustments for toggleable comments */

    details.comment summary {
        position: relative;
        list-style: none;
        cursor: pointer;
    }
    details.comment summary::-webkit-details-marker {
        display: none;
    }
    details.comment:not([open]) .comment-heading {
        border-bottom: 1px solid rgba(0, 0, 0, 0.2);
    }
    .comment-heading::after {
        display: inline-block;
        position: absolute;
        right: 5px;
        align-self: center;
        font-size: 12px;
        color: rgba(0, 0, 0, 0.55);
    }
    details.comment[open] .comment-heading::after {
        content: "Click to hide";
    }
    details.comment:not([open]) .comment-heading::after {
        content: "Click to show";
    }

    /* Adjustment for Internet Explorer */

    @media screen and (-ms-high-contrast: active), (-ms-high-contrast: none) {
        /* Resets cursor, and removes prompt text on Internet Explorer */
        .comment-heading {
            cursor: default;
        }
        details.comment[open] .comment-heading::after,
        details.comment:not([open]) .comment-heading::after {
            content: " ";
        }
    }

    /* Styling the reply to comment form */

    .reply-form textarea {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
        font-size: 16px;
        width: 100%;
        max-width: 100%;
        margin-top: 15px;
        margin-bottom: 5px;
        round-clip: 2px;
    }
    .d-none {
        display: none;
    }
</style>

<script>
    document.addEventListener(
        "click",
        function(event) {
            var target = event.target;
            var replyForm;
            const Comment_id = '<?= $comment->id ?>';
            var str =  'reply-form-'+Comment_id;
            var data_toggle = target.getAttribute("data-toggle");
            if (data_toggle == str) {
                replyForm = document.getElementById(Comment_id);
                replyForm.classList.toggle("d-none");
            }
        },
        false
    );
</script>
