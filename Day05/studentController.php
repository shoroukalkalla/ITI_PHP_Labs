<?php
require_once("db.php");
$db=new db();
session_start();
session_destroy();

session_start();

// ---- Start Helper Functions ---- 
function EmailValidation($email) {
    $pattern = "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix";
    if (preg_match($pattern, $email)) {
        return true;
    }
    $_SESSION['email_error'] = "Invalid Email";
    return false;
}

function validatePassword($password, $confirmPassword) {
    if ($password == $confirmPassword) {
        $pattern = "/^[a-z_]{3,}$/ix";
        if (preg_match($pattern, $password)) {
            return true;
        }
        $_SESSION['password_error'] = "Passwords must be at least 3 small letters and underscore.";
        return false;
    }
    $_SESSION['password_error'] = "Passwords don't match";
    return false;
}

function fileValidation($page) {
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

        if (!in_array($file_extension, $extensions)) {
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
            header("Location: $page.php");
            exit;
        }
    }

    return $file_name;
}


// ---- End Helper Functions -----

if (isset($_REQUEST['registration'])) {

    $name = $_REQUEST['name'] ?? "";
    $email = $_REQUEST['email'] ?? "";
    $password = $_REQUEST['password'] ?? "";
    $confirmPassword = $_REQUEST['confirmPassword'] ?? "";
    $roomNo = $_REQUEST['roomNo'] ?? "";
    $ext = $_REQUEST['ext'] ?? "";
    $file_name;


    $missingData = false;
    foreach ($_REQUEST as $key => $value) {
        if (!empty($value)) {
            $_SESSION[$key] = $value;
        } else if (empty($value)) {
            $missingData = true;
        }
    }

    if (!$missingData || !emailValidation($email) || !validatePassword($password, $confirmPassword)) {
        header("Location: registration.php");
        exit();
    }

    $file_name = fileValidation("registration");

    if ($password) {
        $password = hash("sha256", $password);
    }

    $data=[
        $name,
        $email,
        $password,
        $roomNo,
        $ext,
        $file_name
    ];

    $db->addData("students","name,email,password,roomNo,ext,image","?,?,?,?,?,?",$data);
    header("Location: login.php");

} else if (isset($_REQUEST['login'])) {
    session_start();

    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $loginSuccessfully = false;

    $userDataKeys = ["name", "email", "roomNo", "ext", "image"];


    $password = hash('sha256', $password);
    $query = $db->getData("*","students","email='$email' AND password='$password'");

    $data = $query->fetch(PDO::FETCH_ASSOC);

    if ($data) {
        foreach ($data as $key => $value)
            if ($key != "password")
                $_SESSION[$key] = $value;
        $loginSuccessfully =  true;
    }


    if ($loginSuccessfully) {
        header("Location: display.php");
    } else {
        $_SESSION['error'] = "The email, or password you entered is incorrect. Please try again.";

        header("Location: login.php");
    }
} else if (isset($_REQUEST['view_id'])) {
    $query = $db->getData("*","students","id={$_REQUEST['view_id']}");

    $data = $query->fetch(PDO::FETCH_ASSOC);
    foreach ($data as $key => $value)
        if ($key != "password")
            $_SESSION[$key] = $value;

    header("Location: view.php");
} else if (isset($_REQUEST['delete_id'])) {
    $db->delete("students","id={$_REQUEST['delete_id']}");
    header("Location: display.php");
} else if (isset($_REQUEST['edit_id'])) {
    $query = $db->getData("*","students","id={$_REQUEST['edit_id']}");

    $data = $query->fetch(PDO::FETCH_ASSOC);
    foreach ($data as $key => $value)
        $_SESSION[$key] = $value;

    header("Location: edit.php");
} else if (isset($_REQUEST['edit'])) {

    $name = $_REQUEST['name'] ?? "";
    $email = $_REQUEST['email'] ?? "";
    $password = $_REQUEST['password'] ?? "";
    $confirmPassword = $_REQUEST['confirmPassword'] ?? "";
    $roomNo = $_REQUEST['roomNo'] ?? "";
    $ext = $_REQUEST['ext'] ?? "";
    $fileName =  $_REQUEST['avatar'] ?? "";

    $missingData = false;
    foreach ($_REQUEST as $key => $value) {
        if (!empty($value)) {
            $_SESSION[$key] = $value;
        } else if (empty($value)) {
            $missingData = true;
        }
    }

    if (!$missingData || !emailValidation($email)) {
        header("Location: edit.php");
        exit();
    }

    if ($password || $confirmPassword) {
        if (!validatePassword($password, $confirmPassword)) {
            header("Location: edit.php");
            exit();
        }
        $password = hash("sha256", $password);
    }


    if ($_FILES['pictureName']['name']) {
        $file_name = fileValidation("edit");
    }

    foreach ($_REQUEST as $key => $value) {
        if ($value && ($key != "id" || $key != 'edit')) {
            if ($key != 'confirmPassword') {
                if ($key == "password") {
                    $db->updateData("students","password=$password","id={$_REQUEST['id']};");
                    continue;
                }
                $db->updateData("students","$key='$value'","id={$_REQUEST['id']};");
            }
        }
    }

    header("Location: display.php");
}