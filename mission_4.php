<?php
$identicalPairs=0;

$array=[];

for($i=0;$i<101;$i++){$array[]=rand(-100,100);}

foreach ($array as $key=>$value){

    if($key + 1 >=101){break;}

    if ($array[$key] === $array[$key + 1]) {

        $identicalPairs++;

    }

}

echo $identicalPairs;