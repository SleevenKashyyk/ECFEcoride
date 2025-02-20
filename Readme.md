# Ecoride 
Voici un site a vocation de co-voiturage écologique pour le client José 

# Installation

## 📌 Prérequis
Avant de commencer, assurez-vous d'avoir installé les éléments suivants :

- **PHP 8+**
- **Composer**
- **Symfony CLI**
- **MySQL**
- **Node.js + npm** (pour le frontend, si applicable)
- **Bootstrap** (inclus via npm ou CDN)
- **Git**

## 🚀 Installation et Configuration

### 1️⃣ Cloner le dépôt Git
```bash
git clone https://github.com/utilisateur/EcoRide.git
cd EcoRide
```

### 2️⃣ Installer les dépendances backend
```bash
composer install
```

### 3️⃣ Configurer l'environnement
Copiez le fichier `.env.example` et renommez-le en `.env`, puis configurez votre base de données MySQL :
```dotenv
DATABASE_URL="mysql://user:password@127.0.0.1:3306/ecoride_db"
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

## ✅ Accéder à l'application
- Backend : `http://127.0.0.1:8000`
- Frontend : `http://localhost:3000` (selon la config du framework JS utilisé)
- Documentation API : `http://127.0.0.1:8000/api/doc` (via Nelmio)

## 🔗 Utilisation de l'API
L'API est accessible via `http://127.0.0.1:8000/api/doc`, générée avec **Nelmio API Doc**. Elle permet d'effectuer les opérations **CRUD** sur les entités principales de l'application.

### 🔑 Authentification avec Token
- L'accès aux routes protégées nécessite un **token**.
- Le token doit être inclus dans l'en-tête `Authorization` sous la forme `Bearer <votre_token>`.
- La session garde le token actif pour l’ensemble des requêtes tant que l’utilisateur est connecté.

## 🛠 Dépannage
Si vous rencontrez des problèmes :
- Vérifiez que MySQL est bien démarré
- Vérifiez les logs (`var/log/` pour Symfony)
- Vérifiez votre fichier `.env`
- Lancez `composer dump-autoload`

## 📜 Licence
Ce projet est sous licence MIT. Voir `LICENSE` pour plus de détails.

