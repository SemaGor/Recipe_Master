<div class="page-header">
    <h1><?php echo TITRE_RECIPES_EDITFORM ?></h1>
</div>
<div>
    <a href="<?php echo ADMIN_ROOT; ?>/recipes">Retour à la liste des recettes</a> <br><br>
</div>
<form 
    action="<?php echo ADMIN_ROOT; ?>/recipes/edit"
    method="post"
    class="edit">

    <fieldset>
        <legend>Données de la Recette</legend>
        <div>
            <label for="test">Name</label>
            <input 
                type="text" 
                class="form-control" 
                id="dish_name" 
                name="name" 
                value="<?php echo $recipe['dish_name']; ?>" />
            
            <input 
                type="hidden" 
                id="dish_id" 
                name="dish_id" 
                value="<?php echo $recipe['dish_id']; ?>" />

            <label for="test">Description</label>
            <input 
                type="text" 
                id="dish_description" 
                name="dish_description" 
                value="<?php echo $recipe['dish_description']; ?>" />
            
            <label for="test">Time</label>
            <input 
                type="text" 
                id="dish_prep_time" 
                name="dish_prep_time" 
                value="<?php echo $recipe['dish_prep_time']; ?>" />
            
            <label for="test">Portions</label>
            <input 
                type="number" 
                id="dish_portions" 
                name="dish_portions" value="<?php echo $dish['dish_portions']; ?>" />
            <br><br>
            
    </fieldset>

    <!-- <div class="form-group row">
                    <label for="user_id" class="col-sm-2 col-form-label">Chef</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="user_id" id="user_id">
                            <?php foreach ($allUsers as $user): ?>
                                <option value="<?php echo $user['user_id']; ?>">
                                    <?php echo $user['user_name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="type_id" class="col-sm-2 col-form-label">Categories</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="type_id" id="type_id">
                            <?php foreach ($allCategories as $category): ?>
                                <option value="<?php echo $category['category_id']; ?>">
                                    <?php echo $category['category_name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <fieldset>
                    <legend>Ingrédients</legend>
                    <?php include_once '../app/models/ingredientsModel.php'; ?>
                    <?php foreach ($ingredients as $ingredient): ?>
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
                </fieldset> -->


                <div class="form-group row">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" class="btn btn-lg btn-primary" />
                    </div>
                </div>
</form>