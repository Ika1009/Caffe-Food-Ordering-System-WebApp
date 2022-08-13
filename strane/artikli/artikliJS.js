let ajax = new XMLHttpRequest();
ajax.open("GET", "./APIs/data.php", true);
ajax.send();
ajax.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
        let data = JSON.parse(this.responseText);
        console.log(data);
        let html = "";
        for (let i = 0; i < data.length; i++) {
            let id = data[i].id;
            let ime = data[i].ime;
            let cena = data[i].cena;
            let slika = data[i].slika;
            let opis = data[i].opis;
            let popust = data[i].popust;
            let kategorija = data[i].kategorija;
            html += "<div class=card>";
            html += "<input class=\"id_artikla\" data-id=\"" + id + "\" type=\"hidden\">";
            html += "<p hidden>" + kategorija + "</p>"
            html += "<div class=card-bg>";
            html += "<img src=artikliSlike/" + id + "." + slika + ">";
            html += "</div>";
            html += "<div class=card-context>";
            html += "<div class=dark-bg></div>";
            html += "<div class=ime><h2>" + ime + "</h2></div>";
            if (popust != '0') {
                html += "<div class=disc>" + popust + "%</div>";
            }

            if (popust != '0') {
                html += "<h3 class=price>" + cena * (100 - parseInt(popust)) / 100 + " RSD</h3>";
                html += "<h3 class=priceprecrtano>" + cena + " RSD</h3>"; // precrtaj
            } else {
                html += "<h3 class=price>" + cena + " RSD</h3>";
            }
            html += "<p>" + opis + "</p>";
            html += "</div>";
            html += "<div class=card-icons>";
            html += "<ul><li>"
            html += "<ion-icon name=close-outline onclick=onClickDugmeZaBrisanje(this)>Edit</ion-icon>";
            html += "</li><li>"
            html += "<ion-icon name=pencil onclick=dugmeZaMenjanje(this)>Delete</ion-icon>";
            html += "</li></ul>";
            html += "</div>";
            html += "</div>";



        }
        document.getElementById("data").innerHTML += html;
    }
};
let elementos = document.getElementById("kategorije")
let ajax1 = new XMLHttpRequest();
ajax1.open("GET", "./APIs/kategorijeDobivanje.php", true);
ajax1.send();
ajax1.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
        let data = JSON.parse(this.responseText);
        console.log(data);
        let html = "";
        for (let i = 0; i < data.length; i++) {
            let kategorija = data[i].ime_kategorije;
            var option = document.createElement("option");
            option.text = kategorija;
            elementos.add(option);
        }
    }
};