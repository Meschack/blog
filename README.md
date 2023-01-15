<div style="font-family:JetBrains Mono;font-weight:bolder;font-size:20px">

# CREATION D'UN BLOG AVEC PHP 8

## La base de données

Géré grâce à Adminer, la base de données `tutoblog` contient 4 quatre tables.

- Une table `post` qui contient les articles du blog. Elle contient quatre attributs : l'identifiant de l'article (_id_), le slug de l'article (_slug_), son contenu (_content_) et sa date de création (_created_at_). La clé primaire de la table est la clé `id` ;

  | id     | slug         | content      | created_at |
  | ------ | ------------ | ------------ | ---------- |
  | INT 🔑 | VARCHAR(255) | TEXT(650000) | DATETIME   |

- Une table `category` qui contient l'ensemble des différentes catégories des articles du blog. Elle contient trois attributs : l'identifiant de la catégorie (_id_) comme clé primaire, le nom de la catégorie (_name_) et le slug de la catégorie ;

  | id     | name         | slug         |
  | ------ | ------------ | ------------ |
  | INT 🔑 | VARCHAR(255) | VARCHAR(255) |

- Une table `post_category` qui sert à faire la liaison entre un article et les catégories qui lui sont associées. Elle contient deux attributs : l'identifiant de l'article (_post_id_) et l'identifiant de la catégorie (_category_id_). Ces deux attributs sont tous des clés étrangères qui référencent respectivement l'attribut _id_ de la table `post` et l'attribut _id_ de la table `category` ;

- Une table `user` qui contient l'ensemble des utilisateurs enregistrés sur le blog. Elle contient trois attributs : l'identifiant (_id_) de l'utilisateur, son nom (_username_) et son mot de passe (_password_).

  | id     | username     | password     |
  | ------ | ------------ | ------------ |
  | INT 🔑 | VARCHAR(255) | VARCHAR(255) |

Les informations de connexion de l'administrateur sont :<br />

- Nom : _admin_
- Mot de passe : _admin_
</div>
