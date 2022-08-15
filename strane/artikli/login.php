<?php
    session_start();

    if (isset($_SESSION['email'])) {
        if (!isset($_SESSION['user_pin'])) {
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Prijava</title>
        <link href="../../slike/hurryup_logo2.ico" rel="icon">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </head>
    <body>
        <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh; text-align:center;"> 
            <form class="p-5 rounded shadow" action="auth.php" method="post" style="width: 30rem;">
                <?php if (isset($_GET['error'])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?=htmlspecialchars($_GET['error'])?>
                    </div>
                <?php } ?>
                <ion-icon name="arrow-back-outline" style="float: left; font-size: 22px; cursor: pointer" class="exit"></ion-icon><br>
                <i class="bi bi-person-fill" style="font-size: 10rem"></i><br><br>
                <h1 class="text-center display-4" style="margin-top: -50px; font-size: 2rem;"><?=$_SESSION['ime_firme']?></h1> 
                <input type="password" name="pin" id="pin" class="form-control" placeholder="Pin"></br>      
                <button type="submit" class="btn" id="submit-btn" style="background-color: #9473f5; color: #fff;">OK</button>
            </form>
        </div>
    </body>
    <script>
        const izlaz = document.querySelector('.exit');
        izlaz.addEventListener('click', exit);
        function exit() {
            history.back();
        }
        const pin = document.getElementById("pin");
        const btn = document.getElementById("submit-btn");
        deactivate()

        function activate() {
            btn.disabled = false;
        }

        function deactivate() {
            btn.disabled = true;
        }

        function check() {
            if (pin.value != '' && pin.value.length === 4) {
                activate()
            } else {
                deactivate()
            }
        }

        pin.addEventListener('input', check);
    </script>
</html>
<?php
    } else {
        header('Location: artikli.php');
    } } else {
        header('Location: ../../prijava/login.php');
    }