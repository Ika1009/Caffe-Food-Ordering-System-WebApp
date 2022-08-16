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
        <title>Prijava</title>
        <link href="../../slike/tab-logo.png" rel="icon">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    </head>
    <body>
        <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;"> 
            <form class="p-5 rounded shadow" action="auth.php" method="post" style="width: 30rem;">
                <?php if (isset($_GET['error'])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?=htmlspecialchars($_GET['error'])?>
                    </div>
                <?php } ?>
                <input type="text" name="ime_firme" id="ime_firme" autocomplete="off" value="<?php if (isset($_GET['ime_firme']))echo(htmlspecialchars($_GET['ime_firme'])) ?>" class="form-control" aria-describedby="emailHelp" placeholder="Ime firme"><br>  
                <input type="password" name="lozinka" id="lozinka" class="form-control" autocomplete="off" placeholder="Lozinka"></br>      
                <button type="submit" class="btn" id="submit-btn" style="background-color: #9473f5; color: #fff;">Prijavi se</button><br><br>
                <p>Nemate nalog? <a style="text-decoration: none; color: #9473f5;" href="registration.php">Registrujte se</a></p>
                <hr />
            </form>
        </div>
        <script>
            const btn = document.getElementById("submit-btn");
            const ime_firme = document.getElementById("ime_firme");
            const lozinka = document.getElementById("lozinka");
            deactivate()

            function activate() {
                btn.disabled = false;
            }

            function deactivate() {
                btn.disabled = true;
            }

            function check() {
                if (ime_firme.value != '' && lozinka.value != '') {
                    activate()
                } else {
                    deactivate()
                }
            }
            
            ime_firme.addEventListener('input', check)
            lozinka.addEventListener('input', check)
        </script>
    </body>
</html>
<?php
    } else {
        header('Location: ../admin/admin.php');
    }} else {
        header('Location: ../strane/ponuda/ponuda.php');
    }
    