// Izvrsavaju pri ulasku na sajt

//import { notifikacija } from "../narudzbine/notifikacija";

let ajax = new XMLHttpRequest();
ajax.open("GET", "./APIs/data.php", true);
ajax.send();
ajax.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
        let data = JSON.parse(this.responseText);
        // console.log(data);
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
            html += "<p class=kategorija_artikla hidden>" + kategorija + "</p>"
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


let elementosKategorije = document.getElementById("kategorije")
let ajax1 = new XMLHttpRequest();
ajax1.open("GET", "./APIs/kategorijeDobivanje.php", true);
ajax1.send();
ajax1.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
        let data = JSON.parse(this.responseText);
        let html = "";
        html += "<a class=kategorisani onclick=kategorije(this)>Svi</a>";
        for (let i = 0; i < data.length; i++) {
            let kategorija = data[i].ime_kategorije;
            html += "<a class=kategorisani onclick=kategorije(this)>" + kategorija + "</a>";
            var option = document.createElement("option");
            option.text = kategorija;
            elementosKategorije.add(option);
        }
        document.getElementById("myDropdown").innerHTML += html;
    }
};

// Funkcije

function ispisArtikala() {
    let ajax = new XMLHttpRequest();
    ajax.open("GET", "./APIs/data.php", true);
    ajax.send();
    ajax.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(this.responseText);
            let html = "";

            for (let i = document.getElementsByClassName("card").length - 1; i >= 0; i--) {
                document.getElementById("data").removeChild(document.getElementsByClassName("card")[i]);
            }

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
                html += "<p class=kategorija_artikla hidden>" + kategorija + "</p>"
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
}


function dugmeZaMenjanje(element) {

    let elementos = element.closest('.card');

    let id = elementos.getElementsByClassName('id_artikla')[0].getAttribute("data-id");
    let ime = elementos.getElementsByTagName('h2')[0].innerHTML;
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
    let opis = elementos.getElementsByTagName('p')[0].innerHTML;
    let kategorija = elementos.getElementsByClassName('kategorija_artikla')[0].innerHTML;


    document.querySelectorAll(".artikl_input_id")[0].value = id;
    document.querySelectorAll(".artikl_input_ime")[0].value = ime;
    document.querySelectorAll(".artikl_input_cena")[0].value = parseInt(cena);
    document.querySelectorAll(".artikl_input_popust")[0].value = parseInt(popust);
    document.querySelectorAll(".artikl_input_opis")[0].value = opis;
    document.querySelectorAll(".artikl_input_kategorija")[0].value = kategorija;

    otvoriPopup();


}
// za brisanje
function onClickDugmeZaBrisanje(element) {
    let nastavitiProvera = confirm("Jel ste sigurni da želite da obrišete ovaj artikal?");
    // console.log(nastavitiProvera); // OK = true, Cancel = false
    if (nastavitiProvera == false) {
        return;
    }
    let elementos = element.closest('.card');
    let ime = elementos.getElementsByTagName('h2')[0].innerHTML;
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

    elementos.remove()

}

