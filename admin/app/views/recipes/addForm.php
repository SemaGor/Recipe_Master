<div class="page-header mt-3">
    <h1>Ajout d'une recette</h1>
</div>

<div class="mb-3">
    <a href="<?php echo ADMIN_ROOT; ?>/recipes" class="btn btn-secondary">Retour à la liste des recettes</a>
</div>

<div class="card bg-gray mb-3">
    <div class="card-body">
        <form action="<?php echo ADMIN_ROOT; ?>/recipes/add/insert" method="post" class="form-horizontal">

            <fieldset>
                <legend>Données de la recette</legend>

                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" />
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="description" name="description"
                            placeholder="Description" />
                    </div>
                </div>

                <div class="form-group row">
                    <label for="prep_time" class="col-sm-2 col-form-label">Preparation time</label>
                    <div class="col-sm-10">
                        <input type="time" class="form-control" id="prep_time" name="prep_time" />
                    </div>
                </div>

                <div class="form-group row">
                    <label for="portions" class="col-sm-2 col-form-label">Portions</label>
                    <div class="col-sm-10">
                        <input type="number" id="portions" name="portions" placeholder="Portions" />
                    </div>
                </div>

                <div class="form-group row">
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
                    <label for="type_id" class="col-sm-2 col-form-label">Catégories</label>
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

            </fieldset>

            <fieldset>
                <legend>Ingrédients</legend>
                <?php foreach ($allIngredients as $ingredient): ?>
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <input type="checkbox" name="ingredients[]" value="<?php echo $ingredient['ingredient_id']; ?>"
                                id="<?php echo $ingredient['ingredient_name']; ?>">
                        </div>
                        <label class="col-md-3 col-form-label"
                            for="<?php echo 'quantity_' . $ingredient['ingredient_id']; ?>">
                            <?php echo $ingredient['ingredient_name']; ?>
                        </label>
                        <div class="col-md-3">
                            <select class="form-control" name="quantity[<?php echo $ingredient['ingredient_id']; ?>]"
                                id="<?php echo 'quantity_' . $ingredient['ingredient_id']; ?>">
                                <?php for ($i = 1; $i <= 50; $i++): ?>
                                    <option value="<?php echo $i; ?>">
                                        <?php echo $i . ' ' . $ingredient['ingredient_unit']; ?>
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
    </div>
</div>