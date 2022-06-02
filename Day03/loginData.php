<?php

session_start();

$email = $_REQUEST['email'];
$password = $_REQUEST['password'];
$loginSuccessfully = false;

$userDataKeys = ["name", "email", "roomNo", "ext", "image"];

$filename = 'data.txt';
$lines = [];

$f = fopen($filename, 'r');

while (!feof($f)) {
    $line = fgets($f);

    $emailFound = str_contains($line, $email);

    if ($emailFound) {
        if (str_contains($line, hash('sha256', $password))) {
            $userInfo = explode(":", $line);
            $j = 0;
            for ($i = 0; $i < count($userInfo); $i++)
                if (hash('sha256', $password) != $userInfo[$i])
                    $_SESSION[$userDataKeys[$j++]] = $userInfo[$i];
            $loginSuccessfully =  true;
        }
        break;
    }
}
fclose($f);

if ($loginSuccessfully) {
    header("Location: view.php");
} else {
    $_SESSION['error'] = "The email, or password you entered is incorrect. Please try again.";
    header("Location: login.php");
}