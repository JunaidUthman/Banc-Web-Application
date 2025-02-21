<?php
    if(isset($_POST["submit"])){
        $type = $_POST["type"];
        $fullname=$_POST["fullname"];
        $solde=$_POST["solde"];
        $email=$_POST["email"];
        $password=$_POST["password"];

        $file = "data.json";

        $data = [];
        if (file_exists($file)) {
            $jsonData = file_get_contents($file);
            $data = json_decode($jsonData, true); 
        }
        $existed=0;
        foreach($data as $d){
            if($d["email"]==$email){
                $existed=1;
                break;
            }
        }
        if($existed==1){
            echo '<div class="message_error">The email you entered is already used.</div>';
        }
        else{
            if($type == "carnet"){
                require("class_compte_carnet.php");
                $c = new compte_carnet($email , $password ,$fullname , $solde);
                $rib=$c -> creer_compte();
                echo '<div class="message_success">Your account is successfully created, here is your CODE: '.$rib.'</div>';
            }
            if($type == "chequier"){
                require("class_compte_chequier.php");
                $c = new compte_chequier($email , $password ,$fullname , $solde);
                $rib=$c -> creer_compte();
                echo '<div class="message_success">Your account is successfully created, here is your CODE: '.$rib.'</div>';
            }
        }
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/signin.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="box">
            <div class="login_pic">
                <img class="login_img" src="images/pexels-polina-tankilevitch-6700403.jpg" alt="">
            </div>
            <div class="login_container">
                <h1 class="titre">Sign up</h1>
                <form action="signin.php" method="post">

                    <div class="text"><label for="">Full_Name</label></div>
                    <input type="text" name="fullname" required><br>

                    <div class="text"><label for="">Email</label></div>
                    <input type="email" name="email" required><br>

                    <div class="text"><label for="">Type of Account</label></div>
                    <select name="type" >
                        <option value="carnet">carnet</option>
                        <option value="chequier">chequier</option>
                    </select><br>

                    <div class="text"><label for="">Initial Balance</label></div>
                    <input type="number" name="solde" min="0" required><br>

                    <div class="text"><label for="">Password</label></div>
                    <input type="password" name="password" required><br>

                    <button type="submit" name="submit">
                        Sign up
                    </button>
                </form> 
                Do you have an account? <a href="login.php" style="color:#ffeb3b; margin-top: 20px; padding:20px ; ">Login</a>
            </div>
        </div>
        
    </div>
</body>
</html>