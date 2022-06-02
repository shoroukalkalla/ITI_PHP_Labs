<?php

session_start();
if (count($_SESSION) == 0) {
    header("Location: login.php");
}

if (isset($_REQUEST['reset'])) {
    session_destroy();
    header('Location: ' . $_SERVER['PHP_SELF']);
}

$displayError = false;
if (count($_SESSION) > 0) {
    $displayError = true;
}

$name = $_SESSION['name'] ?? "";
$email = $_SESSION['email'] ?? "";
$password = $_SESSION['password'] ?? "";
$confirmPassword = $_SESSION['confirmPassword'] ?? $password;
$roomNo = $_SESSION['roomNo'] ?? "";
$ext = $_SESSION['ext'] ?? "";
$image = $_SESSION['image'] ?? "";
$passwordError = $_SESSION['password_error'] ?? "";
$emailError = $_SESSION['email_error'] ?? "";

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
    body {
        background: #212529 !important;
        color: #fff !important;
    }

    input {
        background: #cfcfcf !important;
    }
    </style>

</head>

<body>
    <div class="container">
        <form class="mt-4" method="POST" enctype="multipart/form-data"
            action="studentController.php?id=<?= $_SESSION['id']; ?>">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="inputName">Name</label>
                    <input type="text" class="form-control <?= empty($name) && $displayError ? 'border-danger' : '' ?>"
                        id="inputName" placeholder="Name" name="name" value="<?= $name ?>">
                </div>
                <div class="form-group col-md-12">
                    <label for="inputEmail4">Email</label>
                    <input type="email"
                        class="form-control <?= (empty($email) || $emailError) && $displayError ? 'border-danger' : '' ?>"
                        id="inputEmail4" placeholder="Email" name="email" value="<?= $email ?>">
                </div>
                <?php
                if ($emailError && $displayError) {

                    echo "<div class='alert alert-danger form-group col-md-12' role='alert'>$emailError</div>";
                }

                ?>
                <div class="form-group col-md-12">
                    <label for="inputPassword4">Password</label>
                    <input type="password" class="form-control" id="inputPassword4" placeholder="Password"
                        name="password">
                </div>
                <div class="form-group col-md-12">
                    <label for="inputConfirmPassword">Password</label>
                    <input type="password" class="form-control" id="inputConfirmPassword" placeholder="Confirm Password"
                        name="confirmPassword">
                </div>

                <?php
                if ($passwordError && $displayError) {

                    echo "<div class='alert alert-danger form-group col-md-12' role='alert'>$passwordError</div>";
                }

                ?>


            </div>
            <div class="form-group">
                <label for="inputExt.">Building Number</label>
                <input type="text" class="form-control <?= empty($ext) && $displayError ? 'border-danger' : '' ?>"
                    id="inputExt." placeholder="1234" name="ext" value="<?= $ext ?>">
            </div>
            <div class="form-group">
                <label for="inputRoomNo">Languages</label>
                <select name="roomNo" id="inputRoomNo">
                <option value="English" <?= $roomNo == "English" ? "selected" : "" ?>>English</option>
                    <option value="Arabic" <?= $roomNo == "Arabic" ? "selected" : "" ?>>Arabic</option>
                    <option value="French" <?= $roomNo == "French" ? "selected" : "" ?>>French
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label for="inputPicture">Avatar</label><br>
                <img width=50 height=50 src="<?= "images/" . $image ?>" />
                <input type="file" class="form-control" id="inputPicture" name="pictureName">
                <input type="hidden" name="image" value="<?= $image ?>" />

                <?php
                if (is_array($image) && $displayError) {
                    foreach ($image as $err)
                        echo "<div class='alert alert-danger' role='alert'>$err</div>";
                }

                ?>
            </div>
            <button type="submit" class="btn btn-dark" name="edit">Edit</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>