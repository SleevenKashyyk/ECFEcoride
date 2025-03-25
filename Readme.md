### 🔹 Objectif du projet
EcoRide est une plateforme de covoiturage écologique visant à optimiser les trajets et réduire l’empreinte carbone en facilitant le partage de véhicules.

### 🔹 Technologies choisies
Pour assurer performance, scalabilité et maintenabilité, voici les éléments mis en place:
- **Backend** : Symfony (PHP 8+) pour sa robustesse et son intégration facile avec Doctrine.
- **Base de données** : MySQL pour stocker les utilisateurs, trajets et transactions.
- **Frontend** : Bootstrap pour un design responsive et fluide.
- **Gestion des API** : Nelmio pour documenter et faciliter l'accès aux endpoints REST.
- **Sécurité** : Utilisation de tokens pour l'authentification des utilisateurs via JWT.
- **Contrôle de version** : GitHub pour la gestion du code source.

## 2️⃣ Configuration de l'Environnement de Travail

### 📌 Prérequis
Avant de commencer, assurez-vous d'avoir installé les éléments suivants :
- **PHP 8+**
- **Composer**
- **Symfony CLI**
- **MySQL**
- **Node.js + npm** (pour le frontend, si applicable)
- **Bootstrap** (inclus via npm ou CDN)
- **Git**

## Installation et Configuration

### 1️⃣ Cloner le dépôt Git
```bash
git clone https://github.com/SleevenKashyyk/ECFEcoride.git
cd EcoRide
```

### 2️⃣ Installer les dépendances backend
```bash
composer install
```

### 3️⃣ Configurer l'environnement
Copiez le fichier `.env.example` et renommez-le en `.env`, puis configurez votre base de données MySQL :
```dotenv
DATABASE_URL="mysql://sleeven:SevenKashyyk2025@127.0.0.1:3306/Ecoride"
```

### 4️⃣ Créer et peupler la base de données
```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```

### 5️⃣ Lancer le serveur Symfony
```bash
symfony server:start
```

### 6️⃣ Installer et configurer le frontend avec Bootstrap
Si Bootstrap est utilisé via npm, installez-le :
```bash
cd frontend
npm install bootstrap
npm install
npm run dev
```
Sinon, utilisez le CDN Bootstrap directement dans vos fichiers HTML.

## Accéder à l'application
- Backend : `http://127.0.0.1:8000`
- Frontend : `http://localhost:3000` (selon la config du framework JS utilisé)
- Documentation API : `http://127.0.0.1:8000/api/doc` (via Nelmio)

## Utilisation de l'API
L'API est accessible via `http://127.0.0.1:8000/api/doc`, générée avec **Nelmio API Doc**. Elle permet d'effectuer les opérations **CRUD** sur les entités principales de l'application.

### Authentification avec Token
- L'accès aux routes protégées nécessite un **token**.
- Le token doit être inclus dans l'en-tête `Authorization`.
- La session garde le token actif pour l’ensemble des requêtes tant que l’utilisateur est connecté.

## Dépannage
Si vous rencontrez des problèmes :
- Vérifiez que MySQL est bien démarré
- Vérifiez les logs (`var/log/` pour Symfony)
- Vérifiez votre fichier `.env`
- Lancez `composer dump-autoload`



