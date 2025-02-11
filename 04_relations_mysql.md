- [Relations SQL](#relations-sql)
- [Types de relations](#types-de-relations)
    - [One-to-one](#one-to-one-un-à-un)
    - [One-to-Many](#one-to-many-un-à-plusieurs)
    - [Many-to-Many](#many-to-many-plusieurs-à-plusieurs)
- [INNER JOIN](#inner-join)
- [ORDER BY](#order-by)

# Relations SQL

Pour exprimer le lien entre deux tables, on utilise des relations. 

Les relations sont illustrées dans la base de données par une colonne supplémentaire nommée "clé étrangère" (foreign key).

Les clés étrangères sont nommées selon le nom de l'autre table au singulier suivi de `_id`. Par exemple `utilisateur_id` pour une clé vers la table `utilisateurs`. Le type de valeur sera toujours un `INT`.

## Types de relations

Il existe principalement trois types de relations dans les bases de données relationnelles :

1. [**One-to-One (Un-à-Un)**](#one-to-one-un-à-un)
2. [**One-to-Many (Un-à-Plusieurs)**](#one-to-many-un-à-plusieurs)
3. [**Many-to-Many (Plusieurs-à-Plusieurs)**](#many-to-many-plusieurs-à-plusieurs)

- ### One-to-One (Un-à-Un)

    Dans une relation one-to-one, chaque enregistrement dans une table est lié à un seul enregistrement dans une autre table.

    <span style="color: lightgreen">La clé étrangère d'une relation one-to-one peut aller dans l'une des deux tables, peu importe laquelle.</span>

    **Exemple :** Une table `utilisateurs` peut avoir une relation one-to-one avec une table `profils`, où chaque utilisateur a un seul profil. Une clé `profil_id` serait ajoutée à la table `utilisateurs`.

    Ce type de relation est **peu fréquent**, mais reste important à connaître.


- ### One-to-Many (Un-à-Plusieurs)

    Dans une relation one-to-many, **un** enregistrement dans une table peut être lié à **plusieurs** enregistrements dans une autre table.

    <span style="color: lightgreen">La clé étrangère d'une relation one-to-many va TOUJOURS dans la table qui en contient "plusieurs".</span>

    **Exemple :** Une table `livres` peut avoir une relation one-to-many avec une table `chapitres`, où un livre a plusieurs chapitres, mais chaque chapitre est dans un seul livre. La clé serait alors `livre_id` dans la table `chapitres`.


- ### Many-to-Many (Plusieurs-à-Plusieurs)

    Dans une relation many-to-many, **plusieurs** enregistrements dans une table peuvent être associés à **plusieurs** enregistrements dans une autre table.

    <span style="color: lightgreen">La clé étrangère d'une relation many-to-many est particulière. Il faut créer une **table supplémentaire** qui contiendra la clé des DEUX tables. Cette table devrait être nommée avec le nom des deux autre tables au singulier, en ordre alphabétique et séparé par un `_`.</span>

    **Exemple :** Une relation many-to-many entre les tables `films` et `acteurs`, où un film a plusieurs acteurs, mais chaque acteur joue aussi dans plusieurs films. Il faudrait donc créer une **table** `acteur_film` qui contient les colonnes `id`, `acteur_id` et `film_id`.

    C'est le type de relation le plus commun!

--------------------------

## INNER JOIN

Une fois les relations établies dans la base de données, on peut utiliser ces relations dans nos requêtes SQL (SELECT, UPDATE ou DELETE) en utilisant le mot clé INNER JOIN.

**Exemple :** Pour obtenir tous les `chapitres` associés à un id de `livres` spécifique, la requête serait:

| Table: livres | |
| -- | -- |
| id | Int |
| titre | Text |

-----

| Table: chapitres | |
| -- | -- |
| id | Int |
| titre | Text |
| livre_id | Int |

```sql
SELECT 
    chapitres.*
FROM 
    chapitres
INNER JOIN 
    livres ON chapitres.livre_id = livres.id
WHERE livres.id = 1
```

Lorsqu'on travaille avec plusieurs tables, il est important de spécifier le nom de la table devant les colonnes.

### Plusieurs tables avec les mêmes colonnes

Si plusieurs tables ont une colonne avec le même nom, les valeurs seront écrasées! Pour éviter cela, on peut renommer (le temps de la requête) les colonnes avec le mot clé `AS`.

```sql
SELECT 
    livres.titre AS titre_livre,
    chapitres.titre
FROM 
    chapitres
INNER JOIN 
    livres ON chapitres.livre_id = livres.id
WHERE 
    livres.id = 1
```

## ORDER BY

Plutôt que de trier le résultat d'un SELECT sous forme de array en PHP, il est possible d'ajouter le mot clé `ORDER BY` suivi du nom d'une colonne.

Il est possible d'inverser l'ordre avec `DESC` à la fin.

Les titres de `Z` -> `A`:
```sql
SELECT 
    titres
FROM 
    livres
ORDER BY 
    titres DESC
```