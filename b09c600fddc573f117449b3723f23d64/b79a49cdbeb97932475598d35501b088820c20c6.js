document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('.sidenav');
  var instances = M.Sidenav.init(elems);
})

function mostrarCitas() {
  var usuarios = document.getElementById("usuariosDiv")
  usuarios.style.display = 'none'
  var alertas = document.getElementById("alertasDiv")
  alertas.style.display = 'none'
  var citas = document.getElementById("citasDiv")
  citas.style.visibility = 'visible'
  citas.style.display = 'block';
}

function mostrarAlertas() {
  var usuarios = document.getElementById("usuariosDiv")
  usuarios.style.display = 'none';
  var alertas = document.getElementById("alertasDiv")
  alertas.style.visibility = 'visible';
  alertas.style.display = 'block';
  var citas = document.getElementById("citasDiv")
  citas.style.display = 'none'

}

function mostrarUsuarios() {
  var usuarios = document.getElementById("usuariosDiv")
  usuarios.style.visibility = 'visible';
  usuarios.style.display = 'block'
  var alertas = document.getElementById("alertasDiv")
  alertas.style.display = 'none'
  var citas = document.getElementById("citasDiv")
  citas.style.display = 'none'

}

