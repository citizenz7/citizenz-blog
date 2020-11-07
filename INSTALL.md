## Pour installer le blog :

0- Prérequis : serveur web (Apache/Nginx...), serveur MySQL (Mariadb recommandé), PHP (7.4 recommandé), Composer, phpMyAdmin (ou Adminer)

1- `git clone https://github.com/citizenz7/citizenz-blog.git` - Renommez le dossier créé comme vous voulez...
2- cd citizenz-blog (ou le nom que vous venez de donner)
3- `composer install`
4- dans config/packages/twig.yaml : changez/adaptez les variables du site (changez également le logo dans la navbar de templates/base.html.twig, ligne 36)
5- pages : A propos, CGU, Contact : changez/adaptez les infos
6- ContactController.php : changez les infos, adresse e-mail
7- templates/home/sidebar.html.twig + templates/base.html.twig : changez/adaptez les infos (Réseaux sociaux, etc.) et adaptez le fichier src/rss/Rss.php
8- changez/adaptez le fichier .env à la racine du site (MAILER_DSN et DATABASE_URL)
9- créez la base de données : `php bin/console doctrine:database:create`
10- effectuez la migration : `php bin/console make:migration`
11- alimentez la base de données : `php bin/console doctrine:migrations:migrate`
12- Le site est prêt !
13- Pour l'héberger, n'oubliez pas de faire pointer le serveur web vers le répertoire /public
-------------
14- Commencez par créer un user : cliquez sur `S'enregistrer` dans la navbar
15- Allez dans phpMyAdmin (ou Adminer) définissez le role de votre user à `['ROLE_ADMIN']`
16- Connectez-vous avec vos identifiants (depuis `Connexion` dans la navbar)
17- Dans la navbar cliquez sur votre pseudo. Vous arriverez sur votre profil et vous aurez accès aux liens d'administration
18- Créez les catégories
19- Créez les tags
20- Enfin, créez vos articles