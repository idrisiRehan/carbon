<nav class="navbar navbar-expand-lg navbar-dark  mdb-color darken-1" id="navbar">
    <a href="<?= $global ?>" class="navbar-brand" href="<?= $global ?>">Carbon Ecommerce </a>
    <a href="<?= $global ?>cart" class="mobileCart"><i class="fas fa-shopping-cart white-text"></i> <sup class='cartCount white-text'></sup></a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobileNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mobileNavbar">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?= $global ?>">All Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= $global ?>cart">Cart</a>
            </li>
            <?php if (!isset($_COOKIE['id']) && !isset($_COOKIE['name']) && !isset($_COOKIE['email'])) { ?>

                <li class="nav-item">
                    <a class="nav-link small" data-toggle="modal" data-target="#popUpMessage">You Are?</a>
                </li>
            <?php } ?>
            <?php
            $cart = array();
            if (isset($_COOKIE['id']) && isset($_COOKIE['name']) && isset($_COOKIE['email'])) {
                $sql = "SELECT * FROM `cart` WHERE `userId` =" . grab($_COOKIE['id']);
                $result = $mysqli->query($sql);
                $cart_rows = $result->num_rows;
                if ($cart_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        array_push($cart, $row['productId']);
                    }
                }
            ?>
                <li class="nav-item">
                    <a class="pb-0 nav-link"><?= $_COOKIE['name'] ?></a>
                    <a class="p-0 nav-link small" data-toggle="modal" data-target="#popUpMessage">Not <?= $_COOKIE['name'] ?>?</a>
                </li>
                <li class="nav-item pt-2 ml-5 pcCart">
                    <a href="<?= $global ?>cart"><i class="fas fa-shopping-cart white-text"></i> <sup class='cartCount white-text'></sup></a>
                </li>
            <?php } ?>
        </ul>
    </div>
</nav>
<?php
if (isset($_POST['addUser'])) {
    $name = secure($_POST['fullName']);
    $email = secure($_POST['email']);
    $sql = "INSERT INTO `users`(`name`, `email`) VALUES ('$name','$email')";
    $result = $mysqli->query($sql);
    $sql = "SELECT * FROM `users` WHERE `email`= '$email'";
    $result = $mysqli->query($sql);
    if ($row = $result->fetch_assoc()) {
        setcookie('id', pass($row['id']), time() + (86400 * 30), "/");
        setcookie('name', $row['name'], time() + (86400 * 30), "/");
        setcookie('email', $row['email'], time() + (86400 * 30), "/");
        echo "<script>window.location.assign(document.referrer);</script>";
    }
}
// print_r($cart);
?>
<div class="modal fade mt-5 pt-3 " id="popUpMessage" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content transparent mt-5 z-depth-0">
            <div class="modal-body text-center white px-5">
                <button type="button" class="close noOutline mr-2" data-dismiss="modal" aria-label="Close" style="opacity: 1">
                    <i class="fas fa-times-circle one-text"></i>
                </button>
                <form action="" class=" px-lg-5" method="POST">
                    <p class="text-left">Welcom to Carbon Paper's E-Commerce, please fill the following data for best service experience.</p>
                    <div class="md-form">
                        <input type="text" class="form-control" id="name" name="fullName">
                        <label for="fullName">Name</label>
                    </div>
                    <div class="md-form">
                        <input type="text" class="form-control" id="email" name="email">
                        <label for="email">Email</label>
                    </div>
                    <button class="btn btn-block one white-text" name='addUser'>Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="toastContainer">

</div>
<!-- <a href="<?= $global ?>cart" class="fabMain btn btn-sm btn-floating z-depth-0"><i class="fas fa-shopping-cart white-text fa-3x"></i> <sup class='cartCount'></sup></a> -->