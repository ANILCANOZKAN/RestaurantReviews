@props(['restaurant'])
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    * {
        box-sizing: border-box;
    }
    /* Add a gray background color with some padding */
    body {
        font-family: Arial;
        padding: 20px;
        background: #f1f1f1;
    }
    /* Header/Blog Title */
    .header {
        padding: 30px;
        font-size: 40px;
        text-align: center;
        background: white;
    }
    /* Create two unequal columns that floats next to each other */
    /* Left column */
    .leftcolumn {
        float: left;
        width: 75%;
    }
    /* Right column */
    .rightcolumn {
        float: left;
        width: 25%;
        padding-left: 20px;
    }
    /* Fake image */
    .fakeimg {
        background-color: #aaa;
        width: 100%;
        padding: 20px;
    }
    /* Add a card effect for articles */
    .card {
        background-color: white;
        padding: 20px;
        margin-top: 20px;
    }
    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }
    .avatar {
        vertical-align: middle;
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }
    .rate {
        float: left;
        height: 46px;
        padding: 0 10px;
    }
    .rate:not(:checked) > input {
        position:absolute;
        display: none;
    }
    .rate:not(:checked) > label {
        float:right;
        width:1em;
        overflow:hidden;
        white-space:nowrap;
        cursor:pointer;
        font-size:30px;
        color:#ccc;
    }
    .rate:not(:checked) > label:before {
        content: '★ ';
    }
    .rate > input:checked ~ label {
        color: #ffc700;
    }
    .rate:not(:checked) > label:hover,
    .rate:not(:checked) > label:hover ~ label {
        color: #deb217;
    }
    .rate > input:checked + label:hover,
    .rate > input:checked + label:hover ~ label,
    .rate > input:checked ~ label:hover,
    .rate > input:checked ~ label:hover ~ label,
    .rate > label:hover ~ input:checked ~ label {
        color: #c59b08;
    }
    .rating-container .form-control:hover, .rating-container .form-control:focus{
        background: #fff;
        border: 1px solid #ced4da;
    }
    .rating-container textarea:focus, .rating-container input:focus {
        color: #000;
    }
    /* End */
</style>
<div class="container">
    <div class="row">
        <div class="col-sm-10 mt-4 ">
            <form class="py-2 px-4" action="/rating/{{ $restaurant->slug }}" style="box-shadow: 0 0 10px 0 #ddd;" method="POST" autocomplete="off">
                @csrf
                <input type="hidden" name="restaurant_id" value="{{$restaurant->id}}" required>
                <div class="row justify-content-end mb-1">
                    <div class="col-sm-8 float-right">
                        @if(Session::has('flash_msg_success'))
                        <div class="alert alert-success alert-dismissible p-2">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!</strong> {!! session('flash_msg_success')!!}.
                        </div>
                        @endif
                    </div>
                </div>
                <p class="font-weight-bold ">Yorum</p>
                <div class="form-group row">
                    <div class=" col-sm-6">
                        <span class="form-control" maxlength="40">{{ auth()->user()->name }}</span>
                    </div>
                    <div class="col-sm-10 mt-2">
                        <span class="form-control">{{ auth()->user()->email }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <div class="rate">
                            <input type="radio" id="star5" class="rate" name="rating" value="5"/>
                            <label for="star5" title="text">5 stars</label>
                            <input type="radio" checked id="star4" class="rate" name="rating" value="4"/>
                            <label for="star4" title="text">4 stars</label>
                            <input type="radio" id="star3" class="rate" name="rating" value="3"/>
                            <label for="star3" title="text">3 stars</label>
                            <input type="radio" id="star2" class="rate" name="rating" value="2">
                            <label for="star2" title="text">2 stars</label>
                            <input type="radio" id="star1" class="rate" name="rating" value="1"/>
                            <label for="star1" title="text">1 star</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row mt-4">
                    <div class="col-sm-12 ">
                        <textarea class="form-control" name="comment" rows="6 " placeholder="Comment" maxlength="200"></textarea>
                    </div>
                </div>
                <div class="mt-3 ">
                    <button class="btn btn-sm py-2 px-3 btn-info">Gönder
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
