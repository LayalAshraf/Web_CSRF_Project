<?php
session_start();
require('config/connection.php');

if ($_POST){
  //Avoid CSRF attack
  if ($_SESSION["token"] != $_POST["token"]) {

    echo '<script type = "text/javascript">';
        echo 'alert ("Invalid token; possibility of CSRF attack!");';
        echo 'window.location.href = "User-Profile.php" ';
        echo '</script>';
        exit();
        die ("");
   }
  }
  
   // generate tokens
   $_SESSION["token"] = md5(uniqid(mt_rand(),true));
	//echo $_SESSION["token"];
	
//create a query
    $query = 'SELECT * FROM comment';

    //get result 
    $result = mysqli_query($conn, $query);  

if (isset($_POST['add_comment'])) {
    $name=$_POST["name"];
    $sanitizeName = filter_var($name,FILTER_SANITIZE_STRING);
   
    $email=$_POST["email"];
    $sanitizeMail = filter_var($email,FILTER_SANITIZE_EMAIL);

    $comment= $_POST["comment"];
    $sanitizeComment = filter_var($comment,FILTER_SANITIZE_STRING);
    
if(isset($name,$email,$comment))
{
    $sql = "INSERT into comment (name,email,comment) VALUES(?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $sanitizeName, $sanitizeMail, $sanitizeComment);
    $res  = $stmt->execute();
}


if (!$res) {

    die("Couldn't add your comment".$mysqli->error);

}


echo '<script type = "text/javascript">';
      echo 'alert ("Comment Added Successfully!");';
      echo 'window.location.href = "About.php" ';
      echo '</script>';
      }
      ?>
      

<!DOCTYPE html>
<html style="font-size: 16px;" lang="en"><head>
    <title>About</title>
<?php include "include/header.php" ?>


    <section class="u-clearfix u-image u-shading u-section-1" id="sec-56d0" data-image-width="3840" data-image-height="2400">
      <div class="u-clearfix u-sheet u-sheet-1">
        <h2 class="u-align-center u-custom-font u-text u-text-default u-text-white u-text-1">About the <span class="u-text-custom-color-1">MUSIC HOUSE</span>
        </h2>
        <div class="u-align-justify u-black u-container-style u-group u-opacity u-opacity-50 u-radius-9 u-shape-round u-group-1">
          <div class="u-container-layout u-container-layout-1">
            <p class="u-text u-text-default u-text-2"> The Music House is a guitar store that caters specifically to musicians of all levels. We stand out with our top-of-the-line selection of guitars, amps, and accessories, all hand-picked and tested by experienced musicians. Whether you're a beginner looking for your very first guitar, or a seasoned professional in need of an upgrade.</p>
          </div>
        </div>
      </div>
      <div class="u-clearfix u-sheet u-sheet-1">
        <h2 class="u-align-center u-custom-font u-text u-text-default u-text-white u-text-1">Feedbacks of <span class="u-text-custom-color-1">Our Website</span>
        </h2>
        <div class="u-align-justify u-black u-container-style u-group u-opacity u-opacity-50 u-radius-9 u-shape-round u-group-1">
          <div class="u-container-layout u-container-layout-1">
            
            
            
            <section>
            <div class="u-black u-container-style u-expanded-width u-group u-opacity u-opacity-30 u-group-1">
            <div class="u-container-layout u-container-layout-1">
            <div class="u-form u-form-1">
            <form method="POST" class="u-clearfix u-form-spacing-15 u-inner-form" style="padding: 15px;">
              <div class="u-form-email u-form-group u-label-none">
              <input type="text" placeholder="Name" id="email-6797" name="name" class="u-custom-color-3 u-input u-input-rectangle u-radius-17 u-input-2" required="">
              </div>
              <br>
              <div class="u-form-group u-label-none u-form-group-3">
                <input type="email" placeholder="Email" id="text-c901" name="email" class="u-custom-color-3 u-input u-input-rectangle u-radius-17 u-input-3">
              </div>
              <br>
              <div class="u-form-group u-label-none u-form-group-4">
                <textarea id="subject" name="comment" placeholder="Write something.." class="u-custom-color-3 u-input u-input-rectangle u-radius-17 u-input-3"></textarea>
              </div>
              <div class="u-align-center u-form-group u-form-submit">
              
                <input type="hidden" name="token" value="<?=$_SESSION["token"]?>">
                
                <button type="submit" class="u-btn u-btn-round u-button-style u-custom-color-1 u-radius-5 u-btn-1" name="add_comment" value="clicked">Add Comment</button>
              </div>
              <div class="u-form-send-message u-form-send-success">Thank you! Your message has been sent.</div>
              <div class="u-form-send-error u-form-send-message">Unable to send your message. Please fix errors then try again.</div>
            </form>
          </div>
        </div>
      </div>
      <h3 style="color:#ebdad0"><u><b><center> Comments </center></b></u></h3>
      <?php
    // Create Connection
    $connect = mysqli_connect('localhost', 'root', '1234', 'Music_House'); 

    // Check Connection
    if(mysqli_connect_errno()){
        // Connection Failed
        echo 'Failed to connect to MySQL '. mysqli_connect_errno();
    }
    
    $qry=mysqli_query($connect , "SELECT * FROM comment");
    while($result=mysqli_fetch_array($qry))
	{
	?>
	
	<div>
		<div class="u-container-layout u-similar-container u-container-layout-1">
			<?php
		   	   echo "<br>";

			?>
			<h1 style="font-size: 30px; color: #fff;"> <?php echo $result["name"]; ?> | <?php echo $result["email"];  ?></h1>
			<form method="post">
				<p style="font-size: 20px; color: #ebdad0;"><?php echo $result["comment"];  ?></p>
			</form>
        	      </div>
        </div>
        <p style="font-size: 20px; color: #fff;">-----------------------------------------------------------------</p>
	<?php
	 }
	?>
          
    </section>

          </div>
        </div>
      </div>
    </section>
        
<?php include "include/footer.php" ?>
  
</body></html>
