<?php
include "config.php";
//error messages
$username_msg = "Username should be between 3 and 30 characters.";
$email_msg = "Invalid email address.";
$phone_msg = "Invalid phone number, it should be 10 digits.";
$place_msg = "Place should be between 3 and 30 characters.";
$fill_all_fields = "Please fill all fields.";
$existing_user_email_error = "Username or Email already exist";
$error_msgs = array();

if (isset($_POST["submit"])) {
  $username = htmlspecialchars($_POST["username"]);
  $email = htmlspecialchars($_POST["email"]);
  $place = htmlspecialchars($_POST["place"]);
  $phone = preg_replace('/[^0-9]/', '', $_POST["phone"]);


  //All fields are null
  if (empty($username) || empty($email) || empty($phone) || empty($place)) {
    $error_msgs[] = $fill_all_fields;
  } else {
    //Validate all fields
    $username = ucfirst(strtolower(str_replace(" ", "", $username)));
    $place = ucfirst(strtolower(str_replace(" ", "", $place)));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error_msgs[] = $email_msg ;
    }
    if (strlen($phone) !== 10 || !ctype_digit($phone) || $phone <= 0) {
      $error_msgs[] = $phone_msg;
    }
    if (strlen($username) < 3 || strlen($username) > 30) {
      $error_msgs[] = $username_msg;
    }
    if (strlen($place) < 3 || strlen($place) > 30) {
      $error_msgs[] = $place_msg;
    }

    if (empty($error_msgs)) {
      $check_query = "select * from crud where Username = '$username' or Email = '$email'";
      $check_query_result = mysqli_query($con, $check_query);
      if (!$check_query_result) {
        echo "<script>alert('Error checking existing data.')</script>";
      }
      if (mysqli_num_rows($check_query_result) > 0) {
        // Optionally, you can use $existing_user_email_error for further display or processing
        $error_msgs[] = $existing_user_email_error;
        // echo $existing_user_email_error;
      } else {
        //insert data in db
        $insert_query = "insert into crud (username, email, phone, place) values ('$username', '$email', '$phone', '$place')";
        $result = mysqli_query($con, $insert_query);
        if ($result) {
          // echo "Data inserted successfully.";
          echo "<script>alert(' Data inserted successfully.')</script>";
          // redirect to the display page
          // echo "<script>window.open('index.php', '_self')</script>";

        } else {
          die(mysqli_error($con));
        }
      }
    }
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

        <?php
        if (in_array($fill_all_fields, $error_msgs))
          echo '<span class="error_messages">' . $fill_all_fields . '</span>';
        ?>
        <?php
        if (in_array($existing_user_email_error, $error_msgs))
          echo '<span class="error_messages">' . $existing_user_email_error . '</span>';
        ?>

        <label for="username"></label>
        <span>Name <span class="required">*</span></span><input
          type="text"
          placeholder="Enter your Username"
          autocomplete="off"
          name="username" />
        <?php
        if (in_array($username_msg, $error_msgs))
          echo '<span class="error_messages">' . $username_msg . '</span>';
        ?>
        <label for="email"></label>
        <span>Email <span class="required">*</span></span><input
          type="text"
          placeholder="Enter your Email"
          autocomplete="off"
          name="email" />
        <?php
        if (in_array($email_msg, $error_msgs))
          echo '<span class="error_messages">' . $email_msg . '</span>';
        ?>
        <label for="phone"></label>
        <span>Phone <span class="required">*</span></span><input
          type="text"
          placeholder="Enter your Mobile"
          autocomplete="off"
          name="phone" />
        <?php
        if (in_array($phone_msg, $error_msgs)) {
          echo '<span class="error_messages">' . $phone_msg . '</span>';
        }
        ?>
        <label for="place"></label>
        <span>Place <span class="required">*</span></span><input
          type="text"
          name="place"
          placeholder="Enter your Place"
          autocomplete="off" />
        <?php
        if (in_array($place_msg, $error_msgs))
          echo '<span class="error_messages">' . $place_msg . '</span>';
        ?>
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