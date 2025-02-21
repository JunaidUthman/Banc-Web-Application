<?php
    session_start();
    if(empty($_SESSION["rib"])){
        header("location:login.php");
    }
    
    if(isset($_POST["submit"])){
        $somme = $_POST["somme"];
        $rib=$_SESSION["rib"];
        $type=$_SESSION["type"];
        $email=$_SESSION["email"];
        $password=$_SESSION["password"];

        $file = "data.json";

        $data = [];
        if (file_exists($file)) {
            $jsonData = file_get_contents($file);
            $data = json_decode($jsonData, true);
        }
        if($type=="carnet"){
            foreach($data as $d){
                if($rib == $d["RIB"] && $type==$d["type"]){
                    require("class_compte_carnet.php");
                    //echo "l9itk";
                    $fullname = $d["Nom"];
                    $solde = $d["Solde"];
                    $compte = new compte_carnet($email , $password ,$fullname , $solde ,$rib);
                    $compte -> deposer($somme);
                    echo "vous avez deposer ".$somme." DH"."<br>";
                    echo "on ajouter ". 0.3*$somme." DH comme bonus"."<br>";
                    echo '<a href="programme_compte.php">retourner au menue </a>';
                    exit;
                }
            }
        }
        else{
            foreach($data as $d){
                if($rib == $d["RIB"] && $type==$d["type"]){
                    require("class_compte_chequier.php");
                    //echo "i found u";
                    $fullname = $d["Nom"];
                    $solde = $d["Solde"];
                    $compte = new compte_chequier($email , $password ,$fullname , $solde ,$rib);
                    $compte -> deposer($somme);
                    echo "vous avez deposer ".$somme." DH"."<br>";
                    echo '<a href="programme_compte.php">retourner au menue </a>';
                    exit;
                }
            }
        }
        echo "vos informationn sont pas correcte"."<br>";
        echo '<a href="programme_compte.php">retourner au menu</a>';

    }
?>