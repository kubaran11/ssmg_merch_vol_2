<?php
session_start();
if (!isset($_SESSION["id"]))
{
    header("Location:../index.php?message=Platnost vaší relace vypršela. Přihlašte se znovu.");
    die();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merch - administrace</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet"> 
</head>
<body>
    <header>
        <nav class="navigation">
            <a href="index.php">PŘEHLED</a>
            <a href="orders.php">OBJEDNÁVKY</a>
            <a href="products.php">KATALOG</a>
            <a href="new_user.php">UŽIVATELÉ</a>
        </nav>
    </header>
    <div class="main">
        <div class="main-title">
            <p>PŘEHLED</p>
        </div>
        <div class="inner-main">
            <p class="message">
                <?php if (isset($_GET["message"])) { echo $_GET["message"]; } ?>
            </p>
            <div class="main-box">
                <p>Vítejte do administrace</p>
            </div>
        </div>
    </div>
</body>
</html>