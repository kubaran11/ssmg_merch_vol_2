<?php
session_start();
if (!isset($_SESSION["id"]))
{
    header("Location:index.php?message=Platnost vaší relace vypršela. Přihlašte se znovu.");
    die();
}

require "../connection.php";

$username = "";

if (isset($_POST["username"]))
{
    $username = $_POST["username"];
}

$sql = "DELETE FROM User WHERE username = ?";
$stmt = $conn -> prepare($sql);
$stmt -> bind_param("s", $username);
$stmt -> execute();
$stmt->close();
header("Location:new_user.php?message=Uživatel $username byl odebrán.");

?>