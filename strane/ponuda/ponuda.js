let ajax = new XMLHttpRequest();
ajax.open("GET", "../artikli/APIs/data.php", true);
ajax.send();
ajax.onreadystatechange = function () {
  if (this.readyState == 4 && this.status == 200) {
    let data = JSON.parse(this.responseText);
    let html = "";
    let cat = "";
    for (let i = 0; i < data.length; i++) {
      let id = data[i].id;
      let ime = data[i].ime;
      let cena = data[i].cena;
      let slika = data[i].slika;
      let opis = data[i].opis;
      let popust = data[i].popust;
      let kolicina = data[i].kolicina;
      let kategorija = data[i].kategorija;
      html += "<div class=card>";
      html += "<input class=\"id_artikla\" data-id=\"" + id + "\" type=\"hidden\">";
      html += "<div class=card-bg>";
      html += "<img src=../artikli/artikliSlike/" + id + "." + slika + ">";
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
      html += "<p> <ion-icon class=dodajukolica name=add-circle-outline>Dodaj</ion-icon> "
      html += "<button class=kolicinaukolica>" + kolicina + "</button>"
      html += "<ion-icon class=oduzmiizkolica name=remove-circle-outline>Oduzmi</ion-icon> </p>";
      html += "</div>";
      html += "</div>";

    }

    document.getElementById("data").innerHTML += html;

    ready();

    function ready() {
      let removeCartButtons = document.getElementsByClassName("cart-remove");

      for (let i = 0; i < removeCartButtons.length; i++) {
        let button = removeCartButtons[i];
        button.addEventListener("click", removeCartItem);
      }

      let addCart = document.getElementsByClassName("dodajukolica");

      for (let i = 0; i < addCart.length; i++) {
        let button = addCart[i];
        button.addEventListener("click", addCartClicked);
      }

      let removeCart = document.getElementsByClassName("oduzmiizkolica");

      for (let i = 0; i < removeCart.length; i++) {
        let button = removeCart[i];
        button.addEventListener("click", removeCartClicked);
      }

      document
        .getElementsByClassName("ok-btn")[0]
        .addEventListener("click", buyButtonClicked);
    }

    function buyButtonClicked() {
      alert("Vaša narudžbina je primljena!");
      let cartContent = document.getElementsByClassName("cart-content")[0];

      while (cartContent.hasChildNodes()) {
        cartContent.removeChild(cartContent.firstChild);
      }

      updateTotal();
    }

    function addCartClicked(element) {
      let button = element.target;
      let shopProduct = button.parentElement.parentElement.parentElement;
      let title = shopProduct.getElementsByTagName("h2")[0].innerHTML;
      let price = shopProduct.getElementsByClassName("price")[0].innerHTML;
      let productImg = shopProduct
        .getElementsByTagName("img")[0]
        .getAttribute("src");
      let kolicina = parseInt(
        shopProduct.getElementsByClassName("kolicinaukolica")[0].innerHTML
      );
      kolicina++;
      shopProduct.getElementsByClassName("kolicinaukolica")[0].innerHTML =
        kolicina;
      addProductToCart(title, price, productImg, kolicina);
      updateTotal();
    }

    function removeCartClicked(element) {
      let button = element.target;
      let shopProduct = button.parentElement.parentElement;
      let title = shopProduct.getElementsByTagName("h2")[0].innerHTML;
      let kolicina = parseInt(
        shopProduct.getElementsByClassName("kolicinaukolica")[0].innerHTML
      );
      if (kolicina !== 0) {
        kolicina--;
      }
      shopProduct.getElementsByClassName("kolicinaukolica")[0].innerHTML =
        kolicina;
      removeProductFromCart(title, kolicina);
      updateTotal();
    }

    function addProductToCart(title, price, productImg, kolicina) {
      let cartShopBox = document.createElement("div");
      cartShopBox.classList.add("cart-box");
      let cartItems = document.getElementsByClassName("cart-content")[0];

      if (kolicina > 1) {
        let naslovi = document.getElementsByClassName("cart-product-title");
        let kolicine = document.getElementsByClassName("cart-quantity");
        for (let i = 0; i < naslovi.length; i++) {
          if (naslovi[i].innerHTML == title) {
            kolicine[i].innerHTML = kolicina;
          }
        }
      } else {
        let cartBoxContent = ` 
                                        <h3 class="cart-quantity">${kolicina}</h3>
                                        <img src="${productImg}" alt="Naravno da nije povezano" class="cart-img">

                                        <div class="detail-box">
                                            <div class="cart-product-title">${title}</div>
                                            <div class="cart-price">${price}</div>
                                        </div>

                                        <ion-icon name="trash-outline" class="cart-remove"></ion-icon>`;

        cartShopBox.innerHTML = cartBoxContent;
        cartItems.append(cartShopBox);
        cartShopBox
          .getElementsByClassName("cart-remove")[0]
          .addEventListener("click", removeCartItem);
      }
    }

    function removeProductFromCart(title, kolicina) {
      let imena = document.getElementsByClassName("cart-product-title");
      if (kolicina === 0) {
        for (let i = 0; i < imena.length; i++) {
          if (imena[i].innerHTML == title) {
            imena[i].parentElement.parentElement.remove();
          }
        }
      } else {
        for (let i = 0; i < imena.length; i++) {
          if (imena[i].innerHTML == title) {
            imena[i].parentElement.parentElement.getElementsByClassName(
              "cart-quantity"
            )[0].innerHTML = kolicina;
          }
        }
      }
    }

    function removeCartItem(element) {
      let buttonClicked = element.target;
      let shopProduct = buttonClicked.parentElement.children[2];
      let title =
        shopProduct.getElementsByClassName("cart-product-title")[0].innerHTML;
      let naslovi = document.getElementsByTagName("h2");
      let kolicine = document.getElementsByClassName("kolicinaukolica");
      for (let i = 0; i < naslovi.length; i++) {
        if (naslovi[i].innerHTML == title) {
          kolicine[i].innerHTML = 0;
        }
      }
      buttonClicked.parentElement.remove();
      updateTotal();
    }

    function updateTotal() {
      let cartContent = document.getElementsByClassName("cart-content")[0];
      let cartBoxes = cartContent.getElementsByClassName("cart-box");
      let total = 0;

      for (let i = 0; i < cartBoxes.length; i++) {
        let cartBox = cartBoxes[i];
        let priceElement =
          cartBox.getElementsByClassName("cart-price")[0].innerHTML;
        let quantityElement =
          cartBox.getElementsByClassName("cart-quantity")[0];
        let price = parseFloat(priceElement);
        let quantity = quantityElement.innerHTML;
        total = total + price * quantity;
      }

      total = Math.round(total * 100) / 100;
      document.getElementsByClassName("total-price")[0].innerText =
        total + "RSD";
      let ukupno = document.getElementById("ukupno").innerHTML;
      document.querySelector(".divdugmenaruci span").textContent = ukupno;
      toggle();
    }
  }
};

