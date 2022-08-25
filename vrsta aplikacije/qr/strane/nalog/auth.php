<?php
session_start();
include '../../db.php';
if (isset($_POST['pin'])) {
    $pin = $_POST['pin'];
    $ime_firme = $_SESSION['ime_firme'];
    
    if (empty($pin)) {
        header('Location: login.php?error=Pin je obavezan');
    } else {
        $stmt = "SELECT * FROM registracija WHERE ime_firme='$ime_firme'";
        $result = mysqli_query($conn, $stmt);
        
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            if ($pin === $row['pin']) {
                $_SESSION['userpin'] = $row['pin'];
                $_SESSION['start'] = time();
                $_SESSION['expire'] = $_SESSION['start'] + (0.1 * 60);
                header('Location: password.php');
            } else {
                header("Location: login.php?error=Pogrešan pin&ime_firme=$ime_firme");
            }
        } else {
            header("Location: login.php?error=Pogrešan pin&ime_firme=$ime_firme");
        }
    }
}