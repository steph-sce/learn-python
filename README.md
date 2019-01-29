# learn-python
Projet 2 - Ecole multimédia

### Pour lancer le projet :
1. > git clone https://github.com/steph28/learn-python.git
2. > git checkout dev
3. créer le fichier .env sans oublier de modifier les infos pour la base de données (voir Trello)
4. > composer install
5. lancer votre serveur (wamp, xampp, lamp,...)
6. > php bin/console doctrine:database:create (génère la BDD)
7. > php bin/console make:migration (génère le fichier de migration des entitées)
8. > php bin/console doctrine:migrations:migrate (exporte le schéma des entitées dans la BDD)
9. > php bin/console doctrine:fixtures:load (pour les fixtures)
10. > php bin/console server:run

### [Lien vers mon Trello](https://trello.com/b/L7O7Nl4Z/learn-python)
### [Lien vers ma modélisation de BDD](https://www.dbdesigner.net/designer/schema/221575)
