<?php
    session_start();
    if(empty($_SESSION["rib"])){
        header("location:login.php");
    }
    if(isset($_POST["submit"])){
        $somme = $_POST["somme"];
        $rib = $_SESSION["rib"];
        $type=$_SESSION["type"];
        $email=$_SESSION["email"];
        $password=$_SESSION["password"];
    }
    $file = "data.json";

        // Initialiser le tableau `$data` en lisant le fichier existant ou en le créant vide
        $data = [];
        if (file_exists($file)) {
            $jsonData = file_get_contents($file);
            $data = json_decode($jsonData, true); // Convertir JSON en tableau PHP
        }
        if($type=="carnet"){
            foreach($data as $d){
                if($rib == $d["RIB"] && $type==$d["type"]){
                    require("class_compte_carnet.php");
                    //echo "l9itk";
                    $fullname = $d["Nom"];
                    $solde = $d["Solde"];
                    $compte = new compte_carnet($email , $password ,$fullname , $solde ,$rib);
                    $compte -> retirer($somme);
                    echo "vous avez retirer ".$somme." DH"."<br>";
                    echo '<a href="programme_compte.php">retourner au menue </a>';
                    exit;
                }
            }
        }
        else{
            foreach($data as $d){
                if($rib == $d["RIB"] && $type==$d["type"]){
                    require("class_compte_chequier.php");
                    //echo "l9itk";
                    $fullname = $d["Nom"];
                    $solde = $d["Solde"];
                    $compte = new compte_chequier($email , $password ,$fullname , $solde ,$rib);
                    $compte -> retirer($somme);
                    echo "vous avez retirer ".$somme." DH"."<br>";
                    echo "on a retirer ". 0.1*$somme." DH comme TAX"."<br>";
                    echo '<a href="programme_compte.php">retourner au menue </a>';
                    exit;
                }
            }
        }
        echo "on a pas trouver le numero de compte que vous a entré"."<br>";
        echo '<a href="programme_compte.php">retourner au menu</a>';
?>