let ajax1 = new XMLHttpRequest();
ajax1.open("GET", "../artikli/APIs/kategorijeDobivanje.php", true);
ajax1.send();
ajax1.onreadystatechange = function () {
  if (this.readyState == 4 && this.status == 200) {
    let data = JSON.parse(this.responseText);
    let html = "";
    html += "<a class=kategorisani onclick=kategorije(this)>Svi</a>";
    for (let i = 0; i < data.length; i++) {
      let kategorija = data[i].ime_kategorije;
      html += "<a class=kategorisani onclick=kategorije(this)>" + kategorija + "</a>";
    }
    document.getElementById("myDropdown").innerHTML += html;
  }
};

const search = () => {
  const searchbox = document.getElementById("search-item").value.toUpperCase();
  const storeitems = document.getElementById("data");
  const product = document.querySelectorAll(".card");
  const productname = storeitems.getElementsByTagName("h2");

  for (let i = 0; i < productname.length; i++) {
    let match = product[i].getElementsByTagName("h2")[0];

    if (match) {
      let textvalue = match.textContent || match.innerHTML;

      if (textvalue.toUpperCase().indexOf(searchbox) > -1) {
        product[i].style.display = "";
      } else {
        product[i].style.display = "none";
      }
    }
  }
};



const naruci = document.querySelector(".button-27");
const okbtn = document.querySelector(".ok-btn");
const popupbox = document.querySelector(".popup-overlay");
const exit = document.querySelector(".exit");

