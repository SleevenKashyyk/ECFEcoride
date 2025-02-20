# Ecoride 
Voici un site a vocation de co-voiturage écologique pour le client José 

# Installation

Déploiement de l'application EcoRide en local

## Prérequis
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

## Accéder à l'application
- Backend : `http://127.0.0.1:8000`
- Frontend : `http://localhost:3000` (selon la config du framework JS utilisé)

## 🛠 Dépannage
Si vous rencontrez des problèmes :
- Vérifiez que MySQL est bien démarré
- Vérifiez les logs (`var/log/` pour Symfony)
- Vérifiez votre fichier `.env`
- Lancez `composer dump-autoload`

## Licence
Ce projet est sous licence MIT. Voir `LICENSE` pour plus de détails.
