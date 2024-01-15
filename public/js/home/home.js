// Récupération des pièces depuis le fichier JSON
const reponse = await fetch("../src/galerie.json");
const pieces = await reponse.json();

const peinture = animaux[0];
const imagePeinture = document.createElement("img");
imagePeinture.src = peinture.animaux;

const divGalerie1 = document.querySelector(".galerie1");
divGalerie1.appendChild(imagePeinture);