document.addEventListener("DOMContentLoaded", function () {
  let tareaTextarea = document.getElementById("tarea_manana");
  tareaTextarea.focus();
});

document
  .getElementById("tarea_manana")
  .addEventListener("keydown", function (event) {
    if (event.key === "Enter") {
      event.preventDefault(); // Evita que se inserte un salto de línea en el textarea
      document.getElementById("add-task-form-manana").submit(); // Envía el formulario
    }
  });
