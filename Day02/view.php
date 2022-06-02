<?php
$customerFile = fopen("customer.txt", "r");
$fileSize = filesize("customer.txt");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Customers</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <table class="table table-dark w-50 m-auto">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $counter = 0;
            while (!feof($customerFile)) {
                $customerData = fgetcsv($customerFile, 0, ":");
                if (!empty($customerData)) {
                    echo "<tr>";
                    foreach ($customerData as $data) {
                        echo "<td>$data</td>";
                    }
                    echo "<td><a class='btn btn-primary' href='delete.php?id=$counter'>Delete</a></td>";
                    $counter++;
                    echo "</tr>";
                }
            }
            fclose($customerFile);
            ?>
        </tbody>
    </table>
</body>

</html>