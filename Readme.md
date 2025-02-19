Documentation Technique de l'Application EcoRide

# Ecoride 
Voici un site a vocation de co-voiturage écologique pour le client José 

Documentation Technique de l'Application EcoRide

1. Réflexions Initiales Technologiques

EcoRide est une application visant à faciliter le covoiturage en mettant en relation des conducteurs et des passagers. Le choix technologique s'est porté sur :

Backend : Symfony (PHP)

Base de données : MySQL

Frontend : HTML 5, CSS (Bootstrap), JS

API : RESTful

Déploiement : Docker & AWS

2. Configuration de l’Environnement de Travail

Prérequis

PHP 8.x

Composer

Symfony CLI

Node.js & npm

MySQL 8.x

Docker & Docker Compose

Installation du Projet

# Installation

3. Modèle Conceptuel de Données

Le modèle conceptuel est basé sur les entités suivantes :

Utilisateur : informations personnelles

Voiture : modèle, immatriculation, énergie

Covoiturage : trajets proposés

Avis : notes et commentaires

Marque : marque des voitures

(Voir diagramme de classe ci-joint.)

4. Diagramme d’Utilisation

Le diagramme des cas d’utilisation présente les interactions des utilisateurs avec le système :

Inscription / Connexion

Ajout d’un véhicule

Proposition d’un covoiturage

Recherche et réservation d’un trajet

(Voir diagramme UML des cas d’utilisation.)

5. Diagramme de Séquence

Illustration des interactions principales entre les utilisateurs et le système, notamment :

Processus de réservation

Création d’un trajet

Validation des paiements

(Voir diagramme de séquence.)

6. Documentation du Déploiement

Étapes de déploiement

Préparation du serveur

Installer Docker et Docker Compose

Configurer la base de données MySQL

Déploiement de l’application

Builder et exécuter les conteneurs Docker

Exécuter les migrations de base de données

Configuration Nginx / Apache

Redirection des requêtes vers Symfony

Monitoring & Logs

Utilisation de PM2 pour superviser les processus

Intégration avec Sentry pour la gestion des erreurs

# Commmande