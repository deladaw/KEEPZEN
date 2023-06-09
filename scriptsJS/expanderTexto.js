// Agrega un evento de clic al elemento "ver más" para expandir el texto
$(".card-greet__text-expand").click(function () {
  $(this).prev().css("webkitLineClamp", "unset");
  $(this).hide();
  $(this).prev().slideDown();
});
