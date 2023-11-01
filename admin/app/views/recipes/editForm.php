<div class="page-header">
    <h1><?php echo TITRE_RECIPES_EDITFORM ?></h1>
</div>

<div>
    <a href="<?php echo ADMIN_ROOT; ?>/recipes">Retour à la liste des recettes</a><br><br>
</div>

<form action="<?php echo ADMIN_ROOT; ?>/recipes/edit" method="post" class="edit">
    <fieldset>
        <legend>Données de la Recette</legend>
        
        <div class="form-group row">
            <label for="dish_name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="dish_name" name="dish_name" value="<?php echo $recipe['dish_name']; ?>" required>
                <input type="hidden" id="dish_id" name="dish_id" value="<?php echo $recipe['dish_id']; ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="dish_description" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
                <input type="text" id="dish_description" name="dish_description" value="<?php echo $recipe['dish_description']; ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="dish_prep_time" class="col-sm-2 col-form-label">Time</label>
            <div class="col-sm-10">
                <input type="text" id="dish_prep_time" name="dish_prep_time" value="<?php echo $recipe['dish_prep_time']; ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="dish_portions" class="col-sm-2 col-form-label">Portions</label>
            <div class="col-sm-10">
                <input type="number" id="dish_portions" name="dish_portions" value="<?php echo $recipe['dish_portions']; ?>" required>
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
                <select class="form-control" name="type_id" id="type_id">
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
    <?php include_once '../app/models/ingredientsModel.php';
        $allIngredients = \App\Models\IngredientsModel\findAllIngredients($connexion); ?>

    <?php foreach ($allIngredients as $ingredient): ?>
        <div class="form-group row align-items-center">
            <div class="col-md-1">
                <input type="checkbox" name="ingredients[]" value="<?php echo $ingredient['ingr_id']; ?>"
                    id="ingredient-<?php echo $ingredient['ingr_id']; ?>">
            </div>
            <label for="ingredient-<?php echo $ingredient['ingr_id']; ?>" class="col-md-3 col-form-label">
                <?php echo $ingredient['ingr_name']; ?>
            </label>
            <label for="quantity-<?php echo $ingredient['ingr_id']; ?>" class="col-md-2 col-form-label">
                Quantité :
            </label>
            <div class="col-md-6">
                <select class="form-control" name="quantity-<?php echo $ingredient['ingr_id']; ?>"
                    id="quantity-<?php echo $ingredient['ingr_id']; ?>">
                    <?php for ($i = 0.5; $i <= 10; $i += 0.5): ?>
                        <option value="<?php echo $i; ?>">
                            <?php echo $i . " " . $ingredient['ingr_unit']; ?>
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
