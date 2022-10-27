function notifikacija() {
  Notification.requestPermission().then((perm) => {
    if (perm === "granted") {
      const notification = new Notification("Primer notifikacije", {
        body: "Misa",
        icon: "../../../slike/lets-order-logo.png",
      });

      notification.addEventListener("error", (e) => {
        alert("error");
      });
    }
  });
}

export {notifikacija};