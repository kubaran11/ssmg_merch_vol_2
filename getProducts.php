<?php


require "conn.php";


function getProducts()

{

    $conn = $GLOBALS["conn"];

    $products = array();
    $sql = "SELECT id, productName, productImage, permission FROM Product";
    $stmt = $conn ->prepare($sql);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $productname, $productimage, $permission);
    while ($stmt->fetch())

    {
        array_push($products, array("id" => $id, "productname" => $productname, "productimage" => $productimage, "permission" => $permission));
    }

    return $products;

}