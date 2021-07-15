<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Studio Registration</title>
    <link rel="stylesheet" href="../css/customer/cust_reg.css">
    <script src="../assets/pass_length.js"></script>
    <style>
      .center{
        margin-top: 240px;
      }
    </style>
  </head>
  <body>
    <?php require_once('../inc/navbar.php');?>
    <div class="center">
      <h1>Studio Registration</h1>
      <h1>Studio Details</h1>


      <form action="../controller/studio_reg_controller.php" method="post" action="#">
        <div class="textfield">
          <!-- <input type="text" required name="studio_name"> -->
          <input type="text" name="studio_name">

          <span></span>
          <label>Studio Name*</label>
        </div>

        <div class="textfield">
          <!-- <input type="text" required name="s_address_1"> -->
          <input type="text" name="s_address_1">
          <span></span>
          <label>Address Line 1*</label>
        </div>

        <div class="textfield">
          <!-- <input type="text" required name="s_address_2"> -->
          <input type="text" name="s_address_2">
          <span></span>
          <label>Address Line 2*</label>
        </div>

        <div class="textfield">
          <!-- <input type="text" required name="s_city"> -->
          <input type="text" name="s_city">
          <span></span>
          <label>City*</label>
        </div>

        <div class="textfield">
          <!-- <input type="text" required name="distric"> -->
          <select id = "disdop" name="distric">
               <option value = "Ampara">Ampara</option>
               <option value = "Anuradhapura">Anuradhapura</option>
               <option value = "Badulla">Badulla</option>
               <option value = "Batticaloa">Batticaloa</option>
               <option value = "Colombo">Colombo</option>
               <option value = "Galle">Galle</option>
               <option value = "Gampaha">Gampaha</option>
               <option value = "Hambantota">Hambantota</option>
               <option value = "Jaffna">Jaffna</option>
               <option value = "Kalutara">Kalutara</option>
               <option value = "Kandy">Kandy</option>
               <option value = "Kegalle">Kegalle</option>
               <option value = "Kilinochchi">Kilinochchi</option>
               <option value = "Kurunegala">Kurunegala</option>
               <option value = "Mannar">Mannar</option>
               <option value = "Matale">Matale</option>
               <option value = "Matara">Matara</option>
               <option value = "Monaragala">Monaragala</option>
               <option value = "Mullaitivu">Mullaitivu</option>
               <option value = "Nuwara Eliya">Nuwara Eliya</option>
               <option value = "Polonnaruwa">Polonnaruwa</option>
               <option value = "Puttalam">Puttalam</option>
               <option value = "Ratnapura">Ratnapura</option>
               <option value = "Trincomalee">Trincomalee</option>
               <option value = "Vavuniya">Vavuniya</option>
              </select>
          <span></span>
          <label>District*</label>
        </div>

        <div class="textfield">
          <!-- <input type="Number" required name="postalcode"> -->
          <input type="Number" name="postalcode">
          <span></span>
          <label>Postal Code*</label>
        </div>
        <div class="textfield">
          <!-- <input type="text" required name="s_address_2"> -->
          <input type="text" name="latitude" title="1.open Google Maps.
2.Right-click the place or area on the map.
3.Select What's here? At the bottom.
4.you’ll see a card with the coordinates.">
          <span></span>
          <label>Latitude</label>
        </div>
        <div class="textfield">
          <!-- <input type="text" required name="s_address_2"> -->
          <input type="text" name="longitude" title="1.open Google Maps.
2.Right-click the place or area on the map.
3.Select What's here? At the bottom.
4.you’ll see a card with the coordinates.">
          <span></span>
          <label>Longitude</label>
        </div>

        <div class="textfield">
          <!-- <input type="email" required name="s_email"> -->
          <input type="email" name="s_email">
          <span></span>
          <label>Studio Email Address*</label>
        </div>

        <div class="textfield">
          <!-- <input type="Number" required name="s_tele_no"> -->
          <input type="tel" name="s_tele_no" pattern="[0-9]{10}">
          <span></span>
          <label>Telephone Number*</label>
        </div>

        <div class="textfield">
          <!-- <input type="Number" required name="s_tele_no"> -->
          <input type="email" name="paypal">
          <span></span>
          <label>PayPal Account Email*</label>
        </div>

        <div class="textfield">
          <!-- <input type="password" required name="password"> -->
          <input type="password" name="password" id="pass1" onkeyup="checkPass(); return false";>
          <span></span>
          <label>Password* <span id="error-nwl1"></span></label>
        </div>

        <div class="textfield">
          <!-- <input type="password" required name="repeat_password"> -->
          <input type="password" name="repeat_password" id="pass2" onkeyup="checkPass(); return false";>
          <span></span>
          <label>Confirm Password* <span id="error-nwl2"></span></label>
        </div>
        <div class="error">
            <?php
                if(isset($_GET['errors']) && !empty($_GET['errors'])){
                    $err = unserialize(urldecode($_GET['errors']));                     
                      echo $err;
                }
            ?>
        </div>
        <input type="submit" value="Register" name="submit2">
      </form>
    </div>
    <!-- <?php require_once('../inc/minfooter.php');?> -->
  </body>
</html>
