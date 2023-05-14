var addTaskForm = document.getElementById("add-task-form");
var addTaskButton = document.getElementById("add-task-button");
var tareaInput = document.getElementById("tarea");

tareaInput.addEventListener("keydown", function (event) {
  if (event.key === "Enter") {
    event.preventDefault(); // evita que se ejecute el comportamiento predeterminado de la tecla Enter (que es saltar una línea)
    addTaskButton.click(); // simula un clic en el botón de envío del formulario
  }
});

addTaskButton.addEventListener("click", function (event) {
  event.preventDefault(); // evita que se envíe el formulario a través de una solicitud HTTP POST
  addTaskForm.submit(); // envía los datos del formulario a través de una solicitud HTTP POST
});
