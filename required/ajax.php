  <?php
  require("config.php");
  if (!isset($_COOKIE['id'])) {
    echo trim("notLoggedIn");
    exit();
  } else {
    $userId = grab($_COOKIE['id']);
    if (isset($_POST['productId']) && isset($_POST['addProduct'])) {
      $productId = grab(secure($_POST['productId']));
      $sql = "INSERT INTO `cart`(`userId`, `productId`) VALUES ($userId,$productId)";
      $result = $mysqli->query($sql);
      echo true;
      exit();
    } elseif (isset($_POST['productId']) && isset($_POST['removeProduct'])) {
      $productId = grab(secure($_POST['productId']));
      $sql = "DELETE FROM `cart` WHERE `userId` = $userId && `productId` = $productId";
      $result = $mysqli->query($sql);
      echo true;
      exit();
    } elseif (isset($_POST['cartCount'])) {
      $sql = "SELECT * FROM `cart` WHERE `userId`=$userId";
      $result = $mysqli->query($sql);
      echo $result->num_rows;
      exit();
    }
  }
