<?php
$n=30;
$sum=0;
$prod=1;
$mul=1;
for($i=0; $i<=$n; $i++){
    $sum+=$i;
    echo("$i+ ");
}
echo("=$sum<br>");
for($j=1; $j<=$n; $j++){
    $mul*=$j;
    echo("$j* ");
}
echo("=$mul");