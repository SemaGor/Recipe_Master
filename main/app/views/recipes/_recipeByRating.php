<?php

use Core\Tools;

?>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

  <!-- Recipe Card -->

  <?php foreach ($popularRecipes as $popularRecipe): ?>

    <article class="bg-white rounded-lg overflow-hidden shadow-lg relative">

      <img class="w-full h-48 object-cover" src="<?php echo $popularRecipe['dish_picture'] ?>" alt="Recipe Image" />

      <div class="p-4">

        <h3 class="text-xl font-bold mb-2">
          <?php echo $popularRecipe['dish_name'] ?>
        </h3>

        <div class="flex items-center mb-2">

          <span class="text-yellow-500 mr-1">
            <i class="fas fa-star">
              <?php echo $popularRecipe['avg_rating'] ?>
            </i>
          </span>

        </div>

        <p class="text-gray-600">
          <?php echo $popularRecipe['short_description'] = \Core\Tools\truncateDescription($popularRecipe['description']);?>
        </p>

        <div class="flex items-center mt-4">
          <span class="text-gray-700 mr-2">
            <?php echo $popularRecipe['user_name'] ?>
          </span>

          <span class="text-gray-500">
            <i class="fas fa-comment"></i>
            <?php echo $popularRecipe['comment_count'] ?>
          </span>

        </div>

        <a href="recipes/<?php echo $popularRecipe['id']; ?>/<?php echo Tools\slugify($popularRecipe['dish_name']); ?>"
          class="inline-block mt-4 bg-red-500 hover:bg-red-800 rounded-full px-4 py-2 text-white">

          Voir la recette

        </a>

      </div>
    </article>

  <?php endforeach; ?>

</div>