<?php
session_start();

if (isset($_SESSION['userpin'])) {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Promeni lozinku</title>
        <link href="../../slike/tab-logo.png" rel="icon">
        <link rel="stylesheet" href="password.css">
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </head>

    <body>
        <div class="container">
            <div class="d-flex justify-content-center align-items-center" style="min-height: 85vh;">
                <form class="p-5 rounded shadow" action="password_db.php" method="POST" enctype="multipart/form-data" style="width: 30rem; background-color: #fff;">
                    <?php if (isset($_GET['error'])) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?= htmlspecialchars($_GET['error']) ?>
                        </div>
                    <?php } ?>
                    <ion-icon name="arrow-back-outline" style="margin-top: -5%; float: left; font-size: 22px; cursor: pointer" class="exit"></ion-icon><br>
                    <br><label for="userPin">Stara lozinka</label><br><br>
                    <input type="password" name="userPassword" id="fname" class="form-control"><br>
                    <label for="userPin">Nova lozinka</label><br><br>
                    <input type="password" name="userPasswordNew" id="email" class="form-control"><br>
                    <label for="userPin">Potvrdi novu lozinku</label><br><br>
                    <input type="password" name="userPasswordNewConfirm" id="confirm" class="form-control"><br>
                    <input type="submit" name="update" id="submit-btn" class="btn2" value="Potvrdi">
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
            const fname = document.getElementById("fname");
            const email = document.getElementById("email");
            const confirm = document.getElementById("confirm");
            deactivate()

            function activate() {
                btn.disabled = false;
            }

            function deactivate() {
                btn.disabled = true;
            }

            function check() {
                if (fname.value != '' && email.value != '' && confirm.value != '') {
                    activate()
                } else {
                    deactivate()
                }
            }

            fname.addEventListener('input', check)
            email.addEventListener('input', check)
            confirm.addEventListener('input', check)
        </script>
    </body>

    </html>
<?php
} else {
    header('Location: login.php');
}
