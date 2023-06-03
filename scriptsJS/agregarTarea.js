// // Obtén el botón de enviar
// const addTaskButton = document.getElementById("add-task-button");

// // Agrega el evento de escucha al botón de enviar
// addTaskButton.addEventListener("click", function (event) {
//   // Evita que se produzca la acción predeterminada del botón
//   event.preventDefault();

//   // Obtén el contenido de la tarea
//   const tarea = document.getElementById("tarea").value;

//   // Crea un objeto FormData para enviar los datos del formulario
//   const formData = new FormData();
//   formData.append("tarea", tarea);

//   // Crea una instancia de XMLHttpRequest
//   const xhr = new XMLHttpRequest();

//   // Configura la solicitud
//   xhr.open("POST", "../Model/guardar_tarea.php", true);

//   // Define la función de respuesta
//   xhr.onload = function () {
//     if (xhr.status === 200) {
//       // La solicitud se completó correctamente
//       console.log("Tarea agregada correctamente");
//       // Puedes realizar alguna acción adicional si lo deseas, como mostrar un mensaje de éxito

//       // Vacía el campo de tarea después de agregarla
//       document.getElementById("tarea").value = "";
//     } else {
//       // Hubo un error en la solicitud
//       console.error("Error al agregar la tarea");
//       // Puedes mostrar un mensaje de error o realizar alguna otra acción en caso de error
//     }
//   };

//   // Envía la solicitud
//   xhr.send(formData);
// });
