
let stolovi = document.getElementById("slika").children;

for (let i = 1; i < stolovi.length - 1; i++) {
    let broj_stola = stolovi[i].innerText.match(/(\d+)/)[0];
    //console.log(broj_stola)
    let ajax = new XMLHttpRequest();
    ajax.open("GET", "./APIs/data.php?broj_stola=" + broj_stola, true);
    ajax.send();
    ajax.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(this.responseText);
            //console.log(data);
            if (data.length != 0) {
                // ovde kod da se doda css atribut
                if (data[0].status == 'aktivna') {
                    stolovi[i].children[0].className = "notifikacija";
                }
            }
        }
    }
}


let trenutni_sto_ispisan;
function ispisiNarudzbinuStola(element) {

    let broj_stola = element.innerText.match(/(\d+)/)[0];
    trenutni_sto_ispisan = broj_stola;
    let ajax = new XMLHttpRequest();
    ajax.open("GET", "./APIs/data.php?broj_stola=" + broj_stola, true);
    ajax.send();
    ajax.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(this.responseText);

            if (data.length == 0) {
                document.getElementById("ispis").innerHTML = "";
                return;
            }
            
            for (let i = 0; i < data.length; i++) {

                if(data[i].status == 'izvrsena'){
                    document.getElementById("ispis").innerHTML = "";
                    continue;
                }

                let html = "";
                let id = data[0].id;
                let detalji = data[0].detalji;
                let ukupna_cena = data[i].ukupna_cena;
                let vreme_narucivanja = data[i].vreme_narucivanja;
                let broj_stola = data[i].broj_stola;
                let status = data[i].status;
                let napomena = data[i].napomena;
                html += "<div class=naslov1>"
                html += "<div> Table: " + broj_stola + "</div>"
                html += "<div> Time of order: " + vreme_narucivanja+ "</div>"
                html += "</div>"
                html += "<div class=total>"
                html += "<div class=total-title>Total</div>"
                html += "<div class=total-price id=ukupno>" + ukupna_cena + "</div>"
                html += "</div>"
                html += "<button class=napomena> note </button>"
                html += "<div class=tabela1>"
                html += "<div > Amount: </div>"
                html += "<div > Name: </div>"
                html += "<div > Price: </div>"
                html += "</div>"
                html += "<div class=wrapper>"
                html += "<div class=cart-content>";
                html += "<div class=cart-box>";
                let artikli_posebno = detalji.split(" RSD ")

                for (i = 0; i < artikli_posebno.length; i++) {
                    console.log(artikli_posebno[i]);
                    razdvojene = artikli_posebno[i].split("&");

                    for (j = 3; j < razdvojene.length; j = j + 3) {
                        let ime = razdvojene[j - 2]
                        let kolicina = razdvojene[j - 1]
                        let cena = razdvojene[j - 0]
                        html += "<input class=\"id_artikla\" data-id=\"" + id + "\" type=\"hidden\">";
                        html += "<input hidden type=number min=0 value=1 class=cart-quantity> " + kolicina + "</input>";
                        html += "<div class=cart-product-title>" + ime + "</div>";
                        html += "<div class=cart-price>" + cena + "</div>";
                    }

                }
                html += "<button class=dugizvrsinar onclick=izvrsiNarudzbinu(this)>Complete an order</button>";
                html += "</div>";
                html += "</div>";
                html += "</div>";

                document.getElementById("ispis").innerHTML = html;

            }

        }
    };



}

function addToTable() {
    output.innerHTML += "<tr>" + "<td>" + title.value + "</td>" +
        "<td>" + author.value + "</td>" +
        "<td>" + "<input type='button' onclick='post(this);' id='post' value ='Post'>" +
        "<input type='button' onclick='remove(this);' id='remove'value ='Remove'>" + "</td>" + "</tr>"
}

function removeRow(row) {

    document.getElementById("aktivne").removeChild(row)
}

function izvrsiNarudzbinu(element) {
    /*let nastavitiProvera = confirm("Jel ste sigurni da želite da pošaljete ovu narudžbinu u izvršene?");
    console.log(nastavitiProvera); // OK = true, Cancel = false
    if (nastavitiProvera == false) {
        return;
    }*/
    ispis = element.parentNode;
    let id = element.parentNode.parentNode.getElementsByTagName("input")[0].getAttribute("data-id");
    let ajax = new XMLHttpRequest();
    ajax.open("GET", "./APIs/updateFinished.php?id=" + id, true);
    ajax.send();
    ajax.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("ispis").innerHTML = "";
            document.getElementById("notifikacija" + trenutni_sto_ispisan).className = "hide";
        }
    };
}

