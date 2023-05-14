const deleteTasks = document.querySelectorAll(".delete-task");

deleteTasks.forEach((task) => {
  const taskText = task.parentElement.querySelector(".task-text");
  task.addEventListener("mouseover", () => {
    taskText.style.color = "#f73d3da1"; // cambia el color a rojo al hacer hover
  });
  task.addEventListener("mouseout", () => {
    taskText.style.color = "#594a4e"; // vuelve al color original al quitar el mouse
  });
  task.addEventListener("click", (e) => {
    e.preventDefault();
    fetch(task.href)
      .then((response) => response.text())
      .then(() => {
        const taskItem = task.closest(".task-item");
        taskItem.remove();
      });
  });
});
