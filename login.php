<?php
session_start();
    if(isset($_POST["submit"])){
        $email = $_POST["email"];
        $password=$_POST["password"];
        $type=$_POST["type"];
    
        $file = "data.json";

            // Initialiser le tableau `$data` en lisant le fichier existant ou en le créant vide
            $data = [];
            if (file_exists($file)) {
                $jsonData = file_get_contents($file);
                $data = json_decode($jsonData, true); // Convertir JSON en tableau PHP
            }
            foreach($data as $d){
                if($email == $d["email"] && $password==$d["password"]){
                    $_SESSION["rib"]=$d["RIB"];
                    $_SESSION["type"]=$d["type"];
                    $_SESSION["email"]=$email;
                    $_SESSION["password"]=$password;
                    header("location:programme_compte.php");
                    exit;
                }
            }
            echo '<div class="message_error">The info u entred are not correct.</div>';
    }
    else{
        //echo "nop";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="box">
            <div class="login_pic">
                <img class="login_img" src="images/Designer (5).jpeg" alt="">
            </div>
            <div class="login_container">
                <h1 class="titre">Login</h1>
                <form action="login.php" method="post">

                    <div class="text"><label for="">Email</label></div>
                    <input type="email" name="email" required><br>

                    <div class="text"><label for="">Type of Account</label></div>
                    <select name="type">
                        <option value="carnet">carnet</option>
                        <option value="chequier">chequier</option>
                    </select><br>

                    <div class="text"><label for="">Password</label></div>
                    <input type="password" name="password" required><br>

                    <button type="submit" name="submit">
                        login
                    </button>
                </form> 
                Don't have an account?<a href="signin.php" style="color:#ffeb3b; margin-top: 20px; ">Sign Up</a>
            </div>
        </div>
        
    </div>
</body>
</html>