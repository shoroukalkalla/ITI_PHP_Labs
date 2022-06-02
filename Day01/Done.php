<?php


$fname = $_REQUEST['firstName'];
$lname = $_REQUEST['lastName'];
$address = $_REQUEST['address'];
$country = $_REQUEST['country'];
$email = $_REQUEST['email'];
$skills = $_REQUEST['skills'];
$department = $_REQUEST['department'];

$query = "";
$missingData = false;
foreach ($_REQUEST as $key => $value) {
    if (!empty($value)) {
        if (is_array($value)) {
            foreach ($value as $insideValue)
                $query .= $insideValue . "=" . "active&";
            continue;
        }
        $query .= $key . "=" . $value . "&";
    } else if (empty($value)) {
        $missingData = true;
    }
}
function emailValidation() {
    global $email;
    if (!preg_match("/^[a-zA-Z-' ]*$/", $email)) {
        return true;
    }
    return false;
}

?>

<html>

<head>
<link rel="stylesheet" href="style.css">
</head>

<body>

<?php if ($missingData || !emailValidation()) { ?>
    <div class="back">
        <?php
            if ($missingData) echo "<p>You must fill all data</p>";
            if (!emailValidation()) {
                echo  "<p>Your email isn't valid</p>";
            } ?>
        <a href='registration.php?<?php echo $query; ?>'>Go Back</a>
    </div>
    <?php
        return;
    } ?>


    <div class="data">
        <p>Thanks (Mr. or Miss Selected by the gender type!) <span><?= $fname . " " . $lname ?></span></p>
        <p class="review"><span>Please Review Your Information</span> </p>
        <p><span>Email:</span> <?= $email ?></p>
        <p><span>Address:</span> <?= $address ?></p>
        <p><span>Your skills:</span> </p>
        <ul>
            <?php foreach ($skills as $skill) { ?>
            <li><?= $skill ?></li>
            <?php } ?>
        </ul>

        <p><span>Department: </span><?= $department ?></p>
    </div>
</body>

</html>