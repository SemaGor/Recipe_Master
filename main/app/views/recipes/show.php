<main class="w-full md:w-3/4 p-3">
  <!-- Recipe Detail -->
  <section class="bg-white rounded-lg shadow-lg p-6 mb-6">

    <!-- Recipe Image -->
    <img class="w-full h-96 object-cover rounded-t-lg" src="<?php echo $recipe['dish_picture']; ?>"
      alt="<?php echo $recipe['dish_name']; ?>" />
    <!-- Recipe Info -->
    <div class="p-4">
      <h1 class="text-3xl font-bold mb-4">
        <?php echo $recipe['dish_name']; ?>
      </h1>
      <div class="flex items-center mb-4">
        <span class="text-yellow-500 mr-1">
          <i class="fas fa-star"></i>
          <?php echo $recipe['avg_rating']; ?>
        </span>
        <span class="ml-4 text-gray-700">
          <i class="fas fa-clock"></i>
          <?php echo $recipe['prep_time']; ?>
        </span>
      </div>
      <p class="text-gray-700 mb-4">
        <?php echo $recipe['dish_description']; ?>
      </p>
      <div class="flex items-center mb-4">
        <span class="text-gray-700 mr-2">Par
          <?php echo $recipe['user_name']; ?>
        </span>
        <span class="text-gray-500">
          <i class="fas fa-comment"></i>
          
          <?php echo $recipe['comment_count']; ?> commentaires
        </span>
      </div>
    </div>

    <!-- Ingredients -->
    <div class="p-4 border-t">
      <h2 class="text-2xl font-bold mb-4">Ingrédients</h2>
      <ul class="list-disc pl-5">
        <?php
        include_once '../app/models/ingredientsModel.php';
        $ingredients = \App\Models\IngredientsModel\findAllIngredientsByDishId($connexion, $id);
        include_once '../app/views/ingredients/_indexByDish.php';
        ?>
      </ul>
    </div>

    <!-- Steps -->
    <div class="p-4 border-t">
      <h2 class="text-2xl font-bold mb-4">Étapes</h2>
      <ol class="list-decimal pl-5">
        <?php
        $stepsArray = explode('.', $recipe['dish_description']);

        foreach ($stepsArray as $step) {
          echo "<li>" . trim($step) . ".</li>";
        }
        ?>
      </ol>
    </div>

    <!-- Comments -->
    <div class="p-4 border-t">
      <h2 class="text-2xl font-bold mb-4">Commentaires</h2>

      <?php

      if (empty($comments)): ?>
        <p>Cette recette n'a pas encore été commentée.</p>
      <?php else:
        foreach ($comments as $comment): ?>
          <div class="mb-4">
            <div class="flex items-center mb-2">
              <img src="../document/pictures/<?php echo $comment['user_picture']; ?>"
                alt="<?php echo $comment['user_name']; ?>" class="w-10 h-10 rounded-full mr-2" />
              <span class="font-bold">
                <?php echo $comment['user_name']; ?>
              </span>
            </div>
            <p class="text-gray-700">
              <?php echo $comment['content']; ?>
            </p>
          </div>
        <?php endforeach;
      endif; ?>
    </div>
  </section>
</main>
</div>