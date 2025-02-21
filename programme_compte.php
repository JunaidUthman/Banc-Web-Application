<?php
session_start();
    if(empty($_SESSION["rib"])){
        header("location:login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Document</title>
</head>
<body>
    <div class="title"><h1>Welcome to Our Bank</h1></div>
    <div class="container">

        <div class="box">
            <h2>Withdraw Funds</h2>
            <form action="retirer.php" method="post">

                <label for="somme">Amount to Withdraw</label>
                <input type="number" name="somme" id="somme" required><br>

                <img div="images" src="images/pexels-goumbik-928181.jpg" >

                <input type="submit" name="submit" value="withdraw">
            </form>
        </div>

        <div class="box">
            <h2>Deposit Funds</h2>
            <form action="deposer.php" method="post">

                <label for="somme">Amount to Deposit</label>
                <input type="number" name="somme" id="somme" required><br>

                <img div="img" src="images/pexels-karolina-grabowska-4968639.jpg" >

                <input type="submit" name="submit" value="Deposit">
            </form>
        </div>

        <div class="box">
            <h2>My informations</h2>
            <form action="info.php" method="post">

                <label for="somme">Show my informations</label>

                <img class="img_3" src="images/pexels-rann-vijay-677553-7742551.jpg" >

                <input type="submit" name="submit" value="Show">
            </form>
        </div>
    </div>
</body>
</html>
