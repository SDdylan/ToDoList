
# Projet ToDoList

Vous aimez notre application et voulez y contribuer ? Voici quelques règles à suivre ainsi que les bonnes pratiques attendues.

# Table des matières

1. Règles générales
1. Rapporter un bug/une idée
1. Développer une fonctionnalité
1. Qualité de code

## Règles générales

Vous avez décidé de contribuer à notre projet ? Voici quelques règles à suivre :
* Toute nouvelle fonctionnalité doit faire l'objet préalable d'une demande et d'une validation par l'auteur de l'application (voir section "Rapporter un bug/une idée").
* Toute idée ou suggestion est bonne à prendre, nous vous faisons confiance pour une bonne entente et des échanges courtois sur vos issues et pull requests.


## Rapporter un bug/une idée

Vous avez identifié un bug ou souhaitez suggérer une idée de développement ? Voici les étapes à suivre :
1. Rendez-vous dans la section Issues du projet GitHub : https://github.com/SDdylan/ToDoList/issues
1. Créez une nouvelle issue spécifiant votre besoin, bug ou ajout. Il est important alors d'y spécifier :
   * La fonctionnalité concernée par l'idée ou le bug.
   * Si c'est le cas, le fichier et ligne exacte d'apparition du bug.
   * Si déjà identifié, un descriptif de comment vous comptez résoudre ce bug/développer cette idée.
   * Si c'est le cas, les bibiothèques externes qui seront utilisées et/ou installées.
1. Une fois validé par un membre, suivez les étapes décrites dans la section "Développer une fonctionnalité" ci-dessous.

## Développer une fonctionnalité

Une fois que votre issue à été approuvé, veuillez suivre les étapes ci-dessous pour le développement.

1. Clonez le repository sur votre système.
1. Créez une nouvelle branche sur laquelle vous travaillerez sur l'issue en question.
1. Pushez votre code sur la branche correspondante.
1. Demandez ensuite une pull request, qui sera validée ou non par l'équipe.
  
## Qualité de code

Afin de garantir et de maintenir un haut niveau de qualité de code, quelques règles sont à respecter dans votre développement :
* Le respect des principales recommandations en vigueur est obligatoire (W3C pour le HTML/CSS ou PSR pour le PHP)
* L'utilisation d'outils tels que [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) ou [Codacy](https://www.codacy.com/) est fortement encouragé. Chaque pull request ou apport de nouveau code à l'application doit avoir fait l'objet d'analyse via un ou plusieurs de ces outils.
* Afin de maintenir le projet viable, le développement de tests unitaires et fonctionnels accompagnant vos ajouts est obligatoire. Ceux-ci devront être réalisés avec PHPUnit afin de maintenir une cohérence.

