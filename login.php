<!DOCTYPE html>
<html lang="en">
<?php require('required/config.php') ?>

<head>
    <?php require('required/header.php'); ?>
    <title>Cart</title>
</head>

<body class="">
    <?php require('required/navbar.php') ?>
    <main class="container my-2">
        <div class="row mt-5">
            <div class="col-lg-6 offset-lg-3 mt-5">
                <form class="p-5 card-body" action="required/login" method="POST">
                    <h1 class="white-text h1-responsive text-center">Login</h1>
                    <?php
                    if (isset($_SESSION['flagUnauthorise'])) {
                        echo "<p class='h6 m-0 mb-2 text-center red darken-4 white-text p-0'>" . $_SESSION['flagUnauthorise'] . "</p>";
                        unset($_SESSION['flagUnauthorise']);
                    }
                    ?>
                    <?php
                    if (isset($_SESSION['flagLogout'])) {
                        echo "<p class='h6 m-0 mb-2 text-center white-text p-3'><i class='far fa-smile-wink'></i> " . $_SESSION['flagLogout'] . "</p>";
                        unset($_SESSION['flagLogout']);
                    }
                    ?>
                    <!-- <p class="h4 mb-4 text-center one white-text p-3">Login</p> -->
                    <?php
                    if (isset($_SESSION['flagEmail'])) {
                        echo "<p class='h6 m-0 mb-2 text-center red-text p-3'><i class='far fa-meh-blank'></i> " . $_SESSION['flagEmail'] . "</p>";
                        unset($_SESSION['flagEmail']);
                    }
                    ?>
                    <input type="email" class="form-control mb-4" placeholder="E-mail" name="username" autocomplete="none" required>
                    <?php
                    if (isset($_SESSION['flagPassword'])) {
                        echo "<p class='h6 m-0 mb-2 text-center red-text p-3'><i class='far fa-meh-rolling-eyes'></i> " . $_SESSION['flagPassword'] . "</p>";
                        unset($_SESSION['flagPassword']);
                    }
                    ?>
                    <input required type="password" class="form-control mb-4 float-left" placeholder="Password" name="password" autocomplete="none" style="width:85%;display:inline" id="feedPassword">
                    <a class="showHidePassword pl-3 float-right pt-1" type="button" class="waves-light">
                        <i class="fas fa-eye white-text "></i>
                        <i class="fas fa-eye-slash white-text "></i>
                    </a>

                    <button class="btn mdb-color darken-1 white-text btn-block my-4" type="submit" name="loginButton"><i class="fas fa-door-closed"></i> Sign in</button>

                </form>
            </div>
        </div>


    </main>
    <?php require('required/footer.php') ?>
    <script type="text/javascript">
        $(".showHidePassword .fa-eye-slash").toggle();
        $(".showHidePassword").click(function() {
            $(".showHidePassword .fa-eye").toggle();
            $(".showHidePassword .fa-eye-slash").toggle();
            let state = $("#feedPassword").attr("type");
            if (state == "password") $("#feedPassword").attr("type", "text");
            else if (state == "text") $("#feedPassword").attr("type", "password");
        });
    </script>
</body>

</html>