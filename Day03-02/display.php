<?php
session_start();
$conn = new pdo("mysql:dbname=iti;host=localhost", "root", "password");
$query = $conn->query("select * from students");
$data = $query->fetchAll(PDO::FETCH_ASSOC);
if (count($_SESSION) == 0) {
    header("Location: login.php");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All students</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
    body {
        background: #212529;
    }
    </style>
</head>

<body>
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Avatar</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Languages</th>
                <th scope="col">Building Number</th>
                <th scope="col" colspan=3 style="text-align: center"></th>
            </tr>
        </thead>
        <tbody>
            <?php

            try {
                $conn = new pdo("mysql:dbname=iti; host=localhost", "root", "password");
                $query = $conn->query("select * from students");

                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    echo "<td>{$row['id']}</td>";
                    echo "<td><img src='images/{$row['image']}' width=50 height=50/></td>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td>{$row['email']}</td>";
                    echo "<td>{$row['roomNo']}</td>";
                    echo "<td>{$row['ext']}</td>";
                    echo "<td><a class='btn btn-info' href='studentController.php?view_id={$row['id']}'>view</a></td>";
                    echo "<td><a class='btn btn-info' href='studentController.php?edit_id={$row['id']}''>Edit</a></td>";
                    echo "<td><a class='btn btn-info' href='studentController.php?delete_id={$row['id']}''>Delete</a></td>";
                    echo "</tr>";
                }
            } catch (PDOException $e) {
                die($e->getMessage());
            }


            ?>
        </tbody>
    </table>
</body>

</html>