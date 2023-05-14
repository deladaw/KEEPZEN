const moveToTodayBtn = document.querySelector(".move-to-today");
moveToTodayBtn.addEventListener("click", (event) => {
  event.preventDefault();
  const taskId = event.currentTarget.dataset.taskId;
  fetch("./Controller/actualizar_tarea.php", {
    method: "POST",
    body: JSON.stringify({ id: taskId }),
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Error al actualizar la tarea");
      }
      return response.text();
    })
    .then((text) => {
      // Actualizar la tarea en la página sin recargar
      const taskItem = event.currentTarget.closest(".task-item");
      const taskText = taskItem.querySelector(".task-text");
      taskText.classList.remove("ayer-no-completed");
      taskText.classList.add("completed", "ayer-completed");
      const moveBtn = taskItem.querySelector(".move-to-today");
      moveBtn.remove();
    })
    .catch((error) => {
      console.error(error);
    });
});
