document.getElementById("tarea").addEventListener("keydown", function (event) {
  if (event.key === "Enter") {
    event.preventDefault(); // Evita que se inserte un salto de línea en el textarea
    document.getElementById("add-task-form").submit(); // Envía el formulario
  }
});
