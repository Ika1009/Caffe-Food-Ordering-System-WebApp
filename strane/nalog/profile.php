<?php
session_start();

if (isset($_SESSION['email'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/a572b64406.js" crossorigin="anonymous"></script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/a572b64406.js" crossorigin="anonymous"></script>
        <title>Moj nalog</title>
        <link href="../../slike/tab-logo.png" rel="icon">
        <link rel="stylesheet" href="profile.css">
    </head>

    <body>
    <header>
            <a class="logo"><img src="../../slike/lets-order-logo.png" alt="logo" width="auto" height="77px"></a>
            <nav>
                <ul class="nav__links">
                    <li><a href="../narudzbine/narudzbine.php">Narudzbine</a></li>
                    <li><a href="../artikli/artikli.php">Artikli</a></li>
                    <li><a href="../ponuda/ponuda.php">Ponuda</a></li>
                </ul>
            </nav>
            <div class="dropdown">
                <button id="cta" class="cta"><i class="fa-solid fa-user"></i></button>
                <div id="myDropdown" class="dropdown-content hide">
                    <a href="../nalog/profile.php">Moj Nalog</a>
                    <a>Statistika</a>
                </div>
            </div>
        </header>
        <div class="overlay">
            <a class="close">&times;</a>
            <div class="overlay__content">
                <a href="../narudzbine/narudzbine.php">Narudzbine</a>
                <a class="active" href="artikli.php">Artikli</a>
                <a href="../ponuda/ponuda.php">Ponuda</a>
            </div>
        </div>

        <div class="p-5 rounded shadow custom-justify-content align-items-center d-flex flex-column" style="border-radius: 20px; width: 50%; height: 55vh; margin-left: auto; margin-right: auto; padding: 20px;">
            <i class="bi bi-person-fill" style="font-size: 14rem"></i>
            <h1 class="text-center display-4" style="margin-top: -10px; font-size: 2rem;"><?= $_SESSION['ime_firme'] ?></h1>
            <a href="info.php" class="btn btn-info">Izmeni informacije</a>
            <a href="password.php" class="btn btn-change">Promeni lozinku</a>
            <a href="../../prijava/logout.php" class="btn btn-warning">Odjava</a>
        </div>

    <script>
        const dugme1 = document.getElementById("cta");
        const dropdown = document.getElementById("myDropdown");
        dugme1.addEventListener("click", () => {
            if (dropdown.classList.contains('show')) {
                dropdown.classList.remove("show");
                dropdown.classList.add("hide");
            } else {
                dropdown.classList.remove("hide");
                dropdown.classList.add("show");
            }
        });
    </script>
    </body>

    </html>
<?php
} else {
    header('Location: ../../prijava/login.php');
}
