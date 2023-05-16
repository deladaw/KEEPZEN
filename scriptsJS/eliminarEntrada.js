const eliminarBtns = document.querySelectorAll(".eliminar-entrada");
eliminarBtns.forEach((eliminarBtn) => {
  eliminarBtn.addEventListener("click", (e) => {
    e.preventDefault(); // Prevenir el comportamiento predeterminado del enlace

    const idEntrada = eliminarBtn.dataset.id; // Obtener el ID de la entrada desde el atributo data-id

    // Mostrar el modal para confirmar la eliminación
    const modal = document.querySelector("#demo-modal");
    modal.style.visibility = "visible";
    modal.style.opacity = "1";

    // Agregar evento al botón de eliminar dentro del modal
    const confirmarEliminarBtn = modal.querySelector(".btn.eliminar-entrada");
    confirmarEliminarBtn.addEventListener("click", () => {
      // Redireccionar a eliminarEntrada.php con el ID de la entrada
      window.location.href = `./Controller/eliminarEntrada.php?id=${idEntrada}`;
    });

    // Agregar evento al botón de cancelar dentro del modal
    const cancelarBtn = modal.querySelector(".btn--secondary");
    cancelarBtn.addEventListener("click", () => {
      // Ocultar el modal sin realizar ninguna acción
      modal.style.visibility = "hidden";
      modal.style.opacity = "0";
    });
  });
});
