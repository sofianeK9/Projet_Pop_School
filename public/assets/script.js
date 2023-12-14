// Menu burger :

// j'attend que le contenu de la page soit chargé
document.addEventListener("DOMContentLoaded", (event) => {
  // Je sélectionne le menu que je stocke dans une constante
  const menu = document.querySelector(".menu");

  // je sélectionne la div burger que je stocke dans une constante
  const burger = document.querySelector(".burger");

  // J'ajoute un écouteur d'événements au clic sur le bouton burger
  burger.addEventListener("click", () => {
    // La fonction Toggle  ajoute ou supprime la classe "active" sur l'élément du menu
    menu.classList.toggle("active");
  });
});

