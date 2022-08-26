<?php
session_start();
include_once("../../../../../db.php");
$obrisiKategoriju = $_REQUEST['obrisiKategoriju'];
$ime_firme = $_SESSION['ime_firme'];
$sql = "DELETE FROM kategorije WHERE ime_kategorije = '$obrisiKategoriju' AND ime_firme='$ime_firme'"; //kako sad ja da dobijem bas artikl koji se brise - evo kako ilija smrdljo

if ($conn->query($sql) === TRUE) {
    $row_successfully_deleted = true;
} else {
    echo "Error deleting record: " . $conn->error;
}
$conn->close();

if ($row_successfully_deleted) echo "deleted";


