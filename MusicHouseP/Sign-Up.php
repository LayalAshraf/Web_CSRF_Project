<?php
session_start();

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
	
?>


<!DOCTYPE html>
<html style="font-size: 16px;" lang="en"><head>
    <title>Sign Up</title>
<?php include "include/header.php" ?>

    <section class="u-clearfix u-image u-shading u-section-1" id="sec-3eb8" data-image-width="3840" data-image-height="2400">
      <div class="u-black u-container-style u-expanded-width u-group u-opacity u-opacity-30 u-group-1">
        <div class="u-container-layout u-container-layout-1">
          <h2 class="u-align-center u-custom-font u-text u-text-custom-color-1 u-text-default u-text-1">Sign Up</h2>
          <div class="u-form u-form-1">
            <form method="POST" action="sign.php" class="u-clearfix u-form-spacing-15 u-inner-form" style="padding: 15px;">
              <div class="u-form-group u-form-name u-label-none">
                <label for="name-6797" class="u-label">Name</label>
                <input type="text" placeholder="Username" id="name-6797" name="name" class="u-custom-color-3 u-input u-input-rectangle u-radius-17 u-input-1" required="">
              </div>
              <div class="u-form-email u-form-group u-label-none">
                <label for="email-6797" class="u-label">Email</label>
                <input type="email" placeholder="Email" id="email-6797" name="email" class="u-custom-color-3 u-input u-input-rectangle u-radius-17 u-input-2" required="">
              </div>
              <div class="u-form-group u-label-none u-form-group-3">
                <label for="text-c901" class="u-label">Input</label>
                <input type="password" pattern="(?=.*[A-Z]).{5,}" title="Password must contain at least one uppercase latter and at least 5 or more characters" placeholder="Password" 
           		id="text-c901" name="pass" class="u-custom-color-3 u-input u-input-rectangle u-radius-17 u-input-3">
              </div>
              <div class="u-form-group u-label-none u-form-group-4">
                <label for="text-3616" class="u-label">Input</label>
                <input type="password" placeholder="Repeated Passowrd" id="text-3616" name="cpass" class="u-custom-color-3 u-input u-input-rectangle u-radius-17 u-input-4">
              </div>
              <div class="u-align-center u-form-group u-form-submit">
                              <input type="hidden" name="token" value="<?=$_SESSION["token"]?>">
                <button type="submit" class="u-btn u-btn-round u-button-style u-custom-color-1 u-radius-5 u-btn-1" name="signup_user" value="clicked">Create Account</button>
              </div>
              <div class="u-form-send-message u-form-send-success">Thank you! Your message has been sent.</div>
              <div class="u-form-send-error u-form-send-message">Unable to send your message. Please fix errors then try again.</div>
            </form>
          </div>
        </div>
      </div>
    </section>
    
    
<?php include "include/footer.php" ?>
  
</body></html>
