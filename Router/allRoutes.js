import Route from "./Route.js";

//Définir ici vos routes
export const allRoutes = [
    new Route("/", "Accueil", "/pages/home.html"),
    new Route("/vues", "Accès aux covoiturage", "/pages/vues.html"),
    new Route("/connexion", "Connexion", "/pages/accompte/connexion.html"),
    new Route("/inscription", "Inscription", "/pages/accompte/inscription.html", "/js/accompte/inscription.js"),
    new Route("/compteutilisateur", "Mon compte", "/pages/accompte/compteutilisateur.html"),
    new Route("/changemdf", "Changer mon mot de passe", "/pages/accompte/changemdf.html"),


];

//Le titre s'affiche comme ceci : Route.titre - websitename
export const websiteName = "Ecoride";