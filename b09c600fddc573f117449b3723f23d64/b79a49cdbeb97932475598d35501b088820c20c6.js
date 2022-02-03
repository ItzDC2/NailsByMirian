document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('.sidenav');
  var instances = M.Sidenav.init(elems);
})

function mostrarCitas() {
  var citasLog = document.getElementById("citasLogsDiv")
  citasLog.style.display = 'none'
  var admLogs = document.getElementById("admLogsDiv")
  admLogs.style.display = 'none'
  var usuarios = document.getElementById("usuariosDiv")
  usuarios.style.display = 'none'
  var alertas = document.getElementById("alertasDiv")
  alertas.style.display = 'none'
  var citas = document.getElementById("citasDiv")
  var cargador = document.querySelector(".cargador")
  cargador.style.display = 'block'
  citas.style.visibility = 'hidden'
  citas.style.display = 'none'
  var t = 2;
  var desc = setInterval(() => {
    t--;
    if(t == 0) {
      citas.style.display = 'block'
      citas.style.visibility = 'visible'
      cargador.style.display = 'none'
      usuarios.style.display = 'none'
      alertas.style.display = 'none'
      clearInterval()
    }
  }, 1000)
}

function mostrarAlertas() {
  var citasLog = document.getElementById("citasLogsDiv")
  citasLog.style.display = 'none'
  var usuarios = document.getElementById("usuariosDiv")
  usuarios.style.display = 'none';
  var alertas = document.getElementById("alertasDiv")
  var citas = document.getElementById("citasDiv")
  citas.style.display = 'none'
  var cargador = document.querySelector(".cargador")
  cargador.style.display = 'block'
  alertas.style.display = 'none'
  var admLogs = document.getElementById("admLogsDiv")
  admLogs.style.display = 'none'
  var t = 2;
  var desc = setInterval(() => {
    t--;
    if(t == 0) {
      alertas.style.display = 'block'
      alertas.style.visibility = 'visible'
      cargador.style.display = 'none'
      citas.style.display = 'none'
      usuarios.style.display = 'none'
      clearInterval()
    }
  }, 1000)

}

function mostrarUsuarios() {
  var citasLog = document.getElementById("citasLogsDiv")
  citasLog.style.display = 'none'
  var usuarios = document.getElementById("usuariosDiv")
  var alertas = document.getElementById("alertasDiv")
  alertas.style.display = 'none'
  var citas = document.getElementById("citasDiv")
  citas.style.display = 'none'
  var cargador = document.querySelector(".cargador")
  usuarios.style.display = 'none'
  cargador.style.display = 'block'
  var admLogs = document.getElementById("admLogsDiv")
  admLogs.style.display = 'none'
  var t = 2;
  var desc = setInterval(() => {
    t--;
    if(t == 0) {
      cargador.style.display = 'none'
      usuarios.style.display = 'block'
      usuarios.style.visibility = 'visible'
      clearInterval()
    }
  }, 1000)
}

function mostrarAdmLogs() {
  var admLogs = document.getElementById("admLogsDiv")
  var usuarios = document.getElementById("usuariosDiv")
  var alertas = document.getElementById("alertasDiv")
  var cargador = document.querySelector(".cargador")
  var citas = document.getElementById("citasDiv")
  var citasLog = document.getElementById("citasLogsDiv")
  citasLog.style.display = 'none'
  cargador.style.display = 'block'
  cargador.style.visibility = 'visible'
  admLogs.style.display = 'none'
  usuarios.style.display = 'none'
  alertas.style.display = 'none'
  citas.style.display = 'none'
  var t = 2;
  var desc = setInterval(() => {
    t--;
    if(t == 0) {
      cargador.style.display = 'none'
      admLogs.style.display = 'block'
      admLogs.style.visibility = 'visible'
    }
  }, 1000)

}

function mostrarCitasLog() {
  debugger;
  var citasLog = document.getElementById("citasLogsDiv")
  var admLogs = document.getElementById("admLogsDiv")
  var usuarios = document.getElementById("usuariosDiv")
  var alertas = document.getElementById("alertasDiv")
  var cargador = document.querySelector(".cargador")
  var citas = document.getElementById("citasDiv")
  cargador.style.display = 'block'
  cargador.style.visibility = 'visible'
  admLogs.style.display = 'none'
  usuarios.style.display = 'none'
  alertas.style.display = 'none'
  citas.style.display = 'none'
  var t = 2;
  var desc = setInterval(() => {
    t--;
    if(t == 0) {
      cargador.style.display = 'none'
      citasLog.style.display = 'block'
      citasLog.style.visibility = 'visible'
    }
  }, 1000)

}