var modal = document.getElementById("modal");
var confirmBtn = document.getElementById("modal-confirm");
var cancelBtn = document.getElementById("modal-cancel");

var deleteBtns = document.querySelectorAll(".card-greet__delete");
deleteBtns.forEach(function (btn) {
  btn.addEventListener("click", function () {
    modal.style.display = "block";

    var id = btn.getAttribute("data-id");

    confirmBtn.onclick = function () {
      eliminarEntrada(id);
      modal.style.display = "none";
    };

    cancelBtn.onclick = function () {
      modal.style.display = "none";
    };
  });
});

function eliminarEntrada(id) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "eliminar.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      location.reload();
    }
  };
  xhr.send("id=" + id);
}
