<?php

session_start();
include_once "../../../../../db.php";

$ime_firme = $_SESSION['ime_firme'];
$result = mysqli_query($conn, "SELECT * FROM `narudzbine` WHERE id= " . $_REQUEST['id']);
$data = array();
while ($row = mysqli_fetch_object($result))
{
    array_push($data, $row);
}
echo json_encode($data);
exit();

?>