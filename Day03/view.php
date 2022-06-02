<?php
session_start();

if (count($_SESSION) == 0) {
    header("Location: login.php");
}

$name = $_SESSION['name'] ?? "";
$email = $_SESSION['email'] ?? "";
$ext = $_SESSION['ext'] ?? "";
$roomNo = $_SESSION['roomNo'] ?? "";
$image = $_SESSION['image'] ?? "";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View</title>

    <style>
    body {
        overflow: hidden;
    }

    .columns {
        margin-top: 0;
    }

    .section {
        background-color: white;
        min-height: 100vh;
        position: relative;
    }

    .section .card {
        border-radius: 6px;
        max-width: 300px;
        max-height: 380px;
        margin: 0 auto;
    }

    .section .card .header {
        height: 120px;
        background: lightpink;
    }

    .section .card .header .avatar {
        width: 80px;
        height: 100%;
        position: relative;
        margin: 0 auto;
    }

    .section .card .header .avatar img {
        width: 100px;
        height: 100px;
        display: block;
        border-radius: 50%;
        position: absolute;
        bottom: -42px;
        border: 4px solid white;
    }

    .section .card .card-body {
        padding: 30px;
    }

    .section .card .card-body .user-meta {
        padding-top: 20px;
    }

    .section .card .card-body .user-meta .username {
        font-size: 18px;
        font-weight: 600;
    }

    .section .card .card-body .user-meta .position {
        font-size: 90%;
        color: black;
    }

    .section .card .user-bio {
        padding-top: 8px;
        font-size: 92%;
        color: black;
    }

    .section .card .action {
        padding-top: 20px;
        text-align: center;
    }

    .section .card .action .button {
        padding: 16px 20px 16px 20px;
        background: pink;
        border-color: #C0392B;
        color: blue;
        border-radius: 100px;
        transition: opacity 0.3s;
    }

    .section .card .action .button:hover {
        opacity: 0.7;
    }

    .link-button {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: #C0392B;
        position: absolute;
        bottom: 20px;
        right: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: all 0.4s;
    }

    .link-button img {
        width: 32px;
        height: 32px;
        display: block;
    }

    .link-button:hover {
        transform: scale(1.1) rotate(180deg);
        background: #00D1B2;
    }
    </style>
</head>

<body>
    <div class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-4 is-offset-4">
                    <div class="card">
                        <div class="header">
                            <div class="avatar">
                                <img src="<?= "images/$image"; ?>" alt="">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="user-meta has-text-centered">
                                <h3 class="username"><?= $name ?></h3>
                                <h5 class="position"><?= $roomNo ?></h5>
                            </div>
                            <div class="user-bio has-text-centered">
                                <p><?= $ext ?></p>
                                <p><?= $email ?></p>
                            </div>
                            <div class="action has-text-centered">
                                <a href="login.php?reset" class="button is-small">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>