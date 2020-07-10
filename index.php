<!DOCTYPE html>
<html lang="en">
<?php require('required/config.php') ?>

<head>
    <?php require('required/header.php') ?>
    <title>All Products</title>
</head>

<body class="">
    <?php require('required/navbar.php') ?>
    <main class="container">
        <div class="row">
            <?php $sql = "SELECT * FROM `products`";
            $result = $mysqli->query($sql);
            while ($row = $result->fetch_assoc()) { ?>
                <div class="col-lg-3 my-3">
                    <div class="card productCard" style="max-height: 40vh;">
                        <div class="text-center p-2">
                            <img src="<?= $global ?>images/<?= $row['photo'] ?>" alt="<?= $row['name'] ?>" style="height: 20vh;">
                            <a href='<?= $global ?><?= $row['slug'] ?>/' style="margin-right: 3vw;" type="button" class="btn btn-white btn-sm btn-floating px-1 py-2"><i class="fas fa-info one-text"></i></a>
                            <div class="shopButton<?= $row['id'] ?>">
                                <?php if (in_array($row['id'], $cart)) { ?>
                                    <button type="button" class="removeFromCart btn white btn-sm btn-floating px-1 py-1" data-product="<?= pass($row['id']) ?>"><i class="fas fa-trash-alt red-text"></i></button>
                                <?php } else { ?>
                                    <button type="button" class="addToCart btn white btn-sm btn-floating px-1 py-1" data-product="<?= pass($row['id']) ?>"><i class="fas fa-cart-plus one-text"></i></button>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="card-body p-0 pt-2 px-2  mdb-color darken-1  white-text">
                            <h6 class="card-title w-75"><a><?= $row['name'] ?></a></h6>
                            <p><i class="fas fa-rupee-sign"></i> <?= $row['price'] ?></p>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

    </main>
    <?php require('required/footer.php') ?>
</body>

</html>