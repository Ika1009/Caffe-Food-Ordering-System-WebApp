<?php

include_once "../../../../../db.php";

$status = "izvrsena";
$sql = "UPDATE `narudzbine` SET `status`= \"$status\", `broj_stola`=\"200\" WHERE `id`= " . $_REQUEST['id'];

if ($conn->query($sql) === TRUE) {
    echo "updated";
}
else {
    echo "Error deleting record: " . $conn->error;
}
$conn->close();

    