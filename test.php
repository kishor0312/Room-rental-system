<?php
    $x = [5,2,1];
    $value = 5;
    $unique_values = array_unique($x);
    asort($unique_values);
    echo implode(", ", $unique_values). "<br>";
    $index = array_search($value, array_values($unique_values),true);
    echo "value:".$value." index:".$index."<br>";

?>