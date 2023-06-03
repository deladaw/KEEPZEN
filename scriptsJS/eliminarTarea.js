const deleteTasks = document.querySelectorAll(".delete-task");

deleteTasks.forEach((task) => {
  const taskText = task.parentElement.querySelector(".task-text");
  const taskIcon = task.parentElement.querySelector(".fas.fa-heart");
  task.addEventListener("mouseover", () => {
    taskText.classList.add("hover-color");
    taskIcon.classList.add("hover-color");
  });
  task.addEventListener("mouseout", () => {
    taskText.classList.remove("hover-color");
    taskIcon.classList.remove("hover-color");
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
