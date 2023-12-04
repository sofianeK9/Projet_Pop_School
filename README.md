# Pop School Gestionnaire d'Apprenants

Ce dépôt contient une application de gestion des données des apprenants pour Pop School. Cette application vise à centraliser et améliorer la gestion des informations des apprenants tout en respectant les normes du Règlement Général sur la Protection des Données (RGPD).

# Prérequis

- Linux, macOS ou Windows
- Bash
- PHP 8
- Composer
- Symfony CLI
- MariaDB 10

# Installation


```
git clone https://github.com/sofianeK9/Projet_Pop_School
cd pop_school
composer install
```
Créér une base de données et un utilisateur dédié pour cette base de données.


## Configuration

Créez un fichier `.env` à la racine du projet :

```
APP_ENV=dev
APP_DEBUG=true
APP_SECRET=123
DATABASE_URL="postgresql://app:!ChangeMe!@127.0.0.1:5432/app?serverVersion=15&charset=utf8"

```

Pensez à adapter la variable `APP_SECRET` et le mot de passe `123` dans la variable `DATABASE_URL`.

**Atention : `APP_SECRET` doit etre une chaine de caractére de 32 caractéres de valeurs en hexadecimal.**


## Migration et fixtures

Créér le fichier dofilo au sein du dossier bin et le rendre excecutable avec la commande :

```
bin/dofilo.sh
$ sudo chmod +x ./nom_du_fichier
```

Par la suite, copier dans le fichier dofilo ces lignes de code : 

```
php bin/console doctrine:database:drop --force --if-exists
php bin/console doctrine:database:create --no-interaction
php bin/console doctrine:migrations:migrate --no-interaction
php bin/console doctrine:fixtures:load --no-interaction --group=test

```
Pour que l'application soit utilisable, vous devez crééz le schéma de base de données et charger les données.


## Utilisation

Lancer le serveur web de developpement :

```
symfony serve
```

Puis ouvrir la page suivante : [https://local:host:8000](https://local:host:8000)