<?php
    //array o arreglo

    $A = [1,"dos",3.3,"cuatro", 5];
    $B = [0 => 1, "uno"=> 1, 5=> 5000, 3=> "tres"];
    //var_dump($A);
    //var_dump($B);


    $B["index"] = "Agregado";

    //var_dump($B);

    //eliminar elemento
    unset($B);

    //svar_dump($B);
    //if (isset($B)){
      //  print("la variable \$B existe");
    //}else{
      //  print("la variablen \$B no existe");
    //}

    //$C = [6,3,2,1,5,7,9];
    //asort($C);
    //var_dump($C);

    //tarea, 
    $D = ["hola", "como", "estan", "univalle", "jeje"];


for ($i = 0; $i < count($D) - 1; $i++) {
    for ($j = $i + 1; $j < count($D); $j++) {
       
        $i_first = substr($D[$i], 0, 1);
        $j_first = substr($D[$j], 0, 1);

      
        if ($j_first < $i_first) {
            $temp = $D[$i];
            $D[$i] = $D[$j];
            $D[$j] = $temp;
        }
    }
}

print_r($D);



?>