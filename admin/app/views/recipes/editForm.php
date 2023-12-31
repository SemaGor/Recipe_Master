<div class="page-header">
    <h1><?php echo TITRE_RECIPES_EDITFORM ?></h1>
</div>

<div>
    <a href="<?php echo ADMIN_ROOT; ?>/recipes">Retour à la liste des recettes</a><br><br>
</div>

<form action="<?php echo ADMIN_ROOT; ?>/recipes/edit/<?php echo $recipe['id']; ?>" method="post" class="edit">
    <fieldset>
        <legend>Données de la Recette</legend>
        
        <div class="form-group row">
            <label for="dish_name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="dish_name" name="name" value="<?php echo $recipe['name']; ?>" required>
                <input type="hidden" id="dish_id" name="dish_id" value="<?php echo $recipe['id']; ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="dish_description" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
                <input type="text" id="dish_description" name="description" value="<?php echo $recipe['description']; ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="dish_prep_time" class="col-sm-2 col-form-label">Time</label>
            <div class="col-sm-10">
                <input type="text" id="dish_prep_time" name="time" value="<?php echo $recipe['time']; ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="dish_portions" class="col-sm-2 col-form-label">Portions</label>
            <div class="col-sm-10">
                <input type="number" id="dish_portions" name="portions" value="<?php echo $recipe['portions']; ?>">
            </div>
        </div>
    </fieldset>

    <fieldset>
        <legend>Informations sur le Chef</legend>

        <div class="form-group row">
        <?php include_once '../app/models/usersModel.php';
        $allUsers = \App\Models\UsersModel\findAllUsers($connexion); ?>
            <label for="user_id" class="col-sm-2 col-form-label">Chef</label>
            <div class="col-sm-10">
                <select class="form-control" name="user_id" id="user_id">
                    <?php foreach ($allUsers as $user): ?>
                        <option value="<?php echo $user['user_id']; ?>"
                            <?php if ($user['user_id'] === $recipe['user_id']) echo 'selected'; ?>>
                            <?php echo $user['user_name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </fieldset>

    <fieldset>
        <legend>Catégories de Recettes</legend>
        <div class="form-group row">
        <?php include_once '../app/models/categoriesModel.php';
        $allCategories = \App\Models\CategoriesModel\findAllCategories($connexion); ?>
            <label for="type_id" class="col-sm-2 col-form-label">Catégorie</label>
            <div class="col-sm-10">
                <select class="form-control" name="category_id" id="type_id">
                    <?php foreach ($allCategories as $category): ?>
                        <option value="<?php echo $category['category_id']; ?>"
                            <?php if ($category['category_id'] === $recipe['category_id']) echo 'selected'; ?>>
                            <?php echo $category['category_name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </fieldset>

    <fieldset>
    <legend>Ingrédients</legend>
    
       

    <?php foreach ($ingredients as $ingredient): ?>
        <?php if (!in_array($ingredient['ingredient_id'], $ingredients)): ?> 
        <!-- // Le code à l'intérieur de cette condition sera exécuté si $ingredient['ingredient_id'] n'est pas présent dans $ingredients. -->
            <div class="form-group row align-items-center">
                <div class="col-md-1">
                    <input type="checkbox"name="ingredients[]" value="<?php echo $ingredient['ingredient_id'] ; ?>"
                        chacked id="ingredient-<?php echo $ingredient['ingredient_id']; ?>">
                </div>
                <label for="ingredient-<?php echo $ingredient['ingredient_id']; ?>" class="col-md-3 col-form-label">
                <?php echo $ingredient['ingredient_name']; ?>
            </label>
        <?php else : ?>
                <div class="col-md-1">
                    <input type="checkbox" checked name="ingredients[]" value="<?php echo $ingredient['ingredient_id']; ?>"
                        id="ingredient-<?php echo $ingredient['ingredient_id']; ?>">
                </div>
                <label for="ingredient-<?php echo $ingredient['ingredient_id']; ?>" class="col-md-3 col-form-label">
                <?php echo $ingredient['ingredient_name']; ?>
            </label>
            <?php endif; ?>
            
            <label for="quantity-<?php echo $ingredient['ingredient_id']; ?>" class="col-md-2 col-form-label">
                Quantité :
            </label>
            <div class="col-md-6">
                <select class="form-control" name="quantity<?php echo $ingredient['ingredient_id']; ?>"
                    id="quantity<?php echo $ingredient['ingredient_id']; ?>">
                    <?php for ($i = 0.5; $i <= 10; $i += 0.5): ?>
                        <option value="<?php echo $i; ?>">
                            <?php echo $i . " " . $ingredient['ingredient_unit']; ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>
    <?php endforeach; ?>
</fieldset>

    <div class="form-group row">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" class="btn btn-lg btn-primary" />
        </div>
    </div>
</form>
