<?php
session_start();

if (isset($_SESSION['email'])) {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/a572b64406.js" crossorigin="anonymous"></script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        <title>Narudzbine</title>
        <link rel="stylesheet" href="narudzbine.css">
        <link href="../../slike/hurryup_logo2.ico" rel="icon">
    </head>

    <body>

        </script>
        <header>
            <a class="logo"><img src="../../slike/hurryup_logo2-removebg-preview.png" alt="logo" width="auto" height="77px"></a>
            <nav>
                <ul class="nav__links">
                    <li><a class="active" href="/narudzbine.php">Narudzbine</a></li>
                    <li><a href="../artikli/artikli.php">Artikli</a></li>
                    <li><a href="../ponuda/ponuda.php">Ponuda</a></li>
                </ul>
            </nav>
            <a class="cta" href="../../login.php">Prijavi se</a>
            <p class="menu cta">Menu</p>
        </header>
        <div class="overlay">
            <a class="close">&times;</a>
            <div class="overlay__content">
                <a href="../narudzbine/narudzbine.php">Narudzbine</a>
                <a class="active" href="artikli.php">Artikli</a>
                <a href="../ponuda/ponuda.php">Ponuda</a>
            </div>
        </div>


        <div class="form-modal">
            <img class="restoran" src="../../slike/restoran.jpg">
            <div class="duzina1">1</div>
            <div class="duzina2">2</div>
            <div class="duzina3">3</div>
            <div class="duzina4">4</div>
            <div class="duzina5">5</div>
            <div class="duzina6">6</div>
            <div class="duzina7">7</div>
            <div class="duzina8">8</div>
            <div class="duzina9">9</div>
            <div class="duzina10">10</div>
            <div class="duzina11">11</div>
            <div class="duzina12">12</div>

            <div class="popup-box-container">
                <div class="products-container" id="ispis">

                </div>
            </div>
        </div>

        <script src="narudzbine.js"> </script>



    </body>
    <script>
        function toggleIzvrsene() {
            document.getElementById("aktivne-toggle").style.backgroundColor = "#f9f9f9";
            document.getElementById("aktivne-toggle").style.color = "#333";
            document.getElementById("izvrsene-toggle").style.backgroundColor = "#333";
            document.getElementById("izvrsene-toggle").style.color = "#ffb266";
            document.getElementById("odbijene-toggle").style.backgroundColor = "#f9f9f9";
            document.getElementById("odbijene-toggle").style.color = "#333";
            document.getElementById("divaktivne").style.display = "none";
            document.getElementById("divizvrsene").style.display = "block";
            document.getElementById("divodbijene").style.display = "none";
        }

        function toggleAktivne() {
            document.getElementById("aktivne-toggle").style.backgroundColor = "#333";
            document.getElementById("aktivne-toggle").style.color = "#ffb266";
            document.getElementById("izvrsene-toggle").style.backgroundColor = "#f9f9f9";
            document.getElementById("izvrsene-toggle").style.color = "#333";
            document.getElementById("odbijene-toggle").style.backgroundColor = "#f9f9f9";
            document.getElementById("odbijene-toggle").style.color = "#333";
            document.getElementById("divaktivne").style.display = "block";
            document.getElementById("divizvrsene").style.display = "none";
            document.getElementById("divodbijene").style.display = "none";
        }

        function toggleOdbijene() {
            document.getElementById("aktivne-toggle").style.backgroundColor = "#f9f9f9";
            document.getElementById("aktivne-toggle").style.color = "#333";
            document.getElementById("izvrsene-toggle").style.backgroundColor = "#f9f9f9";
            document.getElementById("izvrsene-toggle").style.color = "#333";
            document.getElementById("odbijene-toggle").style.backgroundColor = "#333";
            document.getElementById("odbijene-toggle").style.color = "#ffb266";
            document.getElementById("divaktivne").style.display = "none";
            document.getElementById("divizvrsene").style.display = "none";
            document.getElementById("divodbijene").style.display = "block";
        }
    </script>

    </html>
<?php
} else {
    header('Location: ../../prijava/login.php');
}
