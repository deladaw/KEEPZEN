const taskItems = document.querySelectorAll(".task-item");

taskItems.forEach((item) => {
  const taskText = item.querySelector(".task-text");
  const taskCheckbox = item.querySelector(".task-checkbox");

  taskText.addEventListener("click", () => {
    if (!taskCheckbox.checked) {
      taskCheckbox.checked = true;
    } else {
      taskCheckbox.checked = false;
    }

    const id = taskCheckbox.dataset.id;

    fetch(
      `./Controller/marcar_tarea_completada.php?id=${id}&completada=${taskCheckbox.checked}`
    )
      .then((response) => response.text())
      .then((data) => {
        console.log(data);
      });
  });

  taskCheckbox.addEventListener("change", () => {
    const id = taskCheckbox.dataset.id;
    const isChecked = taskCheckbox.checked;

    fetch(
      `./Controller/marcar_tarea_completada.php?id=${id}&completada=${isChecked}`
    )
      .then((response) => response.text())
      .then((data) => {
        console.log(data);
      });
  });
});
