<!DOCTYPE html>
<html style="font-size: 16px;" lang="en"><head>
<title>My Cart</title>
<?php 
session_start();
include "include/header.php"; 

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}

require('config/connection.php');

?>

<section class="u-align-center u-border-2 u-border-black u-clearfix u-section-1" id="sec-99a1">
  <div class="u-clearfix u-sheet u-sheet-1">
    <a href="Shop.php" class="u-border-none u-btn u-btn-round u-button-style u-custom-color-4 u-hover-custom-color-2 u-radius-50 u-text-hover-black u-btn-1">Back to Shop</a>
    <h1 style="font-family: slab-serif; color: #ebdad0;"><b>My Cart</b></h1>
    <div class="u-expanded-width u-table u-table-responsive u-table-1">
      <table class="u-table-entity u-table-entity-1">
        <thead class="u-align-center u-custom-color-4 u-custom-font u-table-header u-text-body-alt-color u-text-font u-table-header-1">
          <tr style="height: 45px;">
            <th class="u-table-cell">Product</th>
            <th class="u-table-cell">Quantity</th>
            <th class="u-table-cell">Remove</th>
            <th class="u-table-cell">Price</th>
          </tr>
        </thead>
        <tbody class="u-align-left u-table-body">
          <?php
          $total = 0;
          foreach($_SESSION['cart'] as $product_id) {
              $product_id = mysqli_real_escape_string($conn, $product_id);
              $query = "SELECT * FROM product WHERE prodid = $product_id";
              $result = mysqli_query($conn, $query);
              while($product = mysqli_fetch_assoc($result)) {
                  $total += $product['price'];
          ?>
          <tr>
            <td class="u-border-2 u-border-grey-75 u-white u-table-cell" style="font-family: slab-serif;"><?php echo $product['pname']; ?></td>
            <td class="u-border-2 u-border-grey-75 u-white u-table-cell" style="text-align: center;">1</td>
            <td class="u-border-2 u-border-grey-75 u-white u-table-cell" style="text-align: center;"><a href="remove_from_cart.php?id=<?php echo $product['prodid']; ?>" class="u-border-none u-btn u-btn-round u-button-style u-hover-grey-5 u-radius-50 u-text-custom-color-5 u-white u-btn-3">X</a></td>
            <td class="u-border-2 u-border-grey-75 u-white u-table-cell" style="text-align: center;"><?php echo $product['price']; ?> SAR</td>
          </tr>
          <?php } } ?>
        </tbody>
      </table>
    </div>
    <p style="font-family: slab-serif; background-color: white;"><b>Subtotal: <?php echo $total; ?> SAR</b></p>
    <button class="u-border-none u-btn u-btn-round u-button-style u-custom-color-4 u-hover-custom-color-2 u-radius-50 u-text-hover-black u-btn-4" onclick="buyItems()">Buy Items</button>
  </div>
</section>

<?php include "include/footer.php" ?>

<script>
function buyItems() {
  var confirmation = confirm("Are you sure you want to buy these items?");
  if (confirmation) {
    alert("Enjoy your items!");

    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'clear_cart.php', true);
    xhr.onload = function () {
      if (xhr.status === 200) {
        location.reload(); 
      }
    }
    xhr.send();
  }
}
</script>

</body></html>
