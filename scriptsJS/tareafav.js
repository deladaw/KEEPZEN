const favoriteTasks = document.querySelectorAll(".favorite-task");

favoriteTasks.forEach((task) => {
  const heart = task.querySelector(".fa-heart");

  task.addEventListener("click", (e) => {
    e.preventDefault();
    fetch(task.href)
      .then((response) => response.text())
      .then(() => {
        heart.classList.toggle("favorite");
      });
  });
});
