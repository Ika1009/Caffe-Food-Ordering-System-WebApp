<?php
session_start();
include_once "../../../../db.php";
if (isset($_POST['pin'])) {
    $pin = $_POST['pin'];
    $ime_firme = $_SESSION['ime_firme'];
    
    if (empty($pin)) {
        header('Location: pin.php?error=Pin je obavezan');
    } else {
        $stmt = "SELECT * FROM registracija WHERE ime_firme='$ime_firme'";
        $result = mysqli_query($conn, $stmt);
        
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            if ($pin === $row['pin']) {
                $_SESSION['pin'] = $row['pin'];
                $_SESSION['start'] = time();
                $_SESSION['expire'] = $_SESSION['start'] + (0.1 * 60);
                header('Location: info.php');
            } else {
                header("Location: pin.php?error=Pogrešan pin&ime_firme=$ime_firme");
            }
        } else {
            header("Location: pin.php?error=Pogrešan pin&ime_firme=$ime_firme");
        }
    }
}