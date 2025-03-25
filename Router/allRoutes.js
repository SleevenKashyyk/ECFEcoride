import Route from "./Route.js";

//Définir ici vos routes
export const allRoutes = [
    new Route("/", "Accueil", "/pages/home.html", []),
    new Route("/vues", "Accès aux covoiturage", "/pages/vues.html", []),
    new Route("/connexion", "Connexion", "/pages/accompte/connexion.html",["disconnected"] ,"/js/accompte/connexion.js"),
    new Route("/inscription", "Inscription", "/pages/accompte/inscription.html",["disconnected"] ,"/js/accompte/inscription.js"),
    new Route("/compteuser", "Mon compte", "/pages/accompte/compteuser.html", ["user", "employer","admin"]),
    new Route("/changemdf", "Changer mon mot de passe", "/pages/accompte/changemdf.html",["user", "employer","admin"]),


];

//Le titre s'affiche comme ceci : Route.titre - websitename
export const websiteName = "Ecoride";