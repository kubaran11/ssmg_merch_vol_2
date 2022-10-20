<?php

require "connection.php";

function isUserInDB($username)
{
	$conn = $GLOBALS["conn"];

	$sql = "SELECT COUNT(username) FROM User WHERE username = ?";
	$stmt = $conn -> prepare($sql);
	$stmt -> bind_param("s", $username);
	$stmt -> execute();
	$stmt -> store_result();
	$stmt -> bind_result($count);
	$stmt -> fetch();

	if ($count == 1)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function getPasswordHashFromDB($username)
{
	$conn = $GLOBALS["conn"];

	if (isUserInDB($username))
	{
		$sql = "SELECT password FROM User WHERE username = ?";
		$stmt = $conn -> prepare($sql);
		$stmt -> bind_param("s", $username);
		$stmt -> execute();
		$stmt -> store_result();
		$stmt -> bind_result($hash);
		$stmt -> fetch();

		return $hash;
	}
	else
	{
		return false;
	}
}

function isUserAdmin($username)
{
	$conn = $GLOBALS["conn"];

	if (isUserInDB($username))
	{
		$sql = "SELECT permission FROM User WHERE username = ?";
		$stmt = $conn -> prepare($sql);
		$stmt -> bind_param("s", $username);
		$stmt -> execute();
		$stmt -> store_result();
		$stmt -> bind_result($permission);
		$stmt -> fetch();

		return $permission;
	}
	else
	{
		return false;
	}
}

?>