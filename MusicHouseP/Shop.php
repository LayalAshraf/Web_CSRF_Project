<?php
	session_start();
require('config/connection.php');

if(!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    array_push($_SESSION['cart'], $_POST['product_id']);
}

    //create a query
    $query = 'SELECT * FROM product';

    //get result 
    $result = mysqli_query($conn, $query);    
?>

<!DOCTYPE html>
<html style="font-size: 16px;" lang="en"><head>
    <title>Shop</title>
<?php include "include/shopHeader.php" ?> 

<section class="u-align-center u-clearfix u-custom-color-2 u-section-1" id="sec-16f0">
      <div class="u-clearfix u-sheet u-sheet-1">
        <h3 class="u-custom-font u-font-lobster u-text u-text-default u-text-1">Shop Guitars</h3><!--products--><!--products_options_json--><!--{"type":"Recent","source":"","tags":"","count":""}--><!--/products_options_json-->
        <div class="u-expanded-width u-layout-grid u-products u-products-1">
          <div class="u-repeater u-repeater-1"><!--product_item-->
<?php
    // Create Connection
    $connect = mysqli_connect('localhost', 'root', '1234', 'Music_House'); 

    // Check Connection
    if(mysqli_connect_errno()){
        // Connection Failed
        echo 'Failed to connect to MySQL '. mysqli_connect_errno();
    }
	$qry=mysqli_query($connect , "SELECT * FROM product");
while($result=mysqli_fetch_array($qry))
{
?>
    
            <div class="u-align-left u-container-style u-products-item u-repeater-item u-white u-repeater-item-1">
              <div class="u-container-layout u-similar-container u-container-layout-1"><!--product_image-->
<?php
echo '<center><img src="data:image/jpeg;base64,'.base64_encode($result['img'] ).'" height="250" width="200"/></center>';
   echo "<br>";

?>
<!--/product_image-->
                <center><h1 class="u-custom-font u-font-merriweather u-text u-title u-text-2"> <?php echo $result["pname"]; ?> </center></h1>
                <p class="u-text u-text-custom-color-4 u-text-default u-text-3"><?php echo $result["price"];  ?> SAR</p>
                <form method="post">
				<input type="hidden" name="product_id" value="<?php echo $result['prodid']; ?>">
				<button type="submit" class="u-border-2 u-border-custom-color-4 u-btn u-button-style u-hover-custom-color-4 u-none u-product-control u-text-custom-color-4 u-text-hover-white u-btn-1">Add to Cart</a>
				</form>
              </div>
            </div>
<?php
 }
?>

   
      </div>
    </section>
    
<?php include "include/footer.php" ?>
  
</body></html>
