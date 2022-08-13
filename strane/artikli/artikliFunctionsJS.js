

function dugmeZaMenjanje(element) {

    let elementos = element.closest('.product');

    let id = elementos.getElementsByClassName('id_artikla')[0].getAttribute("data-id");
    let ime = elementos.getElementsByTagName('h3')[0].innerHTML;
    let slika = elementos.getElementsByTagName('img')[0].getAttribute("src");
    let cena;
    let popust;
    if (typeof (elementos.getElementsByClassName('priceprecrtano')[0]) == "undefined") {
        cena = elementos.getElementsByClassName('price')[0].innerHTML;
        popust = 0;
    }
    else {
        cena = elementos.getElementsByClassName('priceprecrtano')[0].innerHTML;
        popust = elementos.getElementsByClassName('disc')[0].innerHTML;
    }
    let opis = elementos.getElementsByClassName('desc')[0].innerHTML;
    let kategorija = elementos.getElementsByClassName('cat')[0].innerHTML;


    document.querySelectorAll(".artikl_input_id")[0].value = id;
    document.querySelectorAll(".artikl_input_ime")[0].value = ime;
    document.querySelectorAll(".artikl_input_cena")[0].value = parseInt(cena);
    document.querySelectorAll(".artikl_input_popust")[0].value = parseInt(popust);
    document.querySelectorAll(".artikl_input_opis")[0].value = opis;
    document.querySelectorAll(".artikl_input_kategorija")[0].value = kategorija;

    otvoriPopup();


    console.log("kliknuto dugme");
}
// za brisanje
function onClickDugmeZaBrisanje(element) {
    let nastavitiProvera = confirm("Jel ste sigurni da želite da obrišete ovaj artikal?");
    console.log(nastavitiProvera); // OK = true, Cancel = false
    if (nastavitiProvera == false) {
        return;
    }

    //cookie
    let elementos = element.closest('.product');
    let ime = elementos.getElementsByTagName('h3')[0].innerHTML;
    let id = elementos.getElementsByClassName('id_artikla')[0].getAttribute("data-id");

    let slika = elementos.getElementsByTagName('img')[0].getAttribute("src");
    //let popUpDugme = document.getElementById();
    let ajax = new XMLHttpRequest();
    ajax.open("GET", "./APIs/delete.php?id=" + id, true);
    ajax.send();
    ajax.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let data = this.responseText;
            /*if (data.contains("deleted")) {
                elementos.remove();
            } else { alert("Došlo je do greške! Molim Vas pokušajte ponovo."); }*/
            elementos.remove();
        }
    };

    //setCookie(elementos.textContent);
    //console.log(elementos.textContent);

    console.log("kliknuto dugme");
    elementos.remove()

}
const search = () => {
    const searchbox = document.getElementById("search-item").value.toUpperCase();
    const storeitems = document.getElementById("data");
    const product = document.querySelectorAll(".product");
    const productname = storeitems.getElementsByTagName("h3");

    for (let i = 0; i < productname.length; i++) {
        let match = product[i].getElementsByTagName("h3")[0];

        if (match) {
            let textvalue = match.textContent || match.innerHTML

            if (textvalue.toUpperCase().indexOf(searchbox) > -1) {
                product[i].style.display = "";
            } else {
                product[i].style.display = "none";
            }
        }
    }
}
const navToggler = document.querySelector(".nav-toggler");
navToggler.addEventListener("click", navToggle);

function navToggle() {
    navToggler.classList.toggle("active");
    const nav = document.querySelector(".nav");
    nav.classList.toggle("open");
    if (nav.classList.contains("open")) {
        nav.style.maxHeight = nav.scrollHeight + "px";
    } else {
        nav.removeAttribute("style");
    }
}

document.querySelector("#rmv").addEventListener("click", function (event) {
    var kategorije = document.getElementById("kategorije")
    let ajax = new XMLHttpRequest();
    ajax.open("GET", "./APIs/deleteKategorija.php?obrisiKategoriju=" + kategorije.getElementsByTagName("option")[kategorije.selectedIndex].innerHTML, true);
    ajax.send();
    ajax.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let data = this.responseText;
            if (data == "deleted") {
                kategorije.remove(kategorije.selectedIndex);
            }
        }
    };
});

document.querySelector("#dodajopciju").addEventListener("click", function (event) {
    event.preventDefault();
    // console.log("alo");
    var txt = document.getElementById("add-box");
    var kategorije = document.getElementById("kategorije");
    var option = document.createElement("option");
    option.text = txt.value;
    kategorije.add(option);
    kategorije.selectedIndex = kategorije.length - 1;
    console.log(kategorije.selectedIndex);
    let ajax = new XMLHttpRequest();
    ajax.open("GET", "./APIs/dodajKategoriju.php?addNewCategory=" + txt.value, true);
    ajax.send();
    ajax.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let data = this.responseText;
            if (data == "success") {

            }
        }
    };
});
var add_artikl_pom = 0;

