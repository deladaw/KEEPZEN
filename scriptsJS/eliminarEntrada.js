const eliminarBtns = document.querySelectorAll(".eliminar-entrada");
eliminarBtns.forEach((eliminarBtn) => {
  eliminarBtn.addEventListener("click", (e) => {
    e.preventDefault();

    const idEntrada = eliminarBtn.dataset.id;

    const modal = document.querySelector("#demo-modal");
    modal.style.visibility = "visible";
    modal.style.opacity = "1";

    const confirmarEliminarBtn = modal.querySelector(".btn.eliminar-entrada");
    confirmarEliminarBtn.addEventListener("click", () => {
      window.location.href = `./Controller/eliminarEntrada.php?id=${idEntrada}`;
    });

    const cancelarBtn = modal.querySelector(".btn--secondary");
    cancelarBtn.addEventListener("click", () => {
      modal.style.visibility = "hidden";
      modal.style.opacity = "0";
    });
  });
});
