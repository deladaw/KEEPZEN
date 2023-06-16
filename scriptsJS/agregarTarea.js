document.addEventListener("DOMContentLoaded", function () {
  let tareaTextarea = document.getElementById("tarea");
  tareaTextarea.focus();
});

document.getElementById("tarea").addEventListener("keydown", function (event) {
  if (event.key === "Enter") {
    event.preventDefault();
    document.getElementById("add-task-form").submit();
  }
});
