<!DOCTYPE html>
<html lang="en">
<?php require('required/config.php') ?>

<head>
    <?php require('required/header.php');
    if (isset($_GET['product'])) {
        $product = $_GET['product'];
        $sql = "SELECT * FROM `products` WHERE `slug`= '$product'";
        $result = $mysqli->query($sql);
        $result_rows = $result->num_rows;
        if ($result_rows > 0) {
            if ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $name = $row['name'];
                $description = $row['description'];
                $price = $row['price'];
                $photo = $row['photo'];
            }
        } else {
            header('location:' . $global . 'index');
            exit();
        }
    }

    ?>
    <title><?= $name ?></title>
</head>

<body class="">
    <?php require('required/navbar.php');    ?>
    <main class="container my-2">
        <div class="row">
            <div class="col-lg-6 mt-5">
                <img src="<?= $global ?>images/<?= $photo ?>" alt="$name" class="img-fluid">
            </div>
            <div class="col-lg-6 white-text">
                <div class="container-fluid my-5">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="h3-responsive"><?= $name ?></h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">Description</div>
                        <div class="col-lg-9"><?= $description ?></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">Price</div>
                        <div class="col-lg-9"><?= $price ?></div>
                    </div>
                    <div class="row pt-5 shopButton<?= $id ?>">
                        <div class="col-lg-12">

                            <?php if (in_array($id, $cart)) { ?>
                                <button class="removeFromCart singleProduct btn btn-block  mdb-color darken-1" data-parent="shopButton<?= $id ?>" data-product="<?= pass($id) ?>">Remove From Cart <i class="fas fa-trash-alt white-text"></i></button>
                            <?php } else { ?>
                                <button class="addToCart singleProduct btn btn-block  mdb-color darken-1" data-parent="shopButton<?= $id ?>" data-product="<?= pass($id) ?>">Add To Cart <i class="fas fa-cart-plus"></i></button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php $sql = "SELECT * FROM `products` LIMIT 4";
            $result = $mysqli->query($sql);
            while ($row = $result->fetch_assoc()) { ?>
                <div class="col-lg-3 my-3">
                    <div class="card productCard" style="max-height: 40vh;">
                        <div class="text-center p-2">
                            <img src="<?= $global ?>images/<?= $row['photo'] ?>" alt="<?= $row['name'] ?>" style="height: 20vh;">
                            <a href='<?= $global ?><?= $row['slug'] ?>/' style="margin-right: 3vw;" type="button" class="btn btn-white btn-sm btn-floating px-1 py-2"><i class="fas fa-info  one-text"></i></a>
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