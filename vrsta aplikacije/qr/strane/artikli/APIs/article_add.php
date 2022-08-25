<?php
session_start();
extract($_REQUEST);
// daje podatke slike
$slika = $_FILES['file'];
$slikaIme = $_FILES['file']['name'];
$slikaVelicina = $_FILES['file']['size'];
$slikaError = $_FILES['file']['error'];
$slikaTip = $_FILES['file']['type'];
$slikaEkstenzija = substr($slikaIme, strrpos($slikaIme, '.') + 1);
// $dozvoljeni = array('jpg', 'jpeg', 'png'); // dozvoljeni tipovi slike

$target_dir = "";
$target_file = $target_dir . basename($slikaIme);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

$slikaDobra = false;
if($slikaVelicina == 0) {
}else if (getimagesize($_FILES["file"]["tmp_name"]) == false) { // Check if image file is a actual image or fake image
    echo "<script type=\"text/javascript\">alert(\"Fajl nije slika!\");</script>";
}else if (file_exists($target_file)) { // Check if file already exists
    echo "<script type=\"text/javascript\">alert(\"Fajl već postoji!\");</script>";
}else if ($slikaVelicina > 5000000) { // 5MB // Check file size
    echo "<script type=\"text/javascript\">alert(\"Fajl je prevelik. Ne sme biti veci od 5 MB.\");</script>";
}else if (    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"  ) { // Allow certain file formats
    echo "<script type=\"text/javascript\">alert(\"Dozvoljeni formati su samo PNG, JPG i JPEG\");</script>";
} else {
    $slikaDobra = true;
}

include_once "../../../db.php";
$ime_firme = $_SESSION['ime_firme'];
if ($_REQUEST['id'] && strlen($_REQUEST['id']) > 0) { // proverava dal updajtuje ili pravi novi
    // UPDATE `artikli` SET `ime`="Coca Cola",`cena`="108",`opis`="U limenci",`popust`="10",`kategorija`="burger" WHERE `id`= 102
    if ($slikaVelicina != 0) {
        $sql = "UPDATE `artikli` SET `ime`=\"$ime\", `cena`=\"$cena\", `opis`=\"$opis\", `popust`=\"$popust\", `kategorija`=\"$kategorija\", `slika`=\"$slikaEkstenzija\" WHERE `id`= " . $_REQUEST['id'];
        // $slikaID = $conn->insert_id;
        // $sql = "DELETE FROM artikli WHERE id = " . $_REQUEST['id']; //kako sad ja da dobijem bas artikl koji se brise - evo kako ilija smrdljo
        // $sql = "INSERT INTO `artikli` (ime, cena, slika, opis, popust, kategorija, ime_firme) VALUES ('$ime','$cena', '$slikaEkstenzija', '$opis', '$popust', '$kategorija', '$ime_firme')";
        echo "updatedWithImage";
                
        if ($conn->query($sql) === FALSE) {
            echo "Greska: " . $sql . "<br>" . $conn->error;
        }

    }
    else {
        $sql = "UPDATE `artikli` SET `ime`=\"$ime\", `cena`=\"$cena\", `opis`=\"$opis\", `popust`=\"$popust\", `kategorija`=\"$kategorija\" WHERE `id`= " . $_REQUEST['id'];
        echo "updated!image";
        
        if ($conn->query($sql) === FALSE) {
            echo "Greska: " . $sql . "<br>" . $conn->error;
        }
    }

    if ($_REQUEST['id'] && strlen($_REQUEST['id']) > 0 && $slikaVelicina != 0) {
        $mask = 'artikliSlike/' . $_REQUEST['id'] . '.*';
        array_map('unlink', glob($mask));
    }
    $slikaID = $_REQUEST['id'];

    
}
else {

    $sql = "INSERT INTO `artikli` (ime, cena, slika, opis, popust, kategorija, ime_firme, na_stanju) VALUES ('$ime','$cena', '$slikaEkstenzija', '$opis', '$popust', '$kategorija', '$ime_firme', 1)";
    echo "inserted";
    if ($conn->query($sql) === FALSE) {
        echo "Greska: " . $sql . "<br>" . $conn->error;
    }
    $slikaID = $conn->insert_id;
}
$conn->close();

if ($slikaDobra){
    if (move_uploaded_file($_FILES["file"]["tmp_name"], "../artikliSlike/" . $slikaID . "." . $slikaEkstenzija)) {
        echo "<script type=\"text/javascript\">alert(\"Fajl je uspešno otpremljen!\");</script>";
    }
}


?>