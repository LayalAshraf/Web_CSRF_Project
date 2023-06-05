<?php 

session_start();
include('config/connection.php');

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
	// echo $_SESSION["token"];

$username = $_SESSION['username'];

// Fetch the current user data from the database
$query = "SELECT * FROM customer WHERE Cusr = '$username'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);


// CHANGE USERNAME
if (isset($_POST['change'])) {
    $newUsername = mysqli_real_escape_string($conn, $_POST['newUsername']);
    $confirmNewUsername = mysqli_real_escape_string($conn, $_POST['confirmNewUsername']);


  // Check if username or email already exists in the customer table
    $query = "SELECT * FROM customer WHERE Cusr = '$username'";
    $result = mysqli_query($conn, $query);

	if(mysqli_num_rows($result) > 1) {
        // If a row is found with the username or email, then it is already taken
        echo '<script type = "text/javascript">';
        echo 'alert ("Username is already taken! Try Again.");';
	echo 'window.location.href = "User-Profile.php" ';
        echo '</script>';
        exit();
    } else {

	    // Confirm new usernames match
	    if ($newUsername != $confirmNewUsername) {
		echo '<script type = "text/javascript">';
		echo 'alert ("New usernames do not match! Try Again.");';
		echo 'window.location.href = "User-Profile.php" ';
		echo '</script>';
		exit();
	    }

	    $query = "UPDATE customer SET Cusr = '$newUsername' WHERE Cusr = '$username'";

	}

// CHANGE PASSWORD
    $newPassword = mysqli_real_escape_string($conn, $_POST['newPassword']);
    $confirmNewPassword = mysqli_real_escape_string($conn, $_POST['confirmNewPassword']);

    // Fetch the current user password from database
    $queryp = "SELECT password FROM customer WHERE Cusr = '$username'";
    $resultp = mysqli_query($conn, $queryp);
    $userp = mysqli_fetch_assoc($resultp);
    $currentUserPassword = $userp['password'];

    // Confirm new passwords match
    if ($newPassword != $confirmNewPassword) {
        echo '<script type = "text/javascript">';
        echo 'alert ("New passwords do not match! Try Again.");';
        echo 'window.location.href = "User-Profile.php" ';
        echo '</script>';
        exit();
    }
    
 // hash the password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    
    $queryp = "UPDATE customer SET password = '$hashedPassword' WHERE Cusr = '$username'";

    if (mysqli_query($conn, $queryp) and mysqli_query($conn, $query)) {
        echo '<script type = "text/javascript">';
        echo 'alert ("Username/Password successfully changed!");';
        echo 'window.location.href = "User-Profile.php" ';
        echo '</script>';
        exit();
    } else {
        echo '<script type = "text/javascript">';
        echo 'alert ("Something went wrong! Try Again.");';
        echo 'window.location.href = "User-Profile.php" ';
        echo '</script>';
        exit();
    }
}

?>

  

<!DOCTYPE html>
<html style="font-size: 16px;" lang="en"><head>
    <title>User Profile</title>
