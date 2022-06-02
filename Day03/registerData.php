<?php

session_start();
session_destroy();

session_start();
$name = $_REQUEST['name'] ?? "";
$email = $_REQUEST['email'] ?? "";
$password = $_REQUEST['password'] ?? "";
$confirmPassword = $_REQUEST['confirmPassword'] ?? "";
$roomNo = $_REQUEST['roomNo'] ?? "";
$ext = $_REQUEST['ext'] ?? "";
$file_name;


function EmailValidation1($email) {
    $pattern = "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix";
    if (preg_match($pattern, $email)) {
        return true;
    }
    return false;
}

function EmailValidation2($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    return false;
}

function validatePassword($password, $confirmPassword) {

    if ($password == $confirmPassword) {
        $pattern = "/^[a-z_]{8,}$/ix";
        if (preg_match($pattern, $password)) {
            return true;
        }
        $_SESSION['password_error'] = "Passwords must be at least 8 small letters and underscore.";
        return false;
    }
    $_SESSION['password_error'] = "Passwords don't match";
    return false;
}

$missingData = false;
foreach ($_REQUEST as $key => $value) {
    if (!empty($value)) {
        $_SESSION[$key] = $value;
    } else if (empty($value)) {
        $missingData = true;
    }
}

if ($missingData || !emailValidation1($email) || !validatePassword($password, $confirmPassword)) {
    header("Location: registration.php");
    exit();
}



if (isset($_FILES['pictureName'])) {
    $errors = [];
    $file_name = $_FILES['pictureName']['name'];
    $file_type = $_FILES['pictureName']['type'];
    $file_size = $_FILES['pictureName']['size'];
    $file_tmp = $_FILES['pictureName']['tmp_name'];

    // get file extension.
    $file_extension = explode(".", $file_name);
    $file_extension = array_pop($file_extension);

    $extensions = array("jpeg", "jpg", "png");

    if (in_array($file_extension, $extensions) === false) {
        $errors[] = "extension not allowed, please choose a JPEG or PNG
file.";
    }
    if ($file_size > 2097152) {
        $errors[] = 'File size must be exactly 2 MB';
        print_r($errors);
    }
    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "images/" . $file_name);
        echo "Success";
    } else
        print_r($errors);


    $_SESSION['image'] = $errors;

    if (count($errors) > 0) {
        header("Location: registration.php");
        exit;
    }
}

if ($password) {
    $password = hash("sha256", $password);
}


$userData = "$name:$email:$password:$roomNo:$ext:$file_name" .  PHP_EOL;

$usersData = fopen("data.txt", "a+");
fwrite($usersData, $userData);
fclose($usersData);

header("Location: login.php");