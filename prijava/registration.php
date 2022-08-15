<?php
    session_start();

    if (!isset($_SESSION['email'])) {
        if (!isset($_SESSION['admin'])) {
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Registracija</title>
        <link href="../../slike/hurryup_logo2.ico" rel="icon">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <script src="script.js" defer></script>
        <style>
            ul {
                display: block; list-style-type: disc; margin-top: 0em; margin-bottom: 0em; margin-left: 0; margin-right: 0; padding-left: 40px; color: red;
            }
        </style>
    </head>
    <body>
        <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;"> 
            <form class="p-5 rounded shadow" action="registracija.php" method="post" style="width: 30rem;">
                <?php if (isset($_GET['error'])) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?=htmlspecialchars($_GET['error'])?>
                        </div>
                <?php } ?>
                <?php if (isset($_GET['success'])) { ?>
                        <div class="alert alert-success" role="alert">
                            <?="Uspešno ste se registrovali! "?><a style="text-decoration: none;" href="login.php">Prijavite se</a>
                        </div>
                <?php } ?>
                <div><input id="ime" type="text" name="ime" class="form-control" autocomplete="off" required placeholder="Ime" /></div><br>
                <div><input id="prezime" type="text" name="prezime" class="form-control" autocomplete="off" required placeholder="Prezime" /></div><br>
                <div><input id="ime_firme" type="text" name="ime_firme" class="form-control" autocomplete="off" required placeholder="Ime firme" /></div><br>
                <div><input id="email" type="email" name="email" class="form-control" autocomplete="off" required placeholder="Email" /></div><br>
                <div><input id="broj_telefona" type="text" name="broj_telefona" class="form-control" autocomplete="off" placeholder="Broj telefona" /></div><br>
                <div><input id="lozinka" type="password" name="lozinka" class="form-control" autocomplete="off" required placeholder="Lozinka" /></div><br>
                <div><input id="confirm_password" type="password" name="confirm_password" class="form-control" autocomplete="off" required placeholder="Potvrdi lozinku" /></div><br>
                <div><input id="pin" type="password" name="pin" class="form-control" autocomplete="off" required placeholder="Pin" /></div><br>
                <div><input id="confirm_pin" type="password" name="confirm_pin" class="form-control" autocomplete="off" required placeholder="Potvrdi pin" /></div><br>
                <button type="submit" name="register" onclick="setCookie()" id="submit-btn" class="btn" style="background-color: #333; color: #9473f5;">Registruj se</button><br><br>
                <p>Već imate nalog? <a style="text-decoration: none; color: #9473f5;" href="login.php">Prijavite se</a></p>
                <hr />
            </form>
        </div>
        <script>
            const btn = document.getElementById("submit-btn");
            const ime = document.getElementById("ime");
            const prezime = document.getElementById("prezime");
            const ime_firme = document.getElementById("ime_firme");
            const email = document.getElementById("email");
            const lozinka = document.getElementById("lozinka");
            const potvrdi_lozinku = document.getElementById("confirm_password");
            const pin = document.getElementById("pin");
            const potvrdi_pin = document.getElementById("confirm_pin");
            deactivate()

            function activate() {
                btn.disabled = false;
            }

            function deactivate() {
                btn.disabled = true;
            }

            function check() {
                if (ime.value != '' && email.value != '' && prezime.value != '' && ime_firme.value != '' && lozinka.value != '' && potvrdi_lozinku.value != '' && pin.value != '' && potvrdi_pin.value != '' && pin.value.length === 4 && potvrdi_pin.value.length === 4 && lozinka.value.length >= 8) {
                    activate()
                } else {
                    deactivate()
                }
            }

            ime.addEventListener('input', check)
            email.addEventListener('input', check)
            prezime.addEventListener('input', check)
            ime_firme.addEventListener('input', check)
            lozinka.addEventListener('input', check)
            potvrdi_lozinku.addEventListener('input', check)
            pin.addEventListener('input', check)
            potvrdi_pin.addEventListener('input', check)
        </script>
    </body>
</html>
<?php
    } else {
        header('Location: admin.php');
    }} else {
        header('Location: ponuda.php');
    }