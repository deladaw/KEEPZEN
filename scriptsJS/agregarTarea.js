// Obtener elementos del DOM
const addEntryButton = document.querySelector(".add-entry");
const taskList = document.getElementById("task-list");
const diaryEntry = document.querySelector(".diary__entry");

// Función para añadir tarea
function addTask() {
  // Obtener valor del textarea
  const newTask = diaryEntry.value;
  // Crear un nuevo elemento de lista
  const taskItem = document.createElement("div");
  taskItem.classList.add("task-item");

  // Crear la casilla cuadrada para marcar la tarea
  const checkbox = document.createElement("input");
  checkbox.type = "checkbox";
  checkbox.classList.add("task-checkbox");
  checkbox.addEventListener("change", function () {
    if (checkbox.checked) {
      taskItem.classList.add("task-completed");
    } else {
      taskItem.classList.remove("task-completed");
    }
  });

  // Crear el texto de la tarea y añadirlo al elemento de lista
  const taskText = document.createElement("p");
  taskText.classList.add("task-text");
  taskText.textContent = newTask;

  // Crear la casilla con X para eliminar la tarea
  const deleteButton = document.createElement("span");
  deleteButton.classList.add("delete-task");
  deleteButton.textContent = "X";
  deleteButton.addEventListener("click", function () {
    taskList.removeChild(taskItem);
  });
  deleteButton.addEventListener("mouseover", function () {
    taskText.style.color = "#FF8BA7";
    taskText.style.textDecoration = "underline";
  });
  deleteButton.addEventListener("mouseout", function () {
    taskText.style.color = "#594A4E";
    taskText.style.textDecoration = "none";
  });

  // Añadir los elementos creados al elemento de lista
  taskItem.appendChild(checkbox);
  taskItem.appendChild(taskText);
  taskItem.appendChild(deleteButton);
  taskList.appendChild(taskItem);

  // Limpiar el valor del textarea
  diaryEntry.value = "";
}

// Escuchar evento click en el botón de añadir tarea
addEntryButton.addEventListener("click", addTask);
