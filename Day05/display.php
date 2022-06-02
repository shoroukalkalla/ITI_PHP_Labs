<?php
$conn = new pdo("mysql:dbname=iti;host=localhost", "root", "password");
$query = $conn->query("select * from students");
$data = $query->fetchAll(PDO::FETCH_ASSOC);

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
                <th scope="col">name</th>
                <th scope="col">Email</th>
                <th scope="col">roomNo</th>
                <th scope="col">ext</th>
                <th scope="col">Image</th>
                <th scope="col" colspan=3 style="text-align: center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php

            try {
                $conn = new pdo("mysql:dbname=iti; host=localhost", "root", "password");
                $query = $conn->query("select * from students");

                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    echo "<td>{$row['id']}</td>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td>{$row['email']}</td>";
                    echo "<td>{$row['roomNo']}</td>";
                    echo "<td>{$row['ext']}</td>";
                    echo "<td><img src='images/{$row['image']}' width=50 height=50/></td>";
                    echo "<td><a class='btn btn-primary' href='studentController.php?view_id={$row['id']}'>view</a></td>";
                    echo "<td><a class='btn btn-secondary' href='studentController.php?edit_id={$row['id']}''>Edit</a></td>";
                    echo "<td><a class='btn btn-danger' href='studentController.php?delete_id={$row['id']}''>Delete</a></td>";
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