<!DOCTYPE html>
<html lang="en">
<?php require('required/config.php') ?>

<head>
    <?php require('required/header.php'); ?>
    <title>Cart</title>
</head>

<body class="">
    <?php require('required/navbar.php') ?>
    <main class="container">
        <div class="row mt-5">
            <div class="col-lg-10 offset-lg-1">
                <div class="card  mdb-color darken-1">
                    <div class="card-body">
                        <h1 class="white-text font-weight-bolder h1-responsive">Product's In Cart</h1>
                        <div class="container-flow table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr style="border-bottom: 2px solid white;">
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col" colspan="2">Total</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php
                                    if (isset($_COOKIE['id']) && isset($_COOKIE['name']) && isset($_COOKIE['email'])) {
                                        $sql = "SELECT * FROM `cart` WHERE `userId` =" . grab($_COOKIE['id']);
                                        $count = 0;
                                        $cartPrice = 0;
                                        $result = $mysqli->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) { ?>
                                                <?php
                                                $sql2 = "SELECT * FROM `products` WHERE `id` =" . $row['productId'];
                                                $result2 = $mysqli->query($sql2);
                                                while ($row2 = $result2->fetch_assoc()) {
                                                    $count++;
                                                    $cartPrice += $row2['price'];
                                                ?>
                                                    <tr class="my-3" id="removeFromCartPage<?= $row2['id'] ?>">
                                                        <td>
                                                            <?= $row2['name']  ?>
                                                        </td>
                                                        <td>
                                                            <img src="<?= $global ?>images/<?= $row2['photo'] ?>" alt="<?= $row2['name'] ?>" class="img-fluid" style="height: 7vh;">
                                                        </td>
                                                        <td>
                                                            <i class="fas fa-rupee-sign"></i> <?= $row2['price']  ?> x
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control p-0 pl-1 price" value="<?= $row['quantity']  ?>" min=1 style="height: 1.5em;" data-price=<?= $row2['price'] ?> data-dest='price<?= $row2['id'] ?>'>
                                                        </td>
                                                        <td>
                                                            <i class="fas fa-rupee-sign"></i> <span class='finalPrice' id="price<?= $row2['id'] ?>"><?= $row2['price'] ?></span>
                                                        </td>
                                                        <td>
                                                            <a class=" nav-link small" data-toggle="modal" data-target="#removeProduct<?= $row2['id'] ?>"><i class="fas fa-trash-alt white-text"></i></a>
                                                            <div class="modal fade mt-5 pt-3 " id="removeProduct<?= $row2['id'] ?>" tabindex="-1" role="dialog">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content transparent mt-5 w-100">
                                                                        <div class="modal-body text-center white px-lg-5">
                                                                            <button type="button" class="close noOutline" data-dismiss="modal" aria-label="Close" style="opacity: 1">
                                                                                <i class="fas fa-times-circle one-text"></i>
                                                                            </button>
                                                                            <p class="mt-5 one-text">Remove <br><?= $row2['name'] ?>? <br> You can always add it again from our product page. </p>
                                                                            <a type="button" class="removeFromCart btn-sm btn btn-block one removeFromCartPage" data-dismiss="modal" data-parent="removeFromCartPage<?= $row2['id'] ?>" data-product="<?= pass($row2['id']) ?>">Yes.</a>
                                                                            <!-- <button class="btn btn-block one white-text" name='addUser'>Confirm</button> -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                <?php } ?>
                                            <?php } ?>
                                            <tr class="py-2" style="border-top: 2px solid white;border-bottom: 2px solid white;">
                                                <td colspan="3">Amount</td>
                                                <td><span id="finalCount"><?= $count ?></span></td>
                                                <td colspan="2"><i class="fas fa-rupee-sign"></i> <span id="finalPrice"><?= $cartPrice ?></span></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">GST</td>
                                                <td>18%</td>
                                                <td colspan="2"><i class="fas fa-rupee-sign"></i> <span id="gstPrice"><?= number_format((float) ($cartPrice / 100) * 18, 2, '.', '') ?></span> ps.</td>
                                            </tr>
                                            <tr class="py-2" style="border-top: 2px solid white;border-bottom: 4px solid white;">
                                                <td colspan="3">Final Amount</td>
                                                <td>inlcuding 18% GST</td>
                                                <td colspan="2"><i class="fas fa-rupee-sign"></i> <span id="finalPriceWithGST"><?= number_format((float) (($cartPrice / 100) * 18) + $cartPrice, 2, '.', '') ?></span> ps.</td>
                                            </tr>
                                        <?php } else { ?>
                                            <tr class=" py-2" style="border-bottom: 4px solid white;">
                                                <td>
                                                    <h1 class="h1-responsive text-center">Your Cart is empty</h1>
                                                    <h4 class="h4 h4-responsive text-center"><a class='white-text' href="<?= $global ?>"><i class="fas fa-shopping-cart white-text"></i> Please Shop</a></h4>
                                                </td>
                                            </tr>
                                        <?php }
                                    } else { ?>
                                        <tr class="py-2" style="border-bottom: 4px solid white;">
                                            <td>
                                                <h1 class="h1-responsive text-center">PLease fill the following form to procced</h1>
                                                <h4 class="h4 h4-responsive text-center"><a data-toggle="modal" data-target="#popUpMessage" class='white-text'><i class="fas fa-shopping-cart white-text"></i>Start Shoping</a></h4>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <?php require('required/footer.php') ?>
</body>

</html>