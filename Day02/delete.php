<?php

$customerFile = fopen("customer.txt", "r");
$fileSize = filesize("customer.txt");

$id = $_REQUEST['id'];

$filename = 'customer.txt';
$lines = [];

$f = fopen($filename, 'r');

while (!feof($f)) {
    array_push($lines, fgets($f));
}
fclose($f);

$f = fopen($filename, 'w');
for ($i = 0; $i < count($lines); $i++) {
    if ($i != $id)
        fwrite($f, $lines[$i]);
}

header("Location: view.php");