const search = () => {
    const searchbox = document.getElementById("search-item").value.toUpperCase();
    const storeitems = document.getElementById("data");
    const product = document.querySelectorAll(".card");
    const productname = storeitems.getElementsByTagName("h2");

    for (let i = 0; i < productname.length; i++) {
        let match = product[i].getElementsByTagName("h2")[0];

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

const kategorije = (element) => {
    const storeitems = document.getElementById("data");
    const product = document.querySelectorAll(".card");
    const productname = storeitems.getElementsByTagName("p");
    const cale = document.getElementsByClassName("kategorisani");
    const dropdown2 = document.getElementById("myDropdown");
    const prazne = document.getElementsByClassName('divkategorija');
  
    for (let i = 0; i < cale.length; i++) {
      if (cale[i].classList.contains("svi")) {
        cale[i].classList.remove("svi");
        dropdown2.classList.remove("show");
        dropdown2.classList.add("hide");
      }
  
      if (cale[i].innerHTML === element.innerHTML) {
        cale[i].classList.add("svi");
        dropdown2.classList.remove("show");
        dropdown2.classList.add("hide");
      }
    }
  
    if (element.innerHTML === 'Svi') {
      for (let i = 0; i < product.length; i++) {
        product[i].style.display = "";
      }
  
      for (let i = 0; i < prazne.length; i++) {
        if (prazne[i].childNodes.length > 2) {
          prazne[i].style.display = "";
        }
      }
    } else {
      for (let i = 0; i < productname.length; i++) {
        let match = product[i].getElementsByTagName("p")[0];
        if (match) {
          let textvalue = match.textContent || match.innerHTML;
          if (element.innerHTML === textvalue) {
            product[i].style.display = "";
          } else {
            product[i].style.display = "none";
          }
        }
      }
  
      for (let i = 0; i < prazne.length; i++) {
        let match = prazne[i].getElementsByClassName("imekategorija")[0];
        if (match) {
          let textvalue = match.textContent || match.innerHTML;
          if (element.innerHTML === textvalue) {
            prazne[i].style.display = "";
          } else {
            prazne[i].style.display = "none";
          }
        }
      }
    }
  };



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
    // console.log(kategorije.selectedIndex);
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

    var artikl_form = document.getElementById("artikl_form");

    var form_for_sending = new FormData(artikl_form);

    let ajax = new XMLHttpRequest();
    ajax.open("POST", "./APIs/article_add.php", true);
    ajax.send(form_for_sending);
    ajax.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let response = this.responseText;
            ispisArtikala();
        }
    };
});

const dugme1 = document.getElementById("cta");
const dropdown1 = document.getElementById("myDropdown1");
dugme1.addEventListener("click", () => {
    if (dropdown1.classList.contains('show')) {
        dropdown1.classList.remove("show");
        dropdown1.classList.add("hide");
    } else {
        dropdown1.classList.remove("hide");
        dropdown1.classList.add("show");
    }
});

const dugme = document.getElementById("dugfilter");
const dropdown = document.getElementById("myDropdown");
dugme.addEventListener("click", () => {
    if (dropdown.classList.contains('show')) {
        dropdown.classList.remove("show");
        dropdown.classList.add("hide");
    } else {
        dropdown.classList.remove("hide");
        dropdown.classList.add("show");
    }
});


setInterval(function () {

    function notifikacija() {
        console.log("LAGANO OBAVESENJCE ALEEE");
        Notification.requestPermission().then((perm) => {
          if (perm === "granted") {
            const notification = new Notification("Imate nove narudzbine", {
              body: "Proverite Let's order za nove narudzbine",
              icon: "../../../slike/lets-order-logo.png",
            });
      
            notification.addEventListener("error", (e) => {
              alert("error");
            });
          }
        });
      }
  
    function proveriVreme(vreme_narucivanja)
  {
    let date = new Date();
    let razlikaSekundi = Math.abs(vreme_narucivanja.split(':')[2]-date.getSeconds());
    let razlikaMinuta = Math.abs(vreme_narucivanja.split(':')[1]-date.getMinutes());
    let razlikaSati = Math.abs(vreme_narucivanja.split(':')[0].split(" ")[1]-date.getHours());
    //console.log("Razlika sekundi: " + razlikaSekundi + "\nRazlika minuta: " + razlikaMinuta + "\nRazlika sati: " + razlikaSati);
    if(razlikaSekundi == NaN || razlikaMinuta == NaN || razlikaSati == NaN)
      return false;
    else if( (razlikaSekundi == 0 || razlikaSekundi == 1 || razlikaSekundi == 2) && razlikaMinuta == 0  && razlikaSati == 0){
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
  
  }
      let ajax = new XMLHttpRequest();
      ajax.open("GET", "../narudzbine/APIs/dataAllTables.php", true);
      ajax.send();
      ajax.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
              let data = JSON.parse(this.responseText);
              //console.log(data);
              if (data.length != 0) {
                for(let i = 0; i < data.length; i++)
                {
                  //console.log("Za podatak na mestu: " + i + ", proveri vreme je: " + proveriVreme(data[i].vreme_narucivanja));
                  if(data[i].status == "aktivna" && proveriVreme(data[i].vreme_narucivanja)){
                    notifikacija();
                    }
                } 
              }
          }
      }
  }, 3000);