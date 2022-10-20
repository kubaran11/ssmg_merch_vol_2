<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;700&display=swap" rel="stylesheet">

<?php
session_start();

if (!isset($_SESSION["id"]))
{
    header("Location:../index.php?message=Neexistující nebo vypršené přihlášení.");
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
            <p>PŘIDAT NOVÉHO UŽIVATELE</p>
        </div>
        <div class="inner-main">
            <p class="message">
                <?php if (isset($_GET["message"])) { echo $_GET["message"]; } ?>
            </p>
            <div class="main-box">
                <form action="add_new_user.php" method="post">
                    <div class="form">
                        <input type="text" placeholder="Uživatelské jméno" name="username" required>
                        <input type="password" name="password" placeholder="Heslo" required>
                        <input type="mail" name="mail" placeholder="E-mail" required>
                    </div>
                    <div class="input">
                        <label for="user"><h3> User</h3></label> <input type=radio id="user" name=permission value=1 required>
                        <label for="admin"><h3> Admin</h3></label> <input type=radio id="admin" name=permission value=2 required>
                        <div class="buttons">
                            <button type="submit">Přidat uživatele</button>
                        </div>
                    </div>
                </form>
                <form action="remove_user.php" method="post">
                    <input type="text" placeholder="Uživatelské jméno" name="username">

                    <button type="submit">Odebrat uživatele</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>