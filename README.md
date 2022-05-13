# Snow Tricks / Projet 6 OpenClassrooms

Ce projet est une application de ToDoList améliorée a partir de [ce projet](https://github.com/saro0h/projet8-TodoList) réalisé dans le cadre de ma formation PHP/Symfony avec OpenClassrooms.

[![Codacy Badge](https://app.codacy.com/project/badge/Grade/800ecefdb0944212b7f86c525a0b31b9)](https://www.codacy.com/gh/SDdylan/ToDoList/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=SDdylan/ToDoList&amp;utm_campaign=Badge_Grade)
## Fonctionnalités

Les différentes Fonctionnalités de ce projet sont les suivantes :
* Espace utilisateur
* Espace utilisateurs admin permettant de modifier les autres utilisateurs
* Ajout, édition et suppression de tâches à faire
* Possibilité de marquer une tâche en terminée
* Visualisation de la liste des tâches à faire/terminées

## Technologies

* WampServer 3.2.6
    * Apache 2.4.51
    * PHP 7.4.29
    * MySQL 5.7.36
* Bootstrap 3.3.7
* JavaScript
* Composer 2.3.5 
* Symfony 5.4.8

## Installation

### Configuration de l'environnement

Il est nécessaire d'avoir un environnement local avec MySQL, PHP et Apache.  
Pour la configuration d'un VirtualHost je vous laisse le soin de consulter la documentation de votre plateforme de développement web (par exemple: [WAMP](https://www.wampserver.com/) ou [XAMPP](https://doc.ubuntu-fr.org/xampp)).

### Déploiement du projet

Téléchargez manuellement le contenu de ce dépôt GitHub dans un dossier de votre système.
Vous pouvez également utiliser Git avec un terminal à la racine d'un dossier de votre choix :
```
git clone https://github.com/SDdylan/ToDoList.git
```
Pour la prochaine étapes, vous aurez besoin de [**Composer**](https://getcomposer.org/download/), veillez à l'installer si vous ne disposez pas déjà de ce dernier sur votre système.  
Installez ensuite les librairies de ce projet à l'aide d'un terminal à la racine de l'application avec la commande ci-dessous :
```
composer install
```

### Base de données

Veillez dans un premier temps à changer la valeur de la connexion dans le fichier **.env**, il s'agit de la variable *DATABASE_URL*.

Dans un terminal à la racine du projet executez la commande suivante pour créer la base de donnée :
```
php bin/console doctrine:database:create
```
Créez ensuite la structure de cette base de donnée :
```
php bin/console doctrine:migrations:migrate
```

Et enfin pour remplir la base avec des donnée en utilisant la commande suivante :
```
php bin/console doctrine:fixtures:load
```

Pour vous connecter en tant qu'administrateur ou en tant qu'utilisateur vous pouvez récupérer les identifiants dans le fichier **AppFixtures.php** entre les lignes 17 et 32.
### Tests

Si vous souhaitez lancer les tests unitaires et fonctionnels et créer un rapport de couverture de code, lancez la commande suivante à la racine du projet :
```
vendor/bin/phpunit --coverage-html tests/code-coverage
```
Le rapport sera produit en HTML et disponible dans le dossier tests/test-coverage, vous pouvez ouvrir le fichier index.html dans le navigateur pour accèder au rapport.
## Auteurs

[@SDdylan](https://github.com/SDdylan) sous la supervision de [@aurelienk](https://github.com/aurelienk).
