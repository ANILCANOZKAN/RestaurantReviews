@props(['rate'])
<?php
$rating = $rate -> rating;
$num = 1;
while($rating > 0 ){
    echo '<div class="checked">
        <span class="fa fa-star checked active"></span>';
    $rating--;
    $num++;}
while(5 - $num >= 0){
    echo '<div class="checked">
        <span class="fa fa-star checked off"></span>';
    $num++;
}
echo '  '.$rate->rating.' Stars';?>
