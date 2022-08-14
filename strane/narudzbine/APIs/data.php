<?php

session_start();
include_once("../../../db.php");

$ime_firme = $_SESSION['ime_firme'];
$broj_stola = $_REQUEST['broj_stola'];
$result = mysqli_query($conn, "SELECT * FROM `narudzbine` WHERE ime_firme = '$ime_firme' AND broj_stola= " .$broj_stola); // WHERE ime_firme = '$ime_firme' AND
$data = array();
while ($row = mysqli_fetch_object($result))
{
    array_push($data, $row);
}
echo json_encode($data);
exit();

?>