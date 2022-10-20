<?php
session_start();

if (!isset($_SESSION["id"]))
{
    header("Location:../index.php?message=Neexistující Přihlášní");
    die();
}

require "../connection.php";

$username = "";
$password = "";
$mail = "";
$permission = 0;

if (isset($_POST["username"]))
{
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $mail = $_POST["mail"];
    $permission = $_POST["permission"];
}

$sql = "INSERT INTO User(username, password, mail, permission) VALUES (?,?,?,?)";
$stmt = $conn -> prepare($sql);
$stmt -> bind_param("sssi", $username, $password, $mail, $permission);
$stmt -> execute();
$stmt->close();

header("Location:index.php");


?>