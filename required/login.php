  <?php require("config.php");
  if (isset($_POST['loginButton'])) {
    $email = secure($_POST['username']);
    $password = secure($_POST['password']);
    $password = Encrypt($password);

    // Step 1: Email Verification
    $sql = "SELECT * FROM `admin` WHERE `email`='$email'";
    $result = $mysqli->query($sql);
    if ($row = $result->fetch_assoc()) {
      // Step 2: Password Verification
      $sql = "SELECT * FROM `admin` WHERE `email`= '$email' AND `password`='$password'";
      $pass_result = $mysqli->query($sql);
      if ($pass_row = $pass_result->fetch_assoc()) {
        $_SESSION['uid'] = $row['id'];
        $_SESSION['id'] = $row['role'];
        $_SESSION['name'] = $row['name'];
        gen_log('Logged In');
        header('location:../dashboard');
      } else {
        $_SESSION['flagPassword'] = 'Password is incorrect please try again.';
        gen_log("Unauthorize login using $email", 2);
        header('location:../login');
      }
    } else {
      $_SESSION['flagEmail'] = "$email is not an admin";
      gen_log("Unauthorize login using email $email and password " . $_POST['password'], 2);
      header('location:../login');
    }
  } else {
    $_SESSION['flagUnauthorise'] = "Please login to gain access.";
    gen_log("Unauthorize acces of files", 2);
    header('location:../login');
  }
  

  // $sql = "INSERT INTO `clients`
  // (`company_name`, `email`, `mobile`, `alternate_mobile`, `address`, `city`, `state`, `country`, `pincode`, `contact_person`, `landline`) VALUES
  // ('$faker->company','$faker->email','$faker->phoneNumber','$faker->phoneNumber','$faker->address','$faker->city','$faker->state','$faker->country','$faker->postcode','$faker->name','$faker->phoneNumber')";
  // $mysqli->query($sql);
