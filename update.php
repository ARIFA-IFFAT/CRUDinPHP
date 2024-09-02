<?php
include "config.php";
// var_dump($_GET);
if (isset($_GET['update_id'])) {
  $uId = $_GET['update_id'];
  // echo $uId;
  //select 
  $select_query = "select * from crud where Id = $uId";
  $result = mysqli_query($con, $select_query);
  if ($result) {
    $row = mysqli_fetch_assoc($result);
    $userName = $row['Username'];
    $email = $row['Email'];
    $phone = $row['Phone'];
    $place = $row['Place'];
    // echo $id . "from db";



    //update data
    if (isset($_POST["update"])) {
      $userName_update = htmlspecialchars($_POST["username"]);
      $email_update = htmlspecialchars($_POST["email"]);
      $phone_update = htmlspecialchars($_POST["phone"]);
      $place_update = htmlspecialchars($_POST["place"]);
      // echo $userName_update;

      //update 
      $update_query = "update crud set Username= '$userName_update', Email = '$email_update', Phone= '$phone_update', Place= '$place_update' where Id=$uId ";
      $result_update = mysqli_query($con, $update_query);
      if ($result_update) {
        echo "<script>alert(' Updated Sucessfully')</script>";
        //redirect to the display page
        // echo "<script>window.open('display.php', '_self')</script>";
        // another way to redirect
        header('Location: display.php');
      } else {
        die(mysqli_error($con));
      }
    }
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
  <title>Update Data in PHP</title>
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <div class="form_container">
    <form action="" method="post">
      <fieldset>
        <legend>Edit Details</legend>
        <label for="username">Username</label>
        <input type="text" name="username" autocomplete="off" value="<?php echo $userName ?>" />

        <label for="email">Email</label>
        <input type="email" name="email" autocomplete="off" value="<?php echo $email ?>" />

        <label for="phone">Mobile</label>
        <input type="number" name="phone" autocomplete="off" value="<?php echo $phone ?>" />

        <label for="place">Place</label>
        <input type="text" name="place" autocomplete="off" value="<?php echo $place ?>" />

        <input
          type="submit"
          class="submit_btn"
          name="update"
          value="Update" />
      </fieldset>
    </form>
  </div>
  <div class="footer">
    <p>All right reserved- Made with 💖 by Khanam</p>
  </div>
</body>

</html>