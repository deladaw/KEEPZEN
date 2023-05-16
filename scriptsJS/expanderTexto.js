// Agrega un evento de clic al elemento "ver más" para expandir el texto
document
  .querySelectorAll(".card-greet__text-expand")
  .forEach(function (element) {
    element.addEventListener("click", function () {
      this.previousElementSibling.style.webkitLineClamp = "unset";
      this.style.display = "none";
    });
  });
