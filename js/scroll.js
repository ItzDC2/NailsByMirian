var timer;

function scroll() {
    if(timer) {
        window.clearTimeout(timer);
    }
    timer = window.setTimeout(function() {
        window.scrollTo(0, document.body.scrollHeight)
    }, 250);

};