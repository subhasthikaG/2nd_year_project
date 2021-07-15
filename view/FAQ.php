<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ's</title>
    <link rel="stylesheet" href="../css/FAQ.css">
</head>
<body>
  <?php require_once('../inc/navbar.php'); ?>  
  <div class="primary">
    <button class="collapsible"><i class='fa fa-plus-circle'></i> What is RecordEx?</button>
    <div class="content">
      <p>RecordEx is a recording studio reservation platform which can be used by both music recording studios and their customers.</p>
    </div>
    <button class="collapsible"><i class='fa fa-plus-circle'></i> What is the purpose of introducing this platform?</button>
    <div class="content">
      <p>The purpose of introducing this platform is to make the artists to communicate with the recording studios without physical meetups before reserving a studio. (Specially for the new upcoming artists.) And this facilitate studios to improve their job amount.</p>
    </div>
    <button class="collapsible"><i class='fa fa-plus-circle'></i> Is this free of charge for the studio <b>customers</b>?</button>
    <div class="content">
      <p>Yes, This facility is fully free of charge for all the studio customers.</p>
    </div>
    <button class="collapsible"><i class='fa fa-plus-circle'></i> Is this free of charge for the <b>studios</b>?</button>
    <div class="content">
      <p>No, But all the studio registrations get one month free trial to deduce the validation of the system then only 5.00 USD per year.</p>
    </div>
    <button class="collapsible"><i class='fa fa-plus-circle'></i> Do the customers need to do the payment in a reservation?</button>
    <div class="content">
      <p>Yes, but an Advanced payment not the full payment.</p>
    </div>
    <button class="collapsible"><i class='fa fa-plus-circle'></i> How does the studio manage the time?</button>
    <div class="content">
      <p>Studio can manage a time schedule inside the system and they can customize the slots according to their closing dates and the jobs outside the system.</p>
    </div>
    <button class="collapsible"><i class='fa fa-plus-circle'></i> Can studio cancel a job after a reservation?</button>
    <div class="content">
      <p>No, They are not facilitated to do the cancellation and they need to request the system administrator to cancel the job and the admin will ask studio to return the payment and cancel the job after the payment is being confirmed by the relevent customer.</p>
    </div>  
  </div>
  <div class="secondary"> 
      <a class="socialab" href="#"><i class="fab fa-facebook-f"></i></a>
      <a class="socialab" href="#"><i class="fab fa-twitter"></i></a>
      <a class="socialab" href="#"><i class="fab fa-instagram"></i></a>
      <a class="socialab" href="#"><i class="fab fa-youtube"></i></a>     
  </div>
  
  <script>
    var coll = document.getElementsByClassName("collapsible");
    var i;
    for (i = 0; i < coll.length; i++) {
      coll[i].addEventListener("click", function() {
      this.classList.toggle("active");
      var content = this.nextElementSibling;
      if (content.style.maxHeight){
        content.style.maxHeight = null;
      } 
      else {
        content.style.maxHeight = content.scrollHeight + "px";
      } 
    });
   }
</script>  
<?php require_once('../inc/minfooter.php'); ?>
</body>
</html>