
<?php
if (isset($_REQUEST['addNewCategory'])) {

    include_once("../../../db.php");
    session_start();
    $imeKategorije = $_REQUEST['addNewCategory'];

    $ime_firme = $_SESSION['ime_firme'];
    $sql = "INSERT INTO `kategorije` (ime_kategorije, ime_firme) VALUES ('$imeKategorije', '$ime_firme')";
    echo "success";

    if ($conn->query($sql) === FALSE) {
        echo "Greska: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}



?>