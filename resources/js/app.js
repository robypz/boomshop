import { Modal } from "bootstrap";
import "./bootstrap";
// Selecciona el modal



const noticies = document.getElementById('notices');

if (noticies) {
    var myModal = new Modal(noticies, {
        keyboard: false
    });

    // Muestra el modal
    myModal.show();

}
