const tareaInput = document.getElementById("tarea");
const maxCaracteres = 150;

tareaInput.addEventListener("input", () => {
  const tareaValue = tareaInput.value;
  if (tareaValue.length > maxCaracteres) {
    tareaInput.value = tareaValue.slice(0, maxCaracteres);
  }
});

const agradecimientoInput = document.getElementById("agradecimiento");
const maxCarac = 850;

agradecimientoInput.addEventListener("input", () => {
  const agradecimientoValue = agradecimientoInput.value;
  if (agradecimientoValue.length > maxCarac) {
    agradecimientoInput.value = agradecimientoValue.slice(0, maxCarac);
  }
});
