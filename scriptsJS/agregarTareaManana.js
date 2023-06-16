document.addEventListener("DOMContentLoaded", function () {
  let tareaTextarea = document.getElementById("tarea_manana");
  tareaTextarea.focus();
});

document
  .getElementById("tarea_manana")
  .addEventListener("keydown", function (event) {
    if (event.key === "Enter") {
      event.preventDefault();
      document.getElementById("add-task-form-manana").submit();
    }
  });
