// Menu burger :

addEventListener("DOMContentLoaded", (event) => {
  console.log("Dom chargé");
  const menu = document.querySelector(".menu");
  const burger = document.querySelector(".burger");

  burger.addEventListener("click", () => {
    console.log("clic");
    menu.classList.toggle("active");
  });
});