<?php include "include/UserHeader.php" ?>

    <section class="u-align-center u-clearfix u-section-1" id="carousel_2d55">
      <div class="u-clearfix u-sheet u-sheet-1">
        <h2 class="u-custom-font u-font-merriweather u-text u-text-default u-text-1" style="color: #ebdad0;">Hello <?php echo $username; ?></h2>
        <div class="u-container-style u-custom-color-2 u-group u-group-1">
          <div class="u-container-layout u-container-layout-1">
            <div class="u-tab-links-align-center u-tabs u-tabs-1">
              <ul class="u-spacing-10 u-tab-list u-unstyled" role="tablist">
                <li class="u-tab-item u-tab-item-1" role="presentation">
                  <a class="active u-active-custom-color-4 u-button-style u-tab-link u-text-active-white u-text-body-alt-color u-tab-link-1" id="link-tab-14b7" href="#tab-14b7" role="tab" aria-controls="tab-14b7" aria-selected="true">User Information</a>
                </li>
                <li class="u-tab-item u-tab-item-2" role="presentation">
                  <a class="u-active-custom-color-4 u-button-style u-tab-link u-text-active-white u-text-body-alt-color u-tab-link-2" id="link-tab-0da5" href="#tab-0da5" role="tab" aria-controls="tab-0da5" aria-selected="false">Change Information</a>
                </li>
              </ul>
              <div class="u-tab-content">
                <div class="u-align-left u-container-style u-shape-rectangle u-tab-active u-tab-pane u-tab-pane-1" id="tab-14b7" role="tabpanel" aria-labelledby="link-tab-14b7">
                  <div class="u-container-layout u-container-layout-2">
                    <h5 class="u-text u-text-default u-text-2">
                      <span class="u-text-body-color">Information</span>
                    </h5>
                    <div class="u-border-3 u-border-white u-line u-line-horizontal u-line-1"></div>
                    <div class="u-table u-table-responsive u-table-1">
                      <table class="u-table-entity">
                        <colgroup>
                          <col width="32.7%">
                          <col width="67.3%">
                        </colgroup>
                        <tbody class="u-table-body u-text-body-color u-table-body-1">
                          <tr style="height: 46px;">
                            <td class="u-border-1 u-border-no-left u-border-no-right u-border-white u-table-cell">User ID</td>
                            <td class="u-border-1 u-border-no-left u-border-no-right u-border-white u-table-cell u-table-cell-2"><?php echo $user['CID']; ?></td>
                          </tr>
                          <tr style="height: 46px;">
                            <td class="u-border-1 u-border-no-left u-border-no-right u-border-white u-table-cell">Username</td>
                            <td class="u-border-1 u-border-no-left u-border-no-right u-border-white u-table-cell u-table-cell-4"><?php echo $user['Cusr']; ?></td>
                          </tr>
                          <tr style="height: 46px;">
                            <td class="u-border-1 u-border-no-left u-border-no-right u-border-white u-table-cell">Email</td>
                            <td class="u-border-1 u-border-no-left u-border-no-right u-border-white u-table-cell u-table-cell-6"><?php echo $user['email']; ?></td>
                          </tr>
                        </tbody>
                      </table>
                      <br>
                    </div>
                    <br>
                  </div>
                </div>
                <div class="u-container-style u-shape-rectangle u-tab-pane u-tab-pane-2" id="tab-0da5" role="tabpanel" aria-labelledby="link-tab-0da5">
                  <div class="u-container-layout u-container-layout-3">
                    <h5 class="u-text u-text-default u-text-3">
                      <span class="u-text-body-color">Change Information</span>
                    </h5>
                    <form method="POST" action="User-Profile.php">
                    <div class="u-border-3 u-border-white u-expanded-width u-line u-line-horizontal u-line-2"></div>
                    <div class="u-table u-table-responsive u-table-2">
                      <table class="u-table-entity">
                        <colgroup>
                          <col width="32.7%">
                          <col width="67.3%">
                        </colgroup>
                        <tbody class="u-table-body u-text-body-color u-table-body-2">
                          <tr style="height: 46px;">
                            <td class="u-border-1 u-border-no-left u-border-no-right u-border-white u-table-cell">NEW Username</td>
                            <td class="u-border-1 u-border-no-left u-border-no-right u-border-white u-table-cell u-table-cell-10"><input type="text" name="newUsername" required></td>
                          </tr>
                          <tr style="height: 46px;">
                            <td class="u-border-1 u-border-no-left u-border-no-right u-border-white u-table-cell">Confirm New Username</td>
                            <td class="u-border-1 u-border-no-left u-border-no-right u-border-white u-table-cell u-table-cell-12"><input type="text" name="confirmNewUsername" required></td>
                          </tr>
                          <tr style="height: 46px;">
                            <td class="u-border-1 u-border-no-left u-border-no-right u-border-white u-table-cell">NEW Password</td>
                            <td class="u-border-1 u-border-no-left u-border-no-right u-border-white u-table-cell u-table-cell-16"><input type="password" name="newPassword" pattern="(?=.*[A-Z]).{5,}" title="Password must contain at least one uppercase latter and at least 5 or more characters"  required></td>
                          </tr>
                          <tr style="height: 46px;">
                            <td class="u-border-1 u-border-no-left u-border-no-right u-border-white u-table-cell">Confirm New Password</td>
                            <td class="u-border-1 u-border-no-left u-border-no-right u-border-white u-table-cell u-table-cell-18"><input type="password" name="confirmNewPassword" pattern="(?=.*[A-Z]).{5,}" title="Password must contain at least one uppercase latter and at least 5 or more characters"  required></td>
                          </tr> 
                        </tbody>
                      </table>
                    </div>
                    
                    <input type="hidden" name="token" value="<?=$_SESSION["token"]?>">
                    
                    <input type="submit" name="change" class="u-border-none u-btn u-button-style u-custom-color-4 u-hover-black u-btn-2" value="Save changes">

                    </form>
                  </div>
                </div>      
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
       
    <?php include "include/footer.php" ?>
  
</body></html>
