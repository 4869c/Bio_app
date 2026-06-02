# 🌿 Bio Farms — E-commerce de produits bio

**Dispositif de la conduite et de gestion e-commerce des produits bio des fermes agricoles.**

Application web e-commerce développée avec **PHP / Laravel 13**, **MySQL** et **Bootstrap 5**.
Elle permet aux clients de parcourir des produits bio, de remplir un panier, de passer commande
avec un paiement simulé, et offre aux administrateurs un tableau de bord complet (produits,
commandes, comptes administrateurs).

---

## 📋 Table des matières

1. [Prérequis](#1-prérequis)
2. [Étape 1 — Installer Laravel Herd](#2-étape-1--installer-laravel-herd)
3. [Étape 2 — Installer MySQL](#3-étape-2--installer-mysql)
4. [Étape 3 — Cloner le projet depuis GitHub](#4-étape-3--cloner-le-projet-depuis-github)
5. [Étape 4 — Installer les dépendances](#5-étape-4--installer-les-dépendances)
6. [Étape 5 — Configurer l'environnement (.env)](#6-étape-5--configurer-lenvironnement-env)
7. [Étape 6 — Créer et remplir la base de données](#7-étape-6--créer-et-remplir-la-base-de-données)
8. [Étape 7 — Lier le dossier de stockage (images)](#8-étape-7--lier-le-dossier-de-stockage-images)
9. [Étape 8 — Lancer le projet](#9-étape-8--lancer-le-projet)
10. [Comptes de test](#10-comptes-de-test)
11. [Récapitulatif des commandes](#11-récapitulatif-des-commandes)
12. [Dépannage (erreurs fréquentes)](#12-dépannage-erreurs-fréquentes)

---

## 1. Prérequis

Avant de commencer, vous avez besoin de **deux outils** installés sur votre machine :

| Outil | Rôle | Lien |
|-------|------|------|
| **Git** | Cloner (télécharger) le projet depuis GitHub | <https://git-scm.com/downloads> |
| **Laravel Herd** | Fournit PHP + Composer (environnement d'exécution) | <https://herd.laravel.com> |

> 💡 **Pourquoi Laravel Herd ?** Herd installe automatiquement **PHP**, **Composer**, **nginx** et
> **Node.js** d'un seul coup. Vous n'avez donc pas à installer PHP ni Composer manuellement :
> tout est prêt après l'installation de Herd.

Ce guide est rédigé pour **Windows**. Les étapes sont quasi identiques sur **macOS**
(les rares différences sont signalées par 🍎).

---

## 2. Étape 1 — Installer Laravel Herd

1. Rendez-vous sur **<https://herd.laravel.com>** et cliquez sur **Download for Windows**
   (🍎 *Download for macOS* sur Mac).
2. Lancez le fichier téléchargé (`Herd.exe`) et suivez l'assistant d'installation
   (cliquez **Next / Install**, puis **Finish**). Herd installe :
   - **PHP** (dernière version)
   - **Composer** (gestionnaire de dépendances PHP)
   - **nginx** + **Dnsmasq** (serveur web local + domaines `*.test`)
   - **Node.js**
3. Ouvrez l'application **Herd** une première fois pour qu'elle termine sa configuration.
4. **Vérifiez l'installation.** Ouvrez un **nouveau** terminal
   (PowerShell, l'invite de commandes, ou le terminal intégré de Herd) et tapez :

   ```bash
   php --version
   composer --version
   ```

   Vous devez voir une version de **PHP 8.3** (ou supérieure) et une version de **Composer**.
   Si ces commandes sont reconnues, Herd est correctement installé. ✅

> ⚠️ Si `php` n'est pas reconnu, **fermez et rouvrez** votre terminal (Herd ajoute PHP au
> `PATH` du système ; un terminal déjà ouvert ne connaît pas encore ce changement).

---

## 3. Étape 2 — Installer MySQL

Ce projet utilise une base de données **MySQL** nommée `bio_app`.

> ℹ️ **Important :** la version **gratuite** de Herd fournit PHP, mais **pas** de serveur MySQL.
> Vous avez deux options :

### Option A — Installer MySQL séparément (recommandé)

1. Téléchargez **MySQL Community Server** : <https://dev.mysql.com/downloads/installer/>
   (sur Windows, choisissez *MySQL Installer*).
2. Pendant l'installation :
   - définissez un **mot de passe `root`** (notez-le, il servira dans le fichier `.env`),
   - laissez le port par défaut **3306**,
   - activez MySQL **en tant que service** (pour qu'il démarre automatiquement).
3. *(Optionnel mais pratique)* installez un outil graphique pour gérer la base :
   **MySQL Workbench**, **phpMyAdmin**, **TablePlus** ou **DBngin**.

> 🍎 Sur macOS, le plus simple est **DBngin** (<https://dbngin.com>) : un clic pour démarrer
> un serveur MySQL gratuit.
>
> 💎 Si vous possédez **Herd Pro**, MySQL est intégré : ouvrez Herd → onglet **Services** →
> **+ MySQL**, et le serveur démarre tout seul.

### Option B — Sans MySQL : utiliser SQLite (le plus rapide)

Si vous voulez simplement **tester le projet sans installer MySQL**, vous pouvez utiliser
SQLite (un fichier unique, aucun serveur à installer). Voir l'encadré *« Alternative SQLite »*
à l'[étape 6](#7-étape-6--créer-et-remplir-la-base-de-données).

---

## 4. Étape 3 — Cloner le projet depuis GitHub

Ouvrez un terminal dans le dossier où vous voulez placer le projet
(par exemple le Bureau), puis exécutez :

```bash
git clone https://github.com/4869c/Bio_app.git
cd Bio_app
```

`git clone` télécharge tout le code du projet, et `cd Bio_app` entre dans le dossier créé.
Toutes les commandes suivantes doivent être exécutées **à l'intérieur de ce dossier**.

---

## 5. Étape 4 — Installer les dépendances

Le code des bibliothèques (le dossier `vendor/`) n'est **pas** stocké sur GitHub.
On le télécharge avec Composer (fourni par Herd) :

```bash
composer install
```

Cette commande lit le fichier `composer.json` et télécharge Laravel ainsi que toutes
les bibliothèques nécessaires. (Cela peut prendre une à deux minutes.)

> 💡 **Node.js / npm ne sont pas nécessaires** pour faire tourner cette application :
> l'interface utilise Bootstrap via un CDN, il n'y a donc rien à « compiler ».

---

## 6. Étape 5 — Configurer l'environnement (.env)

Le fichier `.env` contient la configuration (base de données, clé de l'application…).
Il n'est pas sur GitHub pour des raisons de sécurité ; on le crée à partir de l'exemple fourni.

1. **Copier le fichier d'exemple :**

   ```bash
   # Windows (invite de commandes)
   copy .env.example .env
   ```
   ```powershell
   # Windows (PowerShell)
   Copy-Item .env.example .env
   ```
   ```bash
   # 🍎 macOS / Linux
   cp .env.example .env
   ```

2. **Générer la clé de l'application :**

   ```bash
   php artisan key:generate
   ```

   Cette commande remplit automatiquement la ligne `APP_KEY=` dans `.env`
   (clé de chiffrement obligatoire).

3. **Renseigner les identifiants de la base de données.** Ouvrez le fichier `.env`
   et vérifiez/modifiez ces lignes avec le mot de passe MySQL choisi à l'étape 2 :

   ```dotenv
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=bio_app
   DB_USERNAME=root
   DB_PASSWORD=votre_mot_de_passe_mysql
   ```

---

## 7. Étape 6 — Créer et remplir la base de données

1. **Créer une base de données vide** nommée `bio_app`.

   Avec un outil graphique (MySQL Workbench, phpMyAdmin, TablePlus…), créez une nouvelle
   base appelée **`bio_app`**. En ligne de commande, c'est :

   ```sql
   CREATE DATABASE bio_app;
   ```

2. **Créer les tables** (migrations) **et insérer les données de départ** (seeders)
   en une seule commande :

   ```bash
   php artisan migrate --seed
   ```

   - `migrate` crée toutes les tables : `users`, `admins`, `products`, `orders`,
     `order_items`, ainsi que les tables système de Laravel (`sessions`, `cache`, `jobs`).
   - `--seed` remplit la base avec un **compte administrateur** et une liste de
     **produits bio** de démonstration.

> ⚠️ **Cette étape est obligatoire.** L'application stocke les sessions (et donc le panier)
> dans la base de données (`SESSION_DRIVER=database`). Sans les migrations, le site
> renverra une erreur dès la première page.

<details>
<summary>🪶 <strong>Alternative SQLite (sans installer MySQL)</strong></summary>

Si vous avez choisi l'option SQLite à l'étape 2, faites ceci **à la place** de ce qui précède :

1. Dans `.env`, remplacez la ligne de connexion par :
   ```dotenv
   DB_CONNECTION=sqlite
   ```
   et **supprimez (ou commentez)** les lignes `DB_HOST`, `DB_PORT`, `DB_DATABASE`,
   `DB_USERNAME`, `DB_PASSWORD`.

2. Créez le fichier de base de données vide :
   ```bash
   # Windows (invite de commandes)
   type nul > database\database.sqlite
   ```
   ```powershell
   # Windows (PowerShell)
   New-Item database\database.sqlite
   ```
   ```bash
   # 🍎 macOS / Linux
   touch database/database.sqlite
   ```

3. Lancez les migrations et les données :
   ```bash
   php artisan migrate --seed
   ```
</details>

---

## 8. Étape 7 — Lier le dossier de stockage (images)

Les images des produits sont enregistrées dans `storage/`. Pour qu'elles soient visibles
depuis le navigateur, on crée un lien symbolique vers le dossier public :

```bash
php artisan storage:link
```

À exécuter **une seule fois**. Sans cela, les images des produits ne s'afficheront pas.

---

## 9. Étape 8 — Lancer le projet

Tout est prêt ! Démarrez le serveur de développement Laravel :

```bash
php artisan serve
```

Vous verrez un message du type :

```
INFO  Server running on [http://127.0.0.1:8000].
```

Ouvrez votre navigateur à l'adresse **<http://127.0.0.1:8000>** 🎉

Pour **arrêter** le serveur, revenez dans le terminal et appuyez sur **Ctrl + C**.

> 🚀 **Bonus — le domaine `.test` de Herd.** Si vous placez le dossier du projet dans un
> répertoire « parké » par Herd (onglet *Sites* de l'application Herd), le site est aussi
> servi automatiquement à l'adresse **http://bio_app.test**, sans avoir à lancer
> `php artisan serve`. La méthode `php artisan serve` ci-dessus fonctionne dans tous les cas.

---

## 10. Comptes de test

### 👤 Espace client
Créez votre propre compte via la page **Inscription** (<http://127.0.0.1:8000/register>),
ou connectez-vous si vous en avez déjà un.

### 🔑 Espace administrateur
L'espace admin n'a **aucun lien dans le menu** : il est volontairement accessible
uniquement en tapant son URL.

| Champ | Valeur |
|-------|--------|
| **URL de connexion** | <http://127.0.0.1:8000/admin/login> |
| **Email** | `admin@bio.com` |
| **Mot de passe** | `admin123` |

Une fois connecté, le tableau de bord se trouve sur `/admin/dashboard`
(produits, commandes, gestion des administrateurs).

---

## 11. Récapitulatif des commandes

Pour une installation complète, dans l'ordre :

```bash
# 1. Cloner le projet
git clone https://github.com/4869c/Bio_app.git
cd Bio_app

# 2. Installer les dépendances PHP
composer install

# 3. Préparer l'environnement
copy .env.example .env        # (macOS/Linux : cp .env.example .env)
php artisan key:generate

#    → éditez .env pour renseigner DB_DATABASE, DB_USERNAME, DB_PASSWORD
#    → créez la base 'bio_app' dans MySQL

# 4. Base de données + données de départ
php artisan migrate --seed

# 5. Lien des images
php artisan storage:link

# 6. Lancer le serveur
php artisan serve
```

Puis ouvrez **<http://127.0.0.1:8000>**.

---

## 12. Dépannage (erreurs fréquentes)

| Problème | Cause / Solution |
|----------|------------------|
| **`php` n'est pas reconnu** | Fermez puis rouvrez le terminal après l'installation de Herd. |
| **`No application encryption key has been specified.`** | Vous avez oublié `php artisan key:generate`. |
| **`SQLSTATE[HY000] [2002] ... Connection refused`** | Le serveur MySQL n'est pas démarré, ou les identifiants dans `.env` sont incorrects. Vérifiez que MySQL tourne et que `DB_PASSWORD` est correct. |
| **`Unknown database 'bio_app'`** | La base n'existe pas encore : créez-la (`CREATE DATABASE bio_app;`) avant `php artisan migrate`. |
| **`Table ... sessions doesn't exist`** | Les migrations n'ont pas été exécutées : lancez `php artisan migrate --seed`. |
| **Les images des produits ne s'affichent pas** | Vous avez oublié `php artisan storage:link`. |
| **`Address already in use` (port 8000 occupé)** | Lancez sur un autre port : `php artisan serve --port=8080`, puis ouvrez `http://127.0.0.1:8080`. |
| **Changement de `.env` non pris en compte** | Videz le cache de configuration : `php artisan config:clear`. |

---

<p align="center"><em>Projet académique — Bio Farms · PHP / Laravel · MySQL · Bootstrap 5</em></p>
