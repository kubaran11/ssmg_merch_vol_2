<?php

require "getProducts.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Products</title>
    
</head>
<body>

    <main>
        <div class="main-box">
            <div class="title">
                <h1>Produkty</h1>
            </div>
                    <div class="item-product">   
                        <?php 
                foreach(getProducts() as $product)
                { 
                if ($product["permission"] == 1) {
                ?>
                <div class="products-colum product-id<?= $product["id"]; ?>">
                    <img src="images/<?= $product["productimage"]; ?>" alt="<?= $product["productname"]; ?>">
                    <div class="layer">
                        <h3><?= $product["productname"]; ?></h3>
                        <div class="button-product">
                            <a href="#"><button>Koupit</button></a>
                        </div>
                    </div>
                </div>
                <?php 
                    }
                }
                ?>
                    </div>

                   
                    
        </div>
    </main>
</body>
</html>