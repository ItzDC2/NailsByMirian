$(document).ready(function() {
    $('.datepicker').datepicker({
        firstDay: 0,
        format: 'dd-mm-yyyy',
        selectYears: 1,
        selectMonths: true,
        labelMonthNext: 'Siguiente mes',
        labelMonthPrev: 'Mes anterior',
        labelMonthSelect: 'Selecciona un mes',
        labelYearSelect: 'Selecciona un año',
        autoClose: true,
        i18n: {
            months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre",
                    "Noviembre", "Diciembre"],
            monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
            weekdays: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
            weekdaysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
            weekdaysAbbrev: ["D", "L", "M", "X", "J", "V", "S"],
            cancel: 'Cancelar',
            today: 'Hoy',
            clear: 'Limpiar',
            close: 'Ok'
        }
    });
})

$(document).ready(function() {
    $('.timepicker').timepicker({
        defaultTime: 'now',
        showClearBtn: true,
        twelveHour: true,
        autoClose: false,
        vibrate: true,
        i18n: {
           cancel: 'Cancelar',
           today: 'Hoy',
           clear: 'Limpiar',
           done: 'Ok'
        }
    })
})