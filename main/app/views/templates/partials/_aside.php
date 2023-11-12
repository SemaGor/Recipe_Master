<aside class="w-full md:w-1/4 p-3">
    <div class="bg-yellow-500 text-white rounded-lg shadow-md p-4 mb-4">
        <h2 class="font-bold text-lg mb-4">Catégories</h2>
        <?php include_once '../app/models/categoriesModel.php';
        $categories = \App\Models\CategoriesModel\findAllCategories($connexion);
        include '../app/views/categories/_index.php';
        ?>

    </div>
    <div class="bg-yellow-600 text-white rounded-lg shadow-md p-4">
        <h2 class="font-bold text-lg mb-4">Ingrédients</h2>
        <?php include_once '../app/models/ingredientsModel.php';
        $ingredients = \App\Models\IngredientsModel\findAllIngredients($connexion);
        include '../app/views/ingredients/_index.php';
        ?>
    </div>
</aside>