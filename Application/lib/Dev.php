<?php 
//Display errors on the screen(Вивід помилок на екран):
ini_set('display_errors', 1);
error_reporting(E_ALL);

//function for the debug:
function debug($str){
    echo'<pre>';
    var_dump($str);
    echo'</pre>';
    exit;
}



