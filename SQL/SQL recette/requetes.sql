1- Afficher toutes les recettes disponibles (nom de la recette, catégorie et temps de préparation) triées 
de façon décroissante sur la durée de réalisation

SELECT recipe_name, category_name, preparation_time
FROM recipe
INNER JOIN category ON recipe.id_category = category.id_category
ORDER BY preparation_time DESC

2- En modifiant la requête précédente, faites apparaître le nombre d’ingrédients nécessaire par recette.

SELECT recipe_name, preparation_time, COUNT(recipe_name)
FROM recipe
INNER JOIN recipe_ingredients ON recipe.id_recipe = recipe_ingredients.id_recipe
GROUP BY recipe.id_recipe
ORDER BY preparation_time DESC

3- Afficher les recettes qui nécessitent au moins 30 min de préparation

SELECT recipe_name, preparation_time
FROM recipe
WHERE preparation_time >= 30
ORDER BY preparation_time DESC

4- Afficher les recettes dont le nom contient le mot « Salade » (peu importe où est situé le mot en 
question)

SELECT recipe_name
FROM recipe
WHERE recipe_name LIKE '%salade%' OR instructions LIKE '%salad%'

5- Insérer une nouvelle recette : « Pâtes à la carbonara » dont la durée de réalisation est de 20 min avec 
les instructions de votre choix. Pensez à alimenter votre base de données en conséquence afin de 
pouvoir lister les détails de cette recettes (ingrédients)

INSERT INTO recipe (recipe_name,preparation_time,instructions,id_category)
VALUE ('Pates à la carbonara',30,'faites bouillir les pâtes, en parallele cuire les lardons avec de la crème fraiche, mélanger une fois les pâtes cuites, servez',2);

INSERT INTO ingredient (ingredient_name,unity,price)
VALUE ('lardon','g',0.02),
		('crème','L',6.5);

INSERT INTO recipe_ingredients (quantity, id_ingredient,id_recipe)
VALUE (100,24,11),
		(0.2,25,11),
		(150,1,11);

6- Modifier le nom de la recette ayant comme identifiant id_recette = 3 (nom de la recette à votre 
convenance)

UPDATE recipe
SET recipe_name = 'salade de fruit automne'
WHERE id_recipe = 3;

7- Supprimer la recette n°2 de la base de données

DELETE FROM recipe_ingredients
WHERE id_recipe = 2;

DELETE FROM recipe
WHERE id_recipe = 2;

8- Afficher le prix total de la recette n°5

SELECT recipe_name, preparation_time, SUM(ingredient.price*quantity) AS prix
FROM recipe
INNER JOIN recipe_ingredients ON recipe.id_recipe = recipe_ingredients.id_recipe 
JOIN ingredient ON recipe_ingredients.id_ingredient = ingredient.id_ingredient
WHERE recipe.id_recipe = 5
GROUP BY recipe.id_recipe

9- Afficher le détail de la recette n°5 (liste des ingrédients, quantités et prix)

SELECT recipe_name,ingredient_name,quantity,price
FROM recipe
INNER JOIN recipe_ingredients ON recipe.id_recipe = recipe_ingredients.id_recipe 
JOIN ingredient ON recipe_ingredients.id_ingredient = ingredient.id_ingredient
WHERE recipe.id_recipe = 5

10- Ajouter un ingrédient en base de données : Poivre, unité : cuillère à café, prix : 2.5 €

INSERT INTO ingredient (ingredient_name,unity,price)
VALUE ('poivre','cuillère à café',2.5)

11- Modifier le prix de l’ingrédient n°12 (prix à votre convenance)

UPDATE ingredient
SET price = 1.05
WHERE id_ingredient = 12;

12- Afficher le nombre de recettes par catégories : X entrées, Y plats, Z desserts

SELECT category_name, SUM() AS nbCategorie
FROM recipe
INNER JOIN category ON recipe.id_category = category.id_category
GROUP BY recipe.id_category

13- Afficher les recettes qui contiennent l’ingrédient « Poulet »

SELECT recipe_name
FROM recipe
INNER JOIN recipe_ingredients ON recipe.id_recipe = recipe_ingredients.id_recipe 
JOIN ingredient ON recipe_ingredients.id_ingredient = ingredient.id_ingredient
WHERE ingredient.ingredient_name LIKE '%Poulet%'

14- Mettez à jour toutes les recettes en diminuant leur temps de préparation de 5 minutes 

UPDATE recipe
SET preparation_time = preparation_time - 5

15- Afficher les recettes qui ne nécessitent pas d’ingrédients coûtant plus de 2€ par unité de mesure

SELECT recipe_name
FROM recipe
INNER JOIN recipe_ingredients ON recipe.id_recipe = recipe_ingredients.id_recipe 
JOIN ingredient ON recipe_ingredients.id_ingredient = ingredient.id_ingredient
WHERE recipe.id_recipe NOT IN (SELECT recipe.id_recipe
							FROM recipe 
							INNER JOIN recipe_ingredients ON recipe.id_recipe = recipe_ingredients.id_recipe 
							JOIN ingredient ON recipe_ingredients.id_ingredient = ingredient.id_ingredient
							WHERE price > 2)
GROUP BY recipe_name

16- Afficher la / les recette(s) les plus rapides à préparer

SELECT recipe_name, preparation_time
FROM recipe
WHERE preparation_time = (SELECT MIN(preparation_time)
							FROM recipe)


17- Trouver les recettes qui ne nécessitent aucun ingrédient (par exemple la recette de la tasse d’eau 
chaude qui consiste à verser de l’eau chaude dans une tasse)
18- Trouver les ingrédients qui sont utilisés dans au moins 3 recettes
19- Ajouter un nouvel ingrédient à une recette spécifique
20- Bonus : Trouver la recette la plus coûteuse de la base de données (il peut y avoir des ex aequo, il est 
donc exclu d’utiliser la clause LIMIT