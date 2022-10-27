<?php
session_start();
include '../db.php';

if (isset($_POST['ime_firme']) && isset($_POST['lozinka'])) {
    $ime_firme = $_POST['ime_firme'];
    $lozinka = $_POST['lozinka'];

    if (empty($ime_firme)) {
        header('Location: login.php?error=Ime firme je obavezno');
    } else if (empty($lozinka)) {
        header("Location: login.php?error=Lozinka je obavezna&ime_firme=$ime_firme");
    } else {
        $stmt = "SELECT * FROM registracija WHERE ime_firme='$ime_firme'";
        $result = mysqli_query($conn, $stmt);
        
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            $user_password = $row['lozinka'];
            if ($row['ime_firme'] === $ime_firme && password_verify($lozinka, $user_password)) {
                if ($ime_firme == "Hurry Up") {
                    $_SESSION['ime_firme'] = $row['ime_firme'];
                    $_SESSION['admin'] = $row['ime_firme'];
                    header('Location: ../admin/admin.php');
                } else {
                    $_SESSION['ime_firme'] = $row['ime_firme'];
                    $_SESSION['email'] = $row['email'];
                    header("Location: ../aplikacija/qr/strane/ponuda/ponuda.php");
                }
            } else {
                header("Location: login.php?error=Pogrešno ime firme ili lozinka&ime_firme=$ime_firme");
            }
        } else {
            header("Location: login.php?error=Pogrešno ime firme ili lozinka&ime_firme=$ime_firme");
        }
    }
}