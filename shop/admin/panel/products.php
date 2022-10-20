
<?php
session_start();

if (isset($_POST["updateProduct"]))
{
    
    require "../connection.php";

    $productId = $_POST["productId"];
    $permission = $_POST["updateProduct"];

    $sql = "UPDATE `Product` SET `permission` = ".$permission." WHERE `Product`.`id` = ".$productId."";
   
    $stmt = $conn -> prepare($sql);
    $stmt -> execute();
    $stmt->close();
}

if (isset($_POST["addProduct"]))
{
    require "../connection.php";

    $error = "none";
    $success = "none";

    $target_dir = "../../../shop/images/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
    }
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        $error = "Produkt nebyl založen protože dostupné jsou pouze JPG, JPEG, PNG & GIF formáty";
        $uploadOk = 0;
    }

    $productName = $_POST["productName"];
    $productNameEmpty = FALSE;
    if ($productName == "") {
        $productNameEmpty = TRUE;
    }
    $fileName = basename($_FILES["fileToUpload"]["name"]);
    if (isset($_POST["permission"])) {
        $permission = 1;
    } else {
        $permission = 0;
    }

    if ($uploadOk == 0 || $productNameEmpty) {
        $error = "Obrázek nebyl nahrán a produkt nebyl založen";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $success = "Soubor ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " byl nahrán a produkt založen";

            $sql = "INSERT INTO `Product` (`id`, `productName`, `productImage`, `permission`) VALUES (NULL, '".$productName."', '".$fileName."', '".$permission."'); ";
            $stmt = $conn -> prepare($sql);
            $stmt -> execute();
            $stmt->close();
        } else {
            $error = "Obrázek nebyl nahrán a produkt nebyl založen";
        }
    }
}

require "getProducts.php";

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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet"> 
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
                <?php if (isset($_POST["addProduct"]) && $success != "none") { ?>
                <p class="success"><?= $success ?></p>
                <?php } ?>
                <div class="newProduct <?php if (isset($_POST["addProduct"]) && $error != "none") { echo " active error";} ?>" id="addProductFormCont">
                <?php if (isset($_POST["addProduct"]) && $error != "none") { ?>
                <p><?= $error ?></p>
                <?php } ?>
                <form action="products.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="addProduct" value="1">

                    <label>
                        Obrázek:
                        <input type="file" name="fileToUpload" id="fileToUpload">
                    </label>

                    <label>
                        Jméno:
                        <input type="text" name="productName" id="productName">
                    </label>

                    <label>
                        Viditelnost:
                        <input type="checkbox" name="permission" id="permission" checked>
                    </label>
                    
                    <button type="submit" class="show" id="showAddProductForm">Přidat produkt</button>
                </form>
            </div>
                <?php
                foreach(getProducts() as $product)
                { 
                ?>
                <div class="products-row product-id<?= $product["id"]; if ($product["permission"] == 0) { echo " inactive"; }; ?>">
                    <img class="product-image" src="../../../shop/images/<?= $product["productimage"]; ?>" alt="<?= $product["productname"]; ?>">
                    <div class="layer">
                        <h3><?= $product["productname"]; ?></h3>
                    </div>
                    <div class="action">
                        <form action="products.php" method="post">
                            <input type="hidden" name="productId" value="<?= $product["id"]; ?>">
                            <?php if ($product["permission"] == 1) { ?>
                            <input type="hidden" name="updateProduct" value="0">
                            <button type="submit" class="hide">Skrýt</button>
                            <?php } else { ?>
                            <input type="hidden" name="updateProduct" value="1">
                            <button type="submit" class="show">Zobrazit</button>
                            <?php } ?>
                        </form>
                    </div>
                </div>
                <?php     
                }
                ?>
                </div>
            </div>
        </div>
    </div>
    <script src="products.js" type="text/javascript"></script>
</body>
</html>