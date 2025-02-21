<?php

    if(isset($_POST["submit"])){
        $type = $_POST["type"];
        $fullname=$_POST["fullname"];
        $solde=$_POST["solde"];

        if($type == "carnet"){
            require("class_compte_carnet.php");
            $c = new compte_carnet($email , $password ,$fullname , $solde ,$rib);
            $rib=$c -> creer_compte();
            echo "votre compte (carnet) est crée avec succés"."<br>"."voile votre RIB : ".$rib;
        }
        if($type == "chequier"){
            require("class_compte_chequier.php");
            $c = new compte_chequier($email , $password ,$fullname , $solde ,$rib);
            $rib=$c -> creer_compte();
            echo "votre compte (chequier) est crée avec succés"."<br>"."voile votre RIB : ".$rib;
        }
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="programme_compte.php">retourner au menue</a>
</body>
</html>