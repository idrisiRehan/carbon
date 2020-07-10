$toastCount = 0;
$global = "http://localhost/carbon_ecomm/";
// $global = "http://igwebtakes.com/carbon/";
$(document).ready(function () {
  cartCount();
  if (sessionStorage.getItem("popUpMessage") === null)
    $("#popUpMessage").modal("show");
  $(".close").click(function () {
    sessionStorage.setItem("popUpMessage", "true");
  });
});

$(document.body).on("click", ".addToCart", function () {
  $productId = $(this).data("product");
  $this = $(this);
  if ($(this).hasClass("singleProduct"))
    $removeButton =
      "Remove From Cart  <i class='fas fa-trash-alt white-text'></i>";
  else $removeButton = "<i class='fas fa-trash-alt red-text'></i>";
  $.ajax({
    type: "post",
    data: {
      addProduct: true,
      productId: $productId,
    },
    url: $global + "required/ajax",
    success: function (result) {
      if (result.trim() == "notLoggedIn") {
        $("#popUpMessage").modal("show");
      } else {
        $($this)
          .removeClass("addToCart")
          .addClass("removeFromCart")
          .html($removeButton);
        cartCount();
        toaster("Product Added To Cart");
      }
    },
  });
});
$(document.body).on("click", ".removeFromCart", function () {
  $productId = $(this).data("product");
  $this = $(this);
  if ($(this).hasClass("singleProduct"))
    $removeButton = "Add To Cart <i class='fas fa-cart-plus white-text'></i>";
  else $removeButton = "<i class='fas fa-cart-plus one-text'></i>";
  $.ajax({
    type: "post",
    data: {
      removeProduct: true,
      productId: $productId,
    },
    url: $global + "required/ajax",
    success: function (result) {
      if (result.trim() == "notLoggedIn") {
        $("#popUpMessage").modal("show");
      } else {
        $($this)
          .removeClass("removeFromCart")
          .addClass("addToCart")
          .html($removeButton);
        cartCount();
        toaster("Product Removed From Cart");
      }
    },
  });

  if ($this.hasClass("removeFromCartPage")) {
    $parentId = $this.data("parent");
    $("#" + $parentId).slideUp();
    setTimeout(function () {
      $("#" + $parentId).remove();
    }, 500);
    setTimeout(function () {
      cartManager();
    }, 600);
  }
});
$(document.body).on("click change", ".price", function () {
  $count = $(this).val();
  $price = parseInt($(this).data("price"));
  $dest = $(this).data("dest");
  $("#" + $dest).text($count * $price);
  cartManager();
});

function toaster($msg) {
  $toastCount++;

  $("#toastContainer")
    .append(
      "<p class='alert alert" +
        $toastCount +
        " card p-1 special-color-dark white-text'>" +
        $msg +
        "</p>"
    )
    .css("z-index", "99999");
  setTimeout(function () {
    $(".alert" + $toastCount).fadeOut("slow");
  }, 1000);
  setTimeout(function () {
    $(".alert").fadeOut("slow");
    $("#toastContainer").css("z-index", "-99999");
  }, 3000);
}

function cartCount() {
  $.ajax({
    type: "post",
    data: {
      cartCount: true,
    },
    url: $global + "required/ajax",
    success: function (result) {
      if (result > 0) {
        $(".cartCount").html(result);
      } else if (result == 0) {
        $(".cartCount").html("0");
      }
    },
  });
}
function cartManager() {
  $finalPrice = 0;
  $finalCount = 0;
  $(".price").each(function () {
    $finalCount += parseInt($(this).val());
  });
  $("#finalCount").text($finalCount);
  $(".finalPrice").each(function () {
    $finalPrice += parseFloat($(this).text());
    console.log($finalPrice);
  });
  $("#finalPrice").text($finalPrice);
  $gstPRice = ($finalPrice / 100) * 18;
  $gstPRice = $gstPRice.toFixed(2);
  $("#gstPrice").text($gstPRice);
  $finalPRiceWithGST = parseFloat($finalPrice + ($finalPrice / 100) * 18);
  $finalPRiceWithGST = $finalPRiceWithGST.toFixed(2);
  $("#finalPriceWithGST").text($finalPRiceWithGST);
}
// $(document).ready(function () {
//   window.onscroll = function () {
//     myFunction();
//   };

//   var navbar = document.getElementById("navbar");
//   var sticky = navbar.offsetTop;
//   // var sticky = 750;

//   function myFunction() {
//     if (window.pageYOffset >= sticky) {
//       navbar.classList.add("sticky");
//     } else {
//       navbar.classList.remove("sticky");
//     }
//   }
// });
