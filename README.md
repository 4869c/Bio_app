# Bio Farms

Dispositif de la conduite et de gestion e-commerce des produits bio des fermes agricoles.

Application web e-commerce pour la vente de produits biologiques issus de fermes
agricoles (fruits, légumes, produits laitiers, miel, herbes). Les clients peuvent
parcourir le catalogue, remplir un panier et passer commande avec un paiement simulé.
Un espace administrateur permet de gérer les produits, les commandes et les comptes
administrateurs.

## Démo en ligne

Le site est accessible ici : https://bio.site.je/

L'espace administrateur n'apparaît pas dans le menu, il s'ouvre via son URL :
https://bio.site.je/admin/login

## Fonctionnalités

Côté client :
- Inscription, connexion et déconnexion
- Catalogue avec recherche par nom et filtres (catégorie, prix minimum / maximum)
- Panier : ajout, modification des quantités, suppression
- Commande : informations client, récapitulatif, paiement simulé et confirmation

Côté administrateur :
- Tableau de bord avec statistiques
- Gestion des produits (ajout, modification, suppression, image)
- Suivi des commandes (détails, statut de paiement et de livraison)
- Gestion des comptes administrateurs

## Technologies

- PHP / Laravel
- MySQL
- Bootstrap 5

## Lancer le projet

### Avec Docker

Prérequis : Docker Desktop installé et démarré.

```bash
git clone https://github.com/4869c/Bio_app.git
cd Bio_app
docker compose up --build
```

Ouvrez ensuite http://localhost:8000

Le premier démarrage prend quelques minutes (construction de l'image et
initialisation de MySQL). L'application crée la base de données, exécute les
migrations et insère les données de démonstration automatiquement.

Arrêter ou réinitialiser :

```bash
docker compose down        # arrêter les conteneurs
docker compose down -v     # arrêter et réinitialiser la base de données
```

### Avec Artisan

Si PHP, Composer et MySQL sont déjà installés, créez une base de données nommée
`bio_app`, puis exécutez :

```bash
composer install
cp .env.example .env            # Windows : copy .env.example .env
php artisan key:generate
```

Renseignez vos identifiants MySQL dans le fichier `.env` (`DB_DATABASE`,
`DB_USERNAME`, `DB_PASSWORD`), puis :

```bash
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

Le site est alors accessible sur http://127.0.0.1:8000

## Comptes de test

- Administrateur : `admin@bio.com` / `admin123`
- Client : créez votre propre compte depuis la page d'inscription.
