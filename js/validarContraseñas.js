var contraseña1 = document.getElementById("contra")
var contraseña2 = document.getElementById("contra2")

function validarContraseñas() {
    if(contraseña1 == contraseña2) {
        alert("Todo piola");
    } else {
        alert("Las contraseñas no coinciden")
    }
}