numClicks = 0;

function show() {
    var op = document.getElementById("opciones")
    op.className = "bi bi-gear-fill rotado"
    var lista = document.getElementById("listaShow")
    lista.style.visibility = 'visible';
    numClicks++
    if(numClicks == 2) {
        op.className="bi bi-gear vueltaRotado";
        lista.style.visibility = 'hidden';
        numClicks = 0;
    }
}