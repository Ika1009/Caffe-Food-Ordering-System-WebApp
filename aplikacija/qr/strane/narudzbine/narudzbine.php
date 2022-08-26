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
        <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/a572b64406.js" crossorigin="anonymous"></script>
        <title>Narudzbine</title>
        <link rel="stylesheet" href="narudzbine.css">
        <link href="../../slike/tab-logo.png" rel="icon">
    </head>

    <body>

        </script>
        <header>
            <a class="logo"><img src="../../../../slike/lets-order-logo.png" alt="logo" width="auto" height="77px"></a>
            <nav>
                <ul class="nav__links">
                    <li><a class="active" href="/narudzbine.php">Orders</a></li>
                    <li><a href="../artikli/artikli.php">Products</a></li>
                    <li><a href="../ponuda/ponuda.php">Menu</a></li>
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


        <div class="form-modal" id="slika">
            <img class="restoran" src="../../../../slike/restoran.jpg">
            <div class="duzina1" onclick="ispisiNarudzbinuStola(this)">1
                <div class="notifikacija hide" id="notifikacija1">!</div>
            </div>
            <div class="duzina2" onclick="ispisiNarudzbinuStola(this)">2
                <div class="notifikacija hide" id="notifikacija2">!</div>
            </div>
            <div class="duzina3" onclick="ispisiNarudzbinuStola(this)">3
                <div class="notifikacija hide" id="notifikacija3">!</div>
            </div>
            <div class="duzina4" onclick="ispisiNarudzbinuStola(this)">4
                <div class="notifikacija hide" id="notifikacija4">!</div>
            </div>
            <div class="duzina5" onclick="ispisiNarudzbinuStola(this)">5
                <div class="notifikacija hide" id="notifikacija5">!</div>
            </div>
            <div class="duzina6" onclick="ispisiNarudzbinuStola(this)">6
                <div class="notifikacija hide" id="notifikacija6">!</div>
            </div>
            <div class="duzina7" onclick="ispisiNarudzbinuStola(this)">7
                <div class="notifikacija hide" id="notifikacija7">!</div>
            </div>
            <div class="duzina8" onclick="ispisiNarudzbinuStola(this)">8
                <div class="notifikacija hide" id="notifikacija8">!</div>
            </div>
            <div class="duzina9" onclick="ispisiNarudzbinuStola(this)">9
                <div class="notifikacija hide" id="notifikacija9">!</div>
            </div>
            <div class="duzina10" onclick="ispisiNarudzbinuStola(this)">10
                <div class="notifikacija hide" id="notifikacija10">!</div>
            </div>
            <div class="duzina11" onclick="ispisiNarudzbinuStola(this)">11
                <div class="notifikacija hide" id="notifikacija11">!</div>
            </div>
            <div class="duzina12" onclick="ispisiNarudzbinuStola(this)">12
                <div class="notifikacija hide" id="notifikacija12">!</div>
            </div>

            <div class="popup-box-container">
                <div class="products-container" id="ispis">

                </div>
                

            </div>
        </div>

        <script src="narudzbine.js"> </script>



    </body>
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


        const dugme = document.getElementById("stik");
        const dugx = document.getElementById("x");
        const notifikacija = document.getElementsByClassName("notifikacija");
        dugme.addEventListener("click", () => {
            for (let i = 0; i < notifikacija.length; i++) {
                notifikacija[i].classList.remove("show");
                notifikacija[i].classList.add("hide");
            }

        });
        dugx.addEventListener("click", () => {
            for (let i = 0; i < notifikacija.length; i++) {
                notifikacija[i].classList.remove("show");
                notifikacija[i].classList.add("hide");
            }
        });
    </script>

    </html>
<?php
} else {
    header('Location: ../../prijava/login.php');
}