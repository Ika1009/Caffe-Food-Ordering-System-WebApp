<?php
session_start();

if (isset($_SESSION['email'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="ponuda.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        <script src="https://kit.fontawesome.com/a572b64406.js" crossorigin="anonymous"></script>
        <script src="ponuda.js" defer></script>
        <title>Ponuda</title>
        <link href="../../slike/hurryup_logo2.ico" rel="icon">
    </head>

    <body>
        <header>
            <a class="logo"><img src="../../slike/hurryup_logo2-removebg-preview.jpg" alt="logo" width="auto" height="77px"></a>
            <nav>
                <ul class="nav__links">
                    <li><a href="../narudzbine/narudzbine.php">Narudzbine</a></li>
                    <li><a href="../artikli/artikli.php">Artikli</a></li>
                    <li><a class="active" href="ponuda.php">Ponuda</a></li>
                </ul>
            </nav>
            <a class="cta"  href="../../login.php" style="opacity: 0;">Prijavi se</a>
        </header>

        <div class="overlay">
            <a class="close">&times;</a>
            <div class="overlay__content">
                <a href="../narudzbine/narudzbine.php">Narudzbine</a>
                <a class="active" href="artikli.php">Artikli</a>
                <a href="../ponuda/ponuda.php">Ponuda</a>
            </div>
        </div>

        <div class="divfiltersearch">
            <div class="dropdown">
                <button id="dugfilter" role="button"><i class="fa-solid fa-filter" id="filter"></i></button>
                <div id="myDropdown" class="dropdown-content hide">
                </div>
            </div>
            <form>
                <input class="search" type="text" id="search-item" placeholder="Pretraži" onkeyup="search()" />
            </form>
        </div>

        <div class="form-modal">
            <div class="text" id="data">
                <!-- nalaze se ovde produkti -->
            </div>
        </div>




        <div class="divdugmenaruci" id="sakrij" hidden>
            <button class="button-27" role="button">Naruči za <span>0</span></button>
        </div>
        <div class="popup-overlay">
            <div class="popup-box-container">
                <div class="cart">
                    <ion-icon name="close-outline" class="exit"></ion-icon><br>
                    <h2 class="cart-title">Rezime narudžbine</h2>

                    <div class="wrapper">
                        <div class="cart-content">
                            <div class="cart-box">
                                <img hidden class="cart-img">
                                <div class="detail-box">
                                    <div hidden class="cart-product-title"></div>
                                    <div hidden class="cart-price">0</div>
                                    <input hidden type="number" min="0" value="1" class="cart-quantity" font-family="Roobert, -apple-system, BlinkMacSystemFont, Segoe UI, Helvetica, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="total">
                        <div class="total-title">Ukupno</div>
                        <div class="total-price" id="ukupno">0 RSD</div>
                    </div>
                </div>
                <form action="narudzbina.php" method="post">
                    <button type="submit" name="order" onclick="setCookie()" class="ok-btn">Potrvdi narudzbinu</button>
                </form>
            </div>
        </div>
        </div>
    </body>

    </html>
<?php
} else {
    header('Location: ../../prijava/login.php');
}
