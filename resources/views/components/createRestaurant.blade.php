@if(auth()->user()->role == 1)
    <button type="button" data-toggle="create-form" class="rounded-xl bg-blue-500 mt-2 text-white hover:bg-blue-600 p-1" data-target="comment-1-create-form">Create Restaurant</button>
    <form method="POST" action="/createRestaurant" class="create-form d-none" id="comment-1-create-form">
        @csrf
        <input class="border rounded" id="name" name="name" type="text" PLACEHOLDER="name">
        <input class="border rounded" id="slug" name="slug" type="text" PLACEHOLDER="slug">
        <textarea class="border rounded " placeholder="description" id="descriptions" name="descriptions" rows="4" required></textarea>
        <button type="submit" class="rounded-xl bg-blue-500 mt-2 text-white hover:bg-blue-600 p-1">Create</button>
        <button type="button" class="rounded-xl bg-blue-500 mt-2 text-white hover:bg-blue-600 p-1" data-toggle="create-form" data-target="comment-1-create-form">Geri</button>
    </form>
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

        .create-form textarea {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            font-size: 16px;
            width: 100%;
            max-width: 100%;
            margin-top: 15px;
            margin-bottom: 5px;
        }
        .create-form textarea {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            font-size: 16px;
            width: 100%;
            max-width: 100%;
            margin-top: 15px;
            margin-bottom: 5px;
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
                if (target.matches("[data-toggle='create-form']")) {
                    replyForm = document.getElementById(target.getAttribute("data-target"));
                    replyForm.classList.toggle("d-none");
                }
            },
            false
        );
    </script>

@endif

