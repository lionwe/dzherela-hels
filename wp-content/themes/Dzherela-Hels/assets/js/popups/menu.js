import { Popup } from "./class.js";

const menuPopup = new Popup("#popup-menu", {
    closeButton: ".popup-menu__close",
    openButtons: ".header__burger",
    closeOnResize: true, 
    on: {
        open: function () {
            document.body.style.overflow = "hidden";
        },
        close: function () {
            document.body.style.overflow = "";
        }
    }
});

// Close popup when clicking on a menu link (anchor)
const menuLinks = document.querySelectorAll("#popup-menu .menu-item a");
menuLinks.forEach(link => {
    link.addEventListener("click", () => {
        menuPopup.close();
    });
});
