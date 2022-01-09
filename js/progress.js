function progress() {
    var progress = document.getElementById("progreso");
    for(let i = 0; i <= 10; i++) {
        console.log("Funciona: " + i)
        setTimeout(function timer() {
            progress.style.width = (i * i) + '%';
        }, i * 1000);
    }
}