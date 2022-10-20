<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merch - přihlášení</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <main>
        <form action="validate.php" method="post">
            <label for="uname">
                Uživatelské jméno
            </label>
            <input type="text" name="uname" required>
            <label for="psw">
                Heslo
            </label>
            <input type="password" name="psw" required>
            <p class="message">
                <?php if (isset($_GET["message"])) { echo $_GET["message"]; } ?>
            </p>
            <button type="submit">
                Přihlásit se
            </button>
        </form>
    </main>
</body>
</html>