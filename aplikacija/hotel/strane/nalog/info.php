<?php
session_start();
include('../../db.php');

if (isset($_SESSION['pin'])) {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Izmenite informacije</title>
        <link href="../../slike/tab-logo.png" rel="icon">
        <link rel="stylesheet" href="password.css">
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </head>

    <body>
        <div class="container">
            <div class="d-flex justify-content-center align-items-center" style="min-height: 85vh;">
                <form class="p-5 rounded shadow" action="profile_db.php" method="POST" enctype="multipart/form-data" style="width: 30rem; background-color: #fff;">
                    <?php
                    $currentUser = $_SESSION['ime_firme'];
                    $sql = "SELECT * FROM registracija WHERE ime_firme ='$currentUser'";

                    $gotResuslts = mysqli_query($conn, $sql);

                    if ($gotResuslts) {
                        if (mysqli_num_rows($gotResuslts) > 0) {
                            while ($row = mysqli_fetch_array($gotResuslts)) {
                    ?>
                                <ion-icon name="arrow-back-outline" style="margin-top: -5%; float: left; font-size: 22px; cursor: pointer" class="exit"></ion-icon><br><br>
                                <?php if (isset($_GET['error'])) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?= "Morate popuniti sva polja!" ?>
                                    </div>
                                <?php } ?>
                                <?php if (isset($_GET['success'])) { ?>
                                    <div class="alert alert-success" role="alert">
                                        <?= "Profil je ažuriran" ?>
                                    </div>
                                <?php } ?>
                                <label for="userIme">Ime</label><br><br>
                                <input type="text" name="userIme" id="ime" class="form-control" value="<?php echo $row['ime']; ?>"><br>
                                <label for="userPrezime">Prezime</label><br><br>
                                <input type="text" name="userPrezime" id="prezime" class="form-control" value="<?php echo $row['prezime']; ?>"><br>
                                <label for="updateUserName">Ime firme</label><br><br>
                                <input type="text" disabled name="updateUserName" id="ime_firme" class="form-control" value="<?php echo $row['ime_firme']; ?>" style="background: #dddddd;"><br>
                                <label for="userEmail">Email</label><br><br>
                                <input type="email" name="userEmail" class="form-control" id="email" value="<?php echo $row['email']; ?>"><br>
                                <label for="userBrojtelefona">Broj telefona</label><br><br>
                                <input type="text" name="userBrojtelefona" class="form-control" id="broj_telefona" value="<?php echo $row['broj_telefona']; ?>"><br>
                                <label for="userPin">Pin</label><br><br>
                                <input type="password" name="userPin" class="form-control" id="pin" value="<?php echo $row['pin']; ?>"><br><br>
                                <input type="submit" name="update" id="submit-btn" class="btn2" value="Ažuriraj">
                    <?php
                            }
                        }
                    }
                    ?>
                </form>
            </div>
        </div>
        <script>
            const izlaz = document.querySelector('.exit');
            izlaz.addEventListener('click', exit);

            function exit() {
                window.location.href = 'profile.php';
            }

            const btn = document.getElementById("submit-btn");
            const ime = document.getElementById("ime");
            const prezime = document.getElementById("prezime");
            const broj_telefona = document.getElementById("broj_telefona");
            const email = document.getElementById("email");
            const pin = document.getElementById("pin");

            function activate() {
                btn.disabled = false;
            }

            function deactivate() {
                btn.disabled = true;
            }

            function check() {
                if (ime.value != '' && email.value != '' && prezime.value != '' && broj_telefona.value != '' && pin.value != '' && pin.value.length === 4) {
                    activate()
                } else {
                    deactivate()
                }
            }

            ime.addEventListener('input', check)
            email.addEventListener('input', check)
            prezime.addEventListener('input', check)
            broj_telefona.addEventListener('input', check)
            pin.addEventListener('input', check)
        </script>
    </body>

    </html>
<?php
} else {
    header('Location: pin.php');
}
