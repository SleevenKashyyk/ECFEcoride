import Route from "./Route.js";

//Définir ici vos routes
export const allRoutes = [
    new Route("/", "Accueil", "/pages/home.html"),
    new Route("/vues", "Accès aux covoiturage", "/pages/vues.html"),
    new Route("/connexion", "Connexion", "/pages/connexion.html"),
    new Route("/inscription", "Inscription", "/pages/inscription.html"),


];

//Le titre s'affiche comme ceci : Route.titre - websitename
export const websiteName = "Ecoride";