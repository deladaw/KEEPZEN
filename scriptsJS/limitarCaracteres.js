const tareaInput = document.getElementById("tarea");
const maxCaracteres = 150;

tareaInput.addEventListener("input", () => {
  const tareaValue = tareaInput.value;
  if (tareaValue.length > maxCaracteres) {
    tareaInput.value = tareaValue.slice(0, maxCaracteres);
  }
});
