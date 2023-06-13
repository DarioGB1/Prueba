<?php
    define("HOST", "localhost");
    define("PORT", 8081);
    define("PI", 3.1416);

    if(defined("HOST"))
    print ("Hay un host definido");

    print ("\n");

    if(defined("PASS"))
        print("pass definido");
    else
        print("no hay pass");

    
    print("\n");


    $frase_cichad = "Pura yuca papi";

    print("Cichad : $frase_cichad\n");

    $a = 2; $b = 3;

    print("la suma entre $a y $b es: ".$a+$b);

    print("\n");

    $dato = readline("Digite su nombre completo: ");

    print("Hola $dato");

    $edad = readline("digite su edad: ");

    print("Tu edad es: $edad");

    if($edad > 18)
        print("Sos mayor de edad");
    else
        print("Eres menor de edad");




?>