naruci.addEventListener("click", () => {
  popupbox.classList.add("aktivanpopup");
});

okbtn.addEventListener("click", setCookie2);
okbtn.addEventListener("click", setCookie3);

exit.addEventListener("click", () => {
  popupbox.classList.remove("aktivanpopup");
});

const kategorije = (element) => {
  const storeitems = document.getElementById("data");
  const product = document.querySelectorAll(".card");
  const productname = storeitems.getElementsByTagName("strong");
  const cale = document.getElementsByClassName("kategorisani");
  for (let i = 0; i < cale.length; i++) {
    if (cale[i].classList.contains("svi")) {
      cale[i].classList.remove("svi");
    }

    if (cale[i].innerHTML === element.innerHTML) {
      cale[i].classList.add("svi");
    }
  }

  if (element.innerHTML === 'Svi') {
    for (let i = 0; i < product.length; i++) {
      product[i].style.display = "";
    }
  } else {
    for (let i = 0; i < productname.length; i++) {
      let match = product[i].getElementsByTagName("strong")[0];
      if (match) {
        let textvalue = match.textContent || match.innerHTML;
        if (element.innerHTML === textvalue) {
          product[i].style.display = "";
        } else {
          product[i].style.display = "none";
        }
      }
    }
  }
};

function toggle() {
  let element = document.getElementById("sakrij");
  let konacna_cena = document.getElementById("ukupno").innerHTML;
  let cena = konacna_cena.slice(0, -3);
  cena = parseInt(cena);
  if (cena === 0) {
    element.setAttribute("hidden", "hidden");
    popupbox.classList.remove("aktivanpopup");
  } else {
    element.removeAttribute("hidden");
  }
}

function setCookie() {
  let date = new Date();
  let vreme = date.toLocaleString();
  date.setTime(date.getTime() + 24 * 60 * 60 * 1000);
  let expires = "expires=" + date.toUTCString();
  let cname = "vreme_narucivanja";
  document.cookie = cname + "=" + vreme + ";" + expires;
}

function setCookie2() {
  let date = new Date();
  date.setTime(date.getTime() + 24 * 60 * 60 * 1000);
  let expires = "expires=" + date.toUTCString();
  let konacna_cena = document.getElementById("ukupno").innerHTML;
  let cname = "narudzbina";
  document.cookie = cname + "=" + konacna_cena + ";" + expires;
}

function setCookie3() {
  let date = new Date();
  date.setTime(date.getTime() + 24 * 60 * 60 * 1000);
  let expires = "expires=" + date.toUTCString();
  let narudzbina = [];
  let narudzbine = document.getElementsByClassName("detail-box");
  for (let i = 1; i < narudzbine.length; i++) {
    let ime =
      narudzbine[i].getElementsByClassName("cart-product-title")[0].innerHTML;
    let kolicina =
      narudzbine[i].parentElement.getElementsByClassName("cart-quantity")[0].innerHTML;
    let cena = narudzbine[i].getElementsByClassName("cart-price")[0].innerHTML;
    narudzbina.push(ime, kolicina, cena);
  }

  let string = "";
  let result = "";
  narudzbina.forEach((element) => {
    result += string.concat("&", element);
  });
  let cname = "detalji";
  document.cookie = cname + "=" + result + ";" + expires;
}

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


