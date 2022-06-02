<?php
session_start();

if (isset($_REQUEST['reset'])) {
    session_destroy();
    header('Location: ' . $_SERVER['PHP_SELF']);
}

$displayError = false;
if (count($_SESSION) > 0)
    $displayError = true;

$error = $_SESSION['error'] ?? "";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
    .container {
        height: 100vh !important;
    }
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
    <div class="container d-flex align-items-center vh-100 flex-column justify-content-center">
        <?php
        if ($displayError) {
            if ($error) echo "<div class='alert alert-danger' role='alert'>$error</div>";
        }
        ?>
        <form class="w-50 mx-auto text-center" method="POST" action="studentController.php">
            <div class="form-group text-left">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    placeholder="Enter email" name="email">
            </div>
            <div class="form-group text-left">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"
                    name="password">
            </div>
            <button type="submit" name="login" class="btn btn-dark">Login</button>
        </form>
    </div>
</body>

</html>