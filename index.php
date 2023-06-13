<?php
    $a = 200;
    if(isset($a)){
        print "variable con valor";
    }else{
        print 'Variable sin valor';
    }

    print "\n";



    $nombre = "edwin";
    if(isset($nombre)){
        $nombre = $nombre. " Aguilar";
        print("Tu nombre es ". $nombre);
    }

    print "\n";

    unset($a);
    if(!isset($a))
        print "no existe la variable";
    else
        print "no la destruiste,perdedor";

    print "\n";
    
  $b = 0;
  if (empty($b))
    print "Esta vacio";
  else
    print "tiene un valor";

  
    if("condicion"){

    }else{

    }


    if("condicion"){

    }elseif("condicion"){

    }else{

    }

    //numero mayor menor

$n1 = 100;

$n2 = 200;

if($n1>$n2)

 print("el mayor es:".$n1);

else

print("el numero mayor es:".$n2)



?>