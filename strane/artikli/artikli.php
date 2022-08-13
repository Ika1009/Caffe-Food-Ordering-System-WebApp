<?php
session_start();

if (isset($_SESSION['user_pin'])) {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/a572b64406.js" crossorigin="anonymous"></script>
        <title>Artikli</title>
        <link href="../../slike/hurryup_logo2.ico" rel="icon">
        <link rel="stylesheet" href="artikli.css">

    </head>

    <body>
        <header>
            <a class="logo"><img src="../../slike/hurryup_logo2-removebg-preview.png" alt="logo" width="auto" height="77px"></a>
            <nav>
                <ul class="nav__links">
                    <li><a href="../narudzbine/narudzbine.php">Narudzbine</a></li>
                    <li><a class="active" href="artikli.php">Artikli</a></li>
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
                <div class="divdugme">
                    <button type="dodaj" class="dugmeZaDodavanje" onclick="otvoriPopup('novi_kreiram')">
                        <ion-icon name="add"></ion-icon></i>
                    </button>

                </div>
            </div>
        </div>


        <div class="popup-overlay1" id="popup-overlay1">
            <div class="popup" id="popup">
                <button class="btn" onclick="ZatvoriPopUp()"><i class="fa fa-close"></i></button>
                <h3 class="naslov"></h3>
                <div id="signup-form">
                    <form id="artikl_form" class="forma" name="form1" action="" method="post" enctype="multipart/form-data">
                        <div class="fajl">
                            <input class="file" id="file" type="file" name="file" accept=".png, .jpg, .jpeg" required>
                            <label for="file" class="upload-label">
                                <div class="image">
                                    <img src="" alt="">
                                </div>
                                <ion-icon name="cloud-upload"></ion-icon>
                                <p class="drag_text"> Prevuci da otpremis fajl</p>
                                <button class="choose-file">Izaberi Fajl</button>
                            </label>
                        </div>
                        <input class="popuptext artikl_input_id" id="artikl_input_id" type="hidden" name="id" required placeholder="Id Artikla" />
                        <input class="popuptext artikl_input_ime" id="ime" type="text" name="ime" required placeholder="Ime Artikla" />
                        <input class="popuptext artikl_input_cena" id="cena" min="0" type="number" name="cena" required placeholder="Cena  (RSD)" />
                        <input class="popuptext artikl_input_popust" id="popust" type="number" min="0" name="popust" required placeholder="Popust  (%)" />
                        <select class="kategorija artikl_input_kategorija" name="kategorija" id="kategorije" required>
                            <option class="kategorija-naslov" value="" selected disabled hidden>Izaberi kategoriju</option>
                        </select><br>
                        <button class="dugdodajkategoriju">dodaj kategoriju</button>
                        <div class="popup-box-container">
                            <div class="products-container">
                                <button class="btn1"><i class="fa fa-close"></i></button>
                                <input class="popuptext1" id=add-box name="dodavanjeBox" placeholder="ime kategorije">
                                <div class="divokbtn">
                                    <input class="ok-btn" type="submit" value="dodaj" id="dodajopciju" name="dodajKategoriju">
                                    <input class="ok-btn1" type="button" value="remove" id="rmv">
                                </div>
                            </div>
                        </div>
                        <textarea style="resize: none;" class="opis artikl_input_opis" id="opis" type="text" name="opis" placeholder="Opis"></textarea>
                        <button class="submit" type="submit" name="article_add" id="popupDugme" value="add">Dodaj</button>
                    </form>
                </div>
            </div>
        </div>
        <script src="artikliJS.js"></script>
        <script src="artikliFunctionsJS.js"></script>
        <script>
            let popup = document.getElementById("popup-overlay1");
            let poputp = document.getElementById("popup")

            function otvoriPopup(novi_kreiram) {
                if (novi_kreiram) {
                    document.querySelectorAll(".artikl_input_id")[0].value = '';
                    document.querySelectorAll(".artikl_input_ime")[0].value = '';
                    document.querySelectorAll(".artikl_input_cena")[0].value = '';
                    document.querySelectorAll(".artikl_input_popust")[0].value = '';
                    document.querySelectorAll(".artikl_input_opis")[0].value = '';
                    document.querySelectorAll(".artikl_input_kategorija")[0].value = '';
                }
                popup.classList.add("aktivanpopup");
                poputp.classList.add("otvori-Popup");
            }

            function ZatvoriPopUp() {
                popup.classList.remove("aktivanpopup");
                poputp.classList.add("otvori-Popup");
            }


            const naruci = document.querySelector('.dugdodajkategoriju');
            const okbtn = document.querySelector('.ok-btn');
            const okbtn1 = document.querySelector('.ok-btn1');
            const btn1 = document.querySelector('.btn1');
            const popupbox = document.querySelector('.popup-box-container');

            naruci.addEventListener('click', () => {
                popupbox.classList.add('aktivanpopup');
            })

            okbtn.addEventListener('click', () => {
                popupbox.classList.remove('aktivanpopup');
            })

            okbtn1.addEventListener('click', () => {
                popupbox.classList.remove('aktivanpopup');
            })
            btn1.addEventListener('click', () => {
                popupbox.classList.remove('aktivanpopup');
            })
        </script>
    </body>

    </html>
<?php
} else {
    header('Location: login.php');
}
