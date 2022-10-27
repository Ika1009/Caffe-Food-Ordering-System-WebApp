function notifikacija() {
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

export {notifikacija};