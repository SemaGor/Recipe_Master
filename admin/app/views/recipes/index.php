<h1>
  <?php echo TITRE_RECIPES_INDEX ?>
</h1>
<a href="<?php echo ADMIN_ROOT; ?>/recipes/add/form" class="add"> Ajouter une recette </a>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>id</th>
      <th>Name</th>
      <th>Preparation Time</th>
      <th>Description</th>
      <th>Chef</th>
      <th>Category</th>
      <th>Ingredients</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>

  <?php include_once "../app/models/recipesModel.php"; ?>

    <?php foreach ($allRecipes as $allRecipe): ?>
      <tr>
        <td>
          <?php echo $allRecipe['dish_id'] ?>
        </td>
        <td>
          <?php echo $allRecipe['dish_name'] ?>
        </td>
        <td>
          <?php echo $allRecipe['dish_prep_time'] ?>
        </td>
        <td>
          <?php echo $allRecipe['dish_description'] ?>
        </td>
        <td>
          <?php echo $allRecipe['user_name'] ?>
        </td>
        <td>
          <?php echo $allRecipe['category_name'] ?>
        </td>
        <td>
        <ul>
            <?php 
                $ingredients = isset($allRecipe['ingredients_names']) && $allRecipe['ingredients_names'] !== null 
                              ? explode(',', $allRecipe['ingredients_names']) 
                              : [];

                foreach ($ingredients as $ingredient):
            ?>
                <li><?php echo trim($ingredient); ?></li>
            <?php endforeach; ?>
        </ul>

        </td>

        <td>
          <a href="<?php echo ADMIN_ROOT; ?>/recipes/edit/form/<?php echo $allRecipe['dish_id'] ?>" 
             class="edit">
             Modifier
          </a>
          <a href="<?php echo ADMIN_ROOT; ?>/recipes/delete/<?php echo $allRecipe['dish_id'] ?>" 
             class="btn btn-danger">
             Supprimer
          </a>

        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>