function progress() {
    var valor = 0;
    var intervalo = setInterval(function() {
        value += 10;
        document.getElementById("progreso").css("width", valor + "%").attr("aria-valuenow", valor).text(valor + "%");
        if(valor >= 100) {
            clearInterval(intervalo);
        }
    }, 1000)
}