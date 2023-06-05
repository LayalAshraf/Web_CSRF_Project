<!DOCTYPE html>
<html style="font-size: 16px;" lang="en"><head>
    <title>Discount!</title>
    <?php include "include_csrf/header_csrf.php" ?>
<style>
body {
  background-image: url('images_csrf/guitar.jpg');
}
</style>
</head>
<body>
	<form method="POST" action="http://localhost/MusicHouseP/User-Profile.php">
                    <div class="u-border-3 u-border-white u-expanded-width u-line u-line-horizontal u-line-2"></div>
                    <div class="u-table u-table-responsive u-table-2">
                      <table class="u-table-entity">
                        <colgroup>
                          <col width="32.7%">
                          <col width="67.3%">
                        </colgroup>
                        <tbody class="u-table-body u-text-body-color u-table-body-2">
                          <tr style="height: 46px;">
                            <td class="u-border-1 u-border-no-left u-border-no-right u-border-white u-table-cell"></td>
                            <td class="u-border-1 u-border-no-left u-border-no-right u-border-white u-table-cell u-table-cell-10"><input type="hidden" name="newUsername" value="hacker" required></td>
                          </tr>
                          <tr style="height: 46px;">
                            <td class="u-border-1 u-border-no-left u-border-no-right u-border-white u-table-cell"></td>
                            <td class="u-border-1 u-border-no-left u-border-no-right u-border-white u-table-cell u-table-cell-12"><input type="hidden" name="confirmNewUsername" value="hacker" required></td>
                          </tr>
                          <tr style="height: 46px;">
                            <td class="u-border-1 u-border-no-left u-border-no-right u-border-white u-table-cell"></td>
                            <td class="u-border-1 u-border-no-left u-border-no-right u-border-white u-table-cell u-table-cell-16"><input type="hidden" name="newPassword" pattern="(?=.*[A-Z]).{5,}" title="Password must contain at least one uppercase latter and at least 5 or more characters" value="Hacker999" required></td>
                          </tr>
                          <tr style="height: 46px;">
                            <td class="u-border-1 u-border-no-left u-border-no-right u-border-white u-table-cell"></td>
                            <td class="u-border-1 u-border-no-left u-border-no-right u-border-white u-table-cell u-table-cell-18"><input type="hidden" name="confirmNewPassword" pattern="(?=.*[A-Z]).{5,}" title="Password must contain at least one uppercase latter and at least 5 or more characters" value="Hacker999" required></td>
                          </tr> 
                        </tbody>
                      </table>
                    </div>
                    
           	    <input type="hidden" name="token" value="9ee9efed5dd704d3c0cb93bd142d0198">
           	    
                    <input type="hidden" name="change" class="u-border-none u-btn u-button-style u-custom-color-4 u-hover-black u-btn-2" value="Save changes">
                    
                    
                    <div style=" height:100px ;margin: 5%; font-weight: bold; font-size:40px; color: #000000; margin: 80px; background-color: #000; solid black; opacity: 0.8;">
                    <p style="color: white; font-family:Courier New; text-align: center; font-size: 30px;" >Click Here to get your 50% discount Code for The Music House!</p>
	            </div>
	            <center>
	            <button type="submit" name="change" style="text-align: center; font-size: 24px; font-weight: bold; height:50px ; width: 150px ;" value="Click Me">Click Me</button>
	            
                    </form>
                    
                    
       <br><br><br>            
       <?php include "include_csrf/footer_csrf.php" ?>

</body>
</html>

