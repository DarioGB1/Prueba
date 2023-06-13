<?php

    $var = "soy global";

    function funcion($v){
        print("se llama a la funcion\n");
        $var = "esto es una variable local";
        $v = "modificado";
        print($var."\n");
    }

    funcion($var);

    print($var);
?>