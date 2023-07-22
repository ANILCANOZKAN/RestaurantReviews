@props(['restaurant'])
<?php
    $rating = (int)$restaurant -> overall_like;
    $num = 1;
while($rating > 0.5 ){
    echo '<div class="checked">
        <span class="fa fa-star checked active"></span>';
    $rating--;
    $num++;}
while(5 - $num >= 0){
        echo '<div class="checked">
        <span class="fa fa-star checked off"></span>';
        $num++;
}?>
<span id="overall_like" class="ml-2">User Ratings: {{ $restaurant->overall_like }} star.</span>
@php
    $high = 0;
    $low = 5;
    $bool = false;
    foreach (\App\Models\Rating::all()->where('restaurant_id', $restaurant->id) as $rate){
        if($rate->rating >= $high){
            $high = $rate->rating;
        }
        if ($rate->rating <= $low){
            $low = $rate->rating;
            $bool = true;
        }
    }
@endphp
<div class="flex">{{ 'En yüksek oy: '. $high }}</div>
@if($bool)
<div class="flex">{{ 'En düşük oy: '. $low }}</div>
@else
    <div class="flex">{{ 'En düşük oy: 0'}}</div>
@endif