function odbijNarudzbinu(element) {
    /*let nastavitiProvera = confirm("Da li ste sigurni da želite da pošaljete ovu narudžbinu u odbijene");
    console.log(nastavitiProvera); // OK = true, Cancel = false
    if (nastavitiProvera == false) {
        return;
    }*/
    row = element.parentNode.parentNode
    let row_id = element.parentNode.parentNode.getElementsByTagName("input")[0].getAttribute("data-id");
    // console.log(row_id);
    let ajax = new XMLHttpRequest();
    ajax.open("GET", "./APIs/updateDenied.php?id=" + row_id, true);
    ajax.send();
    ajax.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            removeRow(row)
        }
    };

    let tabelaUbaci = document.getElementById("odbijene")
    row.removeChild(row.children[6])
    tabelaUbaci.appendChild(row)

}





function otvoriPopup(element) {
    let row_id = element.parentNode.parentNode.getElementsByTagName("input")[0].getAttribute("data-id");
    let ajax = new XMLHttpRequest();
    ajax.open("GET", "./APIs/dataOneRow.php?id=" + row_id, true);
    ajax.send();
    ajax.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(this.responseText);
            console.log(data);
            let html = "";
            let id = data[0].id;
            let detalji = data[0].detalji;
            html += "<div class=wrapper>"
            html += "<div class=cart-content>";
            html += "<div class=cart-box>";
            let artikli_posebno = detalji.split("RSD ")

            for (i = 0; i < artikli_posebno.length; i++) {
                console.log(artikli_posebno[i]);
                razdvojene = artikli_posebno[i].split("&");

                for (j = 3; j < razdvojene.length; j = j + 3) {
                    let ime = razdvojene[j - 2]
                    let kolicina = razdvojene[j - 1]
                    let cena = razdvojene[j - 0]
                    html += "<input hidden type=number min=0 value=1 class=cart-quantity> " + kolicina + " kom</input>";
                    html += "<div class=cart-product-title>" + ime + "</div>";
                    html += "<div class=cart-price>" + cena + "</div>";
                }

            }
            html += "</div>";
            html += "</div>";
            html += "</div>";

            document.getElementById("ispis").innerHTML = html;
        }
    }
};

//import {notifikacija} from "./notifikacija";

setInterval(function () {

    /*function proveriVreme(vreme_narucivanja)
  {
    let date = new Date();
    let razlikaSekundi = Math.abs(vreme_narucivanja.split(':')[2]-date.getSeconds());
    let razlikaMinuta = Math.abs(vreme_narucivanja.split(':')[1]-date.getMinutes());
    let razlikaSati = Math.abs(vreme_narucivanja.split(':')[0].split(" ")[1]-date.getHours());
    console.log("Razlika sekundi: " + razlikaSekundi + "\nRazlika minuta: " + razlikaMinuta + "\nRazlika sati: " + razlikaSati);
    if(razlikaSekundi != NaN || razlikaMinuta != NaN || razlikaSati != NaN)
      return false;
    else if( (razlikaSekundi == 0 || razlikaSekundi == 1 || razlikaSekundi == 2
      || razlikaSekundi == 3) && razlikaMinuta == 0  && razlikaSati == 0){
        return true;
      }
    else if(razlikaSati == 0 && razlikaMinuta == 1 && razlikaSekundi == 59
      || razlikaSekundi == 58 || razlikaSekundi == 57){
          return true;
      }
    else if(razlikaSati == 1 && razlikaMinuta == 59 && razlikaSekundi == 59
      || razlikaSekundi == 58 || razlikaSekundi == 57){
        return true;
      }
    else {return false}

  }*/

    for (let i = 1; i < stolovi.length - 1; i++) { // treba da se doda kad je ovamo 00 a ovamo 59
        let broj_stola = stolovi[i].innerText.match(/(\d+)/)[0];
        let ajax = new XMLHttpRequest();
        ajax.open("GET", "./APIs/data.php?broj_stola=" + broj_stola, true);
        ajax.send();
        ajax.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                let data = JSON.parse(this.responseText);
                if (data.length != 0) {
                    let vreme_narucivanja = data[0].vreme_narucivanja;
                    console.log("Provera: " + proveriVreme(vreme_narucivanja));
                    if(data[0].status == "aktivna" && proveriVreme(vreme_narucivanja)){
                        notifikacija();
                    }
                    if (data[0].status == "aktivna") {
                        stolovi[i].children[0].className = "notifikacija";
                    }
                    if (data[0].status == "izvrsena") {
                        stolovi[i].children[0].className = "hide";
                    }
                }
            }
        }
    }
}, 3000);
//export {proveriVreme};