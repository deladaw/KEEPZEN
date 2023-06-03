// // Obtén los elementos de los botones
// const coralBlushButton = document.getElementById("coral-blush");
// const darkChocolateButton = document.getElementById("dark-chocolate");
// const lemonPieButton = document.getElementById("lemon-pie");

// // Agrega los event listeners a los botones
// coralBlushButton.addEventListener("click", function () {
//   actualizarTemaActivo(1);
// });

// darkChocolateButton.addEventListener("click", function () {
//   actualizarTemaActivo(2);
// });

// lemonPieButton.addEventListener("click", function () {
//   actualizarTemaActivo(3);
// });

// // Función para enviar la solicitud al servidor y actualizar el tema activo en la tabla de usuarios
// function actualizarTemaActivo(temaId) {
//   fetch("cambiarTema.php", {
//     method: "POST",
//     body: JSON.stringify({ tema_activo_id: temaId }),
//     headers: {
//       "Content-Type": "application/json",
//     },
//   })
//     .then((response) => {
//       // Manejar la respuesta del servidor, por ejemplo, mostrar un mensaje de éxito al usuario.
//       console.log("Tema activo actualizado correctamente");
//     })
//     .catch((error) => {
//       // Manejar cualquier error que ocurra durante la solicitud.
//       console.error("Error al actualizar el tema activo:", error);
//     });
// }
