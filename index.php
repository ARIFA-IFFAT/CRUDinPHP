<?php
include "config.php";
//error messages
$username_msg ="Username should be between 3 and 30 characters.";
$email_msg = "";
$phone_msg = "";
$place_msg ="Place should be between 3 and 30 characters.";

$error_msgs= array();

if (isset($_POST["submit"])) {
  $username = htmlspecialchars($_POST["username"]);
  $email = htmlspecialchars($_POST["email"]);
  $phone = htmlspecialchars($_POST["phone"]);
  $place = htmlspecialchars($_POST["place"]);
//Validate username and place
$username= ucfirst(strtolower(str_replace(" ","", $username)));
$place = ucfirst(strtolower(str_replace(" ","", $place)));

if(strlen($username<5 || strlen($username>30))){
  $error_msgs[]= $username_msg;
}
if(strlen($place<5 || strlen($place>30))){
  $error_msgs[]= $email_msg;
}

  $insert_query = "insert into crud (username, email, phone, place) values ('$username', '$email', '$phone', '$place')";

  $result = mysqli_query($con, $insert_query);
  if($result) {
    // echo "Data inserted successfully.";
    echo "<script>alert(' Data inserted successfully.')</script>";
        // redirect to the display page
        // echo "<script>window.open('index.php', '_self')</script>";
        
  } else {
    die(mysqli_error($con));
  }

}

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PHP - CRUD Operation</title>
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <div class="form_container">
    <form action="" method="post">
      <fieldset>
        <legend>Personal Details</legend>
        <label for="username"></label>
        <span>Name <span class="required">*</span></span><input
          type="text"
          placeholder="Enter your Username"
          autocomplete="off"
          name="username"
          required />

        <label for="email"></label>
        <span>Email <span class="required">*</span></span><input
          type="email"
          placeholder="Enter your Email"
          autocomplete="off"
          name="email"
          required />

        <label for="phone"></label>
        <span>Phone <span class="required">*</span></span><input
          type="number"
          placeholder="Enter your Mobile"
          autocomplete="off"
          name="phone"
          required />

        <label for="place"></label>
        <span>Place <span class="required">*</span></span><input
          type="text"
          name="place"
          placeholder="Enter your Place"
          autocomplete="off"
          required />

        <input type="submit" class="submit_btn" name="submit" />

        <a href="display.php" class="view_data">Details</a>
        <a
          href="https://www.youtube.com/c/StepbyStep_KhanamCoding"
          class="view_data"
          target="_blank">Channel</a>
      </fieldset>
    </form>
  </div>

  <div class="footer">
    <p>All right reserved- Made with 💖 by Khanam</p>
  </div>
</body>

</html>