<?php
     session_start();
     if(empty($_SESSION["rib"])){
         header("location:login.php");
     }
     $file = "data.json";
     $rib=$_SESSION["rib"];
    $type=$_SESSION["type"];

        $data = [];
        if (file_exists($file)) {
            $jsonData = file_get_contents($file);
            $data = json_decode($jsonData, true);
        }
        foreach($data as $d){
            if($rib == $d["RIB"] && $type==$d["type"]){
                $fullname=$d["Nom"];
                $email=$d["email"];
                $type=$d["type"];
                $solde=$d["Solde"];
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
    <div><?php echo $fullname;?></div>
    <div><?php echo $email;?></div>
    <div><?php echo $type;?></div>
    <div><?php echo $solde;?></div>
    <a href="programme_compte.php">return to the menue</a>
</body>
</html>