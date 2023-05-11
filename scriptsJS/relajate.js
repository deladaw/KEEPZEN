const playButton = document.getElementById("play");
const sphereInner = document.getElementById("sphere-inner");
const inspira = document.querySelector(".inspira");
const espira = document.querySelector(".espira");
console.log("Hola");
playButton.addEventListener("click", function () {
  sphereInner.classList.toggle("animate");
  inspira.classList.toggle("animate-inspira");
  espira.classList.toggle("animate-espira");
  playButton.classList.toggle("active");
});
