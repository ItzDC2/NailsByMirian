function espera() {
    var tiempoRestante = 3;
    var tiempoDescarga = setInterval(function() {
        tiempoRestante--;
        if (tiempoRestante == 0) {
            window.location.href = "../index.php"
            clearInterval(tiempoDescarga);
        }

    }, 1000);
}