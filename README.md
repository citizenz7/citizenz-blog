# citizenz-blog
En cours de développement...

### CE QUI EST FAIT
#### ARTICLES
- articles (détection du user qui poste l'article)
- slug Articles
- nb de lectures par article
- activer/désactiver un article (isInactive (boolean) - admin)

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

#### Commentaires
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

#### Front & Fonctionnalités
- pagination (KnpPaginatorBundle)
- CKEditor (textarea)
- pages d'erreur (prod) : 404, 403, 50x
- CGU
- à propos
- formulaire de recherche
- formulaire de contact
- flux RSS : articles
- pagination catégories
- pagination tags


### TODO
- upload d'images
- nuage de tags dans sidebar
- archives
- user : page publique pour le pseudo, nb d'articles et de commentaires + liens
- affichage du nb d'articles par catégorie (sidebar)
- espace d'administration (ADMIN)
- tri colonnes (notamment dans ADMIN)
- section "A lire aussi" : bas d'article (show) - 3 articles avec mêmes tags