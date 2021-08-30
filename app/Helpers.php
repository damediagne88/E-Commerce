<?php 

// creation d'un helper price pour l'utiliser dans tous mon application il faudra appeler dans composer.json "files":[
//           "app/Helpers.php"
//       ],

// et a la fin mettre un composer dump-autoload
// j'utilse floatVal pour convertir le prix en float 
// et je le divise par 100 a la fin avant de le formater 

function getPrice($price){

    $price = floatVal($price) / 100;

    return number_format($price, 2, ',', ' '). ' euros ';
}