- [Base de données](#base-de-données)
- [Pour créer une nouvelle BDD](#pour-créer-une-nouvelle-bdd)
- [Pour créer des tables (DB Browser)](#pour-créer-des-tables-db-browser)
- [Connexion entre PHP et SQLite](#connexion-entre-php-et-sqlite)
- [INSERT : Ajouter du contenu](#insert--ajouter-du-contenu)
- [SELECT : Lire du contenu](#select--lire-du-contenu)
- [UPDATE : Changer du contenu](#update--changer-du-contenu)
- [DELETE : Supprimer un contenu](#delete--supprimer-un-contenu)

# Base de données

Une <span style="color: rgb(255, 100, 150)">**base de données**</span> a un nom et est composée d'un ensemble de "tables".

Chaque <span style="color: rgb(100, 255, 150)">**table**</span> représente une catégorie d'information et est composée de plusieurs colonnes.

Chaque <span style="color: rgb(100, 150, 255)">**colonne**</span> représente une information qui peut varier pour chaque entrée et doit avoir un type prédéfini.

Une <span style="color: rgb(255, 150, 255)">**entrée**</span> (ligne horizontale) est la valeur donnée à chaque colonne pour représenter un élément.

Par exemple:
- <span style="color: rgb(255, 100, 150)">**web4**</span> *(Base de donnée)*
    - <span style="color: rgb(100, 255, 150)">**etudiants**</span> *(Table, au pluriel)*
        - <span style="color: rgb(100, 150, 255)">prenom</span> *(Colonne)*
        - <span style="color: rgb(100, 150, 255)">nom</span> *(Colonne)*
        - ...
    - <span style="color: rgb(100, 255, 150)">**evaluations**</span> *(Table, au pluriel)*
        - <span style="color: rgb(100, 150, 255)">nom</span> *(Colonne)*
        - <span style="color: rgb(100, 150, 255)">pourcentage</span> *(Colonne)*
        - ...

<span style="color: rgb(255, 150, 255)">Julien (prenom) Duranleau (nom)</span> serait donc une entrée dans la table etudiants.


## Pour créer une nouvelle BDD:

1. Créer un fichier texte vide avec l'extension `.sqlite` (ex: `tp1.sqlite`)
2. Dans DB Browser, choisir `Open Database` (ctrl-o)

## Pour créer des tables (DB Browser)

Dans l'onglet `Database Structure`, utiliser le bouton `Create table`
    - Choisir le nom de la table (**au pluriel!**)
    - Ajouter les colonnes (fields)

Les différentes informations à fournir sont les suivantes:

| Nom de l'information | Description
| ----------------- | -------
| Name | Nom de la colonne
| Type | Type de valeur (comme C#)
| NN | Not Null, si la colonne peut rester vide ou pas
| PK | Primary Key. À cocher pour la colonne id seulement!
| AI | Auto increment. À cocher pour la colonne id seulement!
| U | Unique. Permet d'éviter que deux entrées ait la même valeur
| Default | Valeur par défaut, au besoin pour éviter un null par exemple
Pour les autres, on y revient aux prochains cours!


# Connexion entre PHP et SQLite

Pour se connecter à MySQL depuis notre code PHP, on utilise les fonctions de [PDO](https://www.php.net/manual/en/book.pdo.php).

```php
$bdd = new PDO("sqlite:" . __DIR__ . "/tp1.sqlite");

// Affichage des erreurs dans la page
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

// Résultats en tableaux associatifs : $entree["id"]
$bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
```

On peut ensuite exécuter des requêtes à partir de la variable `$bdd`. Il sera donc pratique d'avoir ce code dans un fichier à [`include()`](https://www.php.net/manual/en/function.include.php).


# SQL

Il existe 4 sortes de requêtes. Comme les 4 lettres de CRUD. Quel hasard! Ou pas...

- `INSERT` pour ajouter **une** entrée dans une table. `(C)`
- `SELECT` pour lire **une ou plusieurs** entrées. `(R)`
- `UPDATE` pour modifier **une ou plusieurs** entrées. `(U)`
- `DELETE` pour supprimer **une ou plusieurs** entrées. `(D)`

## INSERT : Ajouter du contenu

```sql
INSERT INTO nom_de_la_table
    (nom_colonne1, nom_colonne2, ...)
VALUES
    (valeur1, valeur2, ...);
```

Et avec PHP:
```php
include "includes/bdd.php";

$sql = '
    INSERT INTO etudiants
        (prenom, nom)
    VALUES
        (:prenom, :nom)
';

// :prenom et :nom sont des informations dynamiques à fournir lors du ->execute. Ce sont des choix arbitraires.

$stmt = $bdd->prepare($sql);

$success = $stmt->execute([
    ":prenom" => "Julien",
    ":nom" => "Duranleau",
]);
```

## SELECT : Lire du contenu

```sql
SELECT colonne1, colonne2, ...
FROM nom_de_la_table
WHERE une_condition_au_besoin;
```

Et avec PHP:
```php
include "includes/bdd.php";

$sql = '
    SELECT prenom, nom
    FROM etudiants
';

$stmt = $bdd->prepare($sql);

$stmt->execute([]);

$resultats = $stmt->fetchAll();
```

## UPDATE : Changer du contenu

```sql
UPDATE nom_de_la_table
SET 
    colonne1 = valeur1, 
    colonne2 = valeur2, 
    ...
WHERE une_condition_au_besoin;
```

Et avec PHP:
```php
include "includes/bdd.php";

// Change le nom pour "Wazowski" pour TOUS ceux dont le prénom est "Julien".

$sql = '
    UPDATE etudiants
    SET nom = :nom
    WHERE prenom = :prenom;
';

$stmt = $bdd->prepare($sql);

$success = $stmt->execute([
    ":prenom" => "Julien",
    ":nom" => "Wazowski",
]);
```

## DELETE : Supprimer un contenu

<span style="color: rgb(255, 100, 100)">**ATTENTION**, il faut toujours ajouter une condition (WHERE) au delete! Sinon toutes les entrées seront supprimées.</span>

```sql
DELETE FROM nom_de_la_table
WHERE une_condition;
```

Et avec PHP:
```php
include "includes/bdd.php";

// Supprime toutes les entrées dont le prénom est "Julien"

$sql = '
    DELETE FROM etudiants
    WHERE prenom = :prenom;
';

$stmt = $bdd->prepare($sql);

$success = $stmt->execute([
    ":prenom" => "Julien",
]);
```