<?php

require "sql.php";

session_start();
$hash = "";
if (isset($_POST["psw"]))
{
    if (password_verify($_POST["psw"], getPasswordHashFromDB($_POST["uname"])))
    {
        $_SESSION["id"] = $_POST["uname"];
        $_SESSION["admin"] = isUserAdmin($_POST["uname"]);
        header("Location:panel/index.php");
        die();
    }
    else
    {
        header("Location:index.php?message=Neplatné uživatelské jméno nebo heslo!");
        die();
    }
}


?>