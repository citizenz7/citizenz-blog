# citizenz-blog
En cours de développement...

### FAIT
#### ARTICLES
- articles (détection du user qui poste l'article)
- slug Articles
- nb de lectures par article

#### Users
- connexion utilisateur
- rôles (USER, ADMIN)
- profil user
- password reset (reset-password-bundle)
- password confirm dans l'inscription

#### Catégories
- categories
- slug Categories
- afficher tous les articles par Catégorie

### Commentaires
- commentaires sur page SHOW article (détection du user qui poste le commentaire)
- commentaires : éditer et/ou supprimer son propre commentaire

#### Tags
- slug Tags
- affichage des tags sur la page de l'article (SHOW)
- afficher tous les articles par Tags

#### Sidebar
- catégories
- articles populaires (3 articles les plus lus/consultés)
- 3 derniers commentaires
- stats (articles, commentaires, membres, lectures)

#### Front & Fonctionalités
- pagination (KnpPaginatorBundle)
- CKEditor (textarea)
- pages d'erreur (prod) : 404, 403, 50x
- CGU
- à propos
- formulaire de recherche
- formulaire de contact


### TODO
- upload d'images
- affichage du nb d'articles par catégorie (sidebar)
- like sur article (+ ajax)
- espace d'administration (ADMIN)
- tri colonnes (notamment dans ADMIN)
- activer/désactiver un article (isEnable (boolean) - admin)
- activer/désactiver un commentaire (isEnable (boolean) - admin)
- archives
- flux RSS : articles
- section "A lire aussi" : bas d'article (show) - 3 articles avec mêmes tags