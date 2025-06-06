# Les Stocks de Nassim 

Ce projet est une e-boutique développée avec Symfony. Il permet la navigation par catégories, la visualisation d’articles, la gestion d’un panier et la validation de commandes.  
Il a été réalisé dans le cadre d’un projet pédagogique et est hébergé en production à l’adresse suivante :  
 **URL du site en production :** [LesStocksDeNassim](http://belkacem.alwaysdata.net/)

##  Fonctionnalités avec statut

| Fonctionnalité                                                | État attendu                            |
|---------------------------------------------------------------|--------------------------------------------------------|
| Connexion (login)                                             | OK 
| Inscription                                                   | OK 
| Parcours par catégorie                                        | NOK 
| Parcours des articles                                         | OK
| Ajout au panier                                               | OK 
| Ajustement des quantités au panier avec prix total            | OK 
| Message de confirmation de commande                           | OK 
| Ajout d’un type d’article proposé                             | OK 
| Ajout d’une nouvelle catégorie                                | OK 
| Ajout de la commande dans la base de données                  | OK 

## Description du fonctionnement

Le site permet aux utilisateurs de s’inscrire et de se connecter.  
Les produits sont classés par catégorie.  
Chaque produit peut être consulté en détail et ajouté au panier.  
Le panier affiche les quantités, permet leur ajustement et met à jour le prix total.  
L’utilisateur peut valider sa commande, ce qui enregistre une commande en base de données.  
Une interface d’administration (si implémentée) permet l’ajout de produits et de catégories.

## Installation en local

Cloner ce dépôt :
```bash
git clone https://github.com/mon-utilisateur/ma-boutique.git
```
Installer les dépendances :

```bash
composer install 
```
Configurer le fichier .env avec vos accès base de données :
```bash
DATABASE_URL="mysql://user:password@127.0.0.1:3306/nom_de_la_bdd" // à changer en fonction de votre configuration 
```
Créer la base et lancer les migrations :

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

Lancer le serveur :
```bash
symfony server:start
```
Structure du projet : 


src/Controller/ — Contrôleurs pour la boutique, panier, admin...

src/Entity/ — Entités Symfony (Produit, Catégorie, User, Commande...)

templates/ — Fichiers Twig pour les pages

public/styles/ — Feuilles CSS par section 

## Technologies utilisées

- Symfony 7

- Doctrine ORM

- Twig

- PHP 8+

- MySQL ou MariaDB

- Bootstrap (CSS)

Bugs ou remarques : 

Les pages 404 et autres ne sont pas gérées. Le parcours par catégorie n'a pas été réalisé. 

Deadline
Ce dépôt Git reflète le code mis en production.
Date limite : Dimanche 11 mai à 23h59