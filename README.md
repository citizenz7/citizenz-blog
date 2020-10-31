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
- nuage de tags dans sidebar
- flux RSS des articles

#### Front & Fonctionnalités
- pagination (KnpPaginatorBundle)
- CKEditor (textarea)
- pages d'erreur (prod) : 404, 403, 50x
- CGU
- à propos
- formulaire de recherche
- formulaire de contact
- pagination catégories
- pagination tags
- seul l'administrateur a les droits pour créer, éditer, supprimer les Tags, Articles, Categories. Les commentaires peuvent être supprimés par leur auteur ou l'administrateur.


### TODO
- upload d'images
- archives
- affichage du nb d'articles par catégorie (sidebar)
- tri colonnes (Admin)