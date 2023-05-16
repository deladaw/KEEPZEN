// Obtener el modal y los botones de confirmar y cancelar
var modal = document.getElementById("modal");
var confirmBtn = document.getElementById("modal-confirm");
var cancelBtn = document.getElementById("modal-cancel");

// Obtener todos los botones de eliminar y asignarles un evento click
var deleteBtns = document.querySelectorAll(".card-greet__delete");
deleteBtns.forEach(function (btn) {
  btn.addEventListener("click", function () {
    // Mostrar el modal al hacer clic en el botón de eliminar
    modal.style.display = "block";

    // Obtener el id de la entrada a eliminar desde el data-atributo
    var id = btn.getAttribute("data-id");

    // Asignar la función de eliminación al botón de confirmar del modal
    confirmBtn.onclick = function () {
      eliminarEntrada(id);
      modal.style.display = "none";
    };

    // Asignar la función de cierre del modal al botón de cancelar
    cancelBtn.onclick = function () {
      modal.style.display = "none";
    };
  });
});

// Función para eliminar la entrada utilizando AJAX
function eliminarEntrada(id) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "eliminar.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      location.reload(); // Recargar la página después de eliminar la entrada
    }
  };
  xhr.send("id=" + id);
}
