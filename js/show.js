numClicks = 0;

function show() {
    var op = document.getElementById("opciones")
    op.className = "bi bi-gear-fill rotado"
    var lista = document.getElementById("listaShow")
    lista.style.visibility = 'visible';
    numClicks++
    if(numClicks == 2 || (getCoordenadasX() < 1026 && getCoordenadasY() > 59)) {
        op.className="bi bi-gear vueltaRotado";
        lista.style.visibility = 'hidden';
        numClicks = 0;
    }
}

function getCoordenadasX(event) {
    return event.clientX;
}

function getCoordenadasY(event) {
    return event.clientY;
}

document.addEventListener("click", getCoordenadasX)
document.addEventListener("click", getCoordenadasY)