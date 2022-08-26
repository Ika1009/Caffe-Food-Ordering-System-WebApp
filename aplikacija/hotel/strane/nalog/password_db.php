<?php
session_start();
include('../../db.php');

if(isset($_POST['update'])){
    $ime_firme = $_SESSION['ime_firme'];
    $mysql = "SELECT * FROM registracija WHERE ime_firme = '$ime_firme'";
    $gotResuslts = mysqli_query($conn, $mysql);
    
    if ($gotResuslts) {
        if (mysqli_num_rows($gotResuslts) > 0) {
            while ($row = mysqli_fetch_array($gotResuslts)) {
                $lozinka = $row['lozinka'];
            }
        }
    }

    $stara_lozinka = $_POST['userPassword'];
    $nova_lozinka = $_POST['userPasswordNew'];
    $potvrdi_novu_lozinku = $_POST['userPasswordNewConfirm'];

    if($nova_lozinka === $potvrdi_novu_lozinku && password_verify($stara_lozinka, $lozinka)){ 
        $nova_lozinka = password_hash($nova_lozinka, PASSWORD_DEFAULT);
        $potvrdi_novu_lozinku = password_hash($potvrdi_novu_lozinku, PASSWORD_DEFAULT);
        $sql = "UPDATE registracija SET lozinka = '$nova_lozinka' WHERE ime_firme = '$ime_firme'";
        $results = mysqli_query($conn,$sql);
        include('../../prijava/logout.php');
        header('Location:../../prijava/login.php');
        exit;
    } else if ($nova_lozinka !== $potvrdi_novu_lozinku) {
        header('Location:password.php?error=Lozinke se ne poklapaju');
    } else {
        header('Location:password.php?error=Stara lozinka je pogrešna');
    }}
?>