document.querySelector("#artikl_form").addEventListener("submit", function (event) {
    event.preventDefault();
    console.log("alo");

    var artikl_form = document.getElementById("artikl_form");

    var form_for_sending = new FormData(artikl_form);

    let ajax = new XMLHttpRequest();
    ajax.open("POST", "./APIs/article_add.php", true);
    ajax.send(form_for_sending);
    ajax.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let response = this.responseText;
            console.log(response);
            if (response == "updatedWithImage" || response == "updated!image") { // ne ulazi ovde uopste ?
                // console.log("updatedWithImage");
                let ajax = new XMLHttpRequest();
                document.getElementById("data").innerHTML = "<div class=divdugme>";
                document.getElementById("data").innerHTML += "<button type=dodaj class=dugmeZaDodavanje onclick=otvoriPopup('novi_kreiram')>";
                document.getElementById("data").innerHTML += "<ion-icon name=add class=hydrated aria-label=add></ion-icon></i>";
                document.getElementById("data").innerHTML += "</button>";
                document.getElementById("data").innerHTML += "</div>";

                ajax.open("GET", "./APIs/data.php", true);
                ajax.send();
                ajax.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        let data = JSON.parse(this.responseText);
                        let html = "";
                        for (let i = 0; i < data.length; i++) {
                            let id = data[i].id;
                            let ime = data[i].ime;
                            let cena = data[i].cena;
                            let slika = data[i].slika;
                            let opis = data[i].opis;
                            let popust = data[i].popust;
                            let kategorija = data[i].kategorija;
                            html += "<div class=product>";
                            html += "<input class=\"id_artikla\" data-id=\"" + id + "\" type=\"hidden\">";
                            html += "<div class=divdugizlaz>";
                            html += "<img src=artikliSlike/" + id + "." + slika + ">";
                            html += "<ion-icon class=dugizlaz name=close-outline onclick=onClickDugmeZaBrisanje(this)>Edit</ion-icon>";
                            html += "<ion-icon class=dugedit name=pencil onclick=dugmeZaMenjanje(this)></ion-icon><br><br>";
                            html += "</div>";
                            html += "<div class=imecenakat>"
                            if (popust != '0') {
                                html += "<div class=disc>" + popust + "%</div>";
                            }
                            html += "<h3>" + ime + "</h3>";
                            html += "<p class=cat>" + kategorija + "</p>";
                            if (popust != '0') {
                                html += "<div class=divcena>"
                                html += "<div class=price>" + cena * (100 - parseInt(popust)) / 100 + " RSD</div>";
                                html += "<div class=priceprecrtano>" + cena + " RSD</div>"; // precrtaj
                                html += "</div>"
                            } else {
                                html += "<div class=price>" + cena + " RSD</div>";
                            }
                            html += "<p class=desc>" + opis + "</p>";
                            html += "</div>"
                            html += "</div>";
                        }
                        document.getElementById("data").innerHTML += html;
                    }
                };
            }
            else {
                console.log("bban");
                let data = new Object();
                for (const key of form_for_sending.keys()) {
                    data[key] = form_for_sending.get(key);
                }
                console.log(data);


                let html = "";
                let id = data.id;
                let ime = data.ime;
                let cena = data.cena;
                let slika = data.slika;
                let opis = data.opis;
                let popust = data.popust;
                let kategorija = data.kategorija;
                // var blob = new Blob();
                html += "<div class=product>";
                html += "<input class=\"id_artikla\" data-id=\"" + id + "\" type=\"hidden\">";
                html += "<div class=divdugizlaz>";
                html += "<img id=\"artikl_slika_" + ++add_artikl_pom + "\" src=" + data.file + ">";
                html += "<ion-icon class=dugizlaz name=close-outline onclick=onClickDugmeZaBrisanje(this)>Edit</ion-icon>";
                html += "<ion-icon class=dugedit name=pencil onclick=dugmeZaMenjanje(this)></ion-icon><br><br>";
                html += "</div>";
                html += "<div class=imecenakat>"
                if (popust != '0') {
                    html += "<div class=disc>" + popust + "%</div>";
                } else {
                    html += "<div class=disc>" + popust + "%</div>";

                }
                html += "<h3>" + ime + "</h3>";
                html += "<p class=cat>" + kategorija + "</p>";
                if (popust != '0') {
                    html += "<div class=divcena>"
                    html += "<div class=price>" + cena * (100 - parseInt(popust)) / 100 + " RSD</div>";
                    html += "<div class=priceprecrtano>" + cena + " RSD</div>"; // precrtaj
                    html += "</div>"
                } else {
                    html += "<div class=price>" + cena + " RSD</div>";
                }
                html += "<p class=desc>" + opis + "</p>";
                html += "</div>"
                html += "</div>";
                document.getElementById("data").innerHTML += html;


                var prikaz = form_for_sending.get("file");
                var fr = new FileReader();
                fr.onload = imageHandler;
                fr.readAsDataURL(prikaz);
                //if (data == "success") {
                function imageHandler(e2) {
                    var store = document.getElementById('artikl_slika_' + add_artikl_pom);
                    store.src = e2.target.result;
                }
                //}
            }

        }
    };
});

