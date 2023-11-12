<main class="w-full md:w-3/4 p-3">
    <div class=" p-3">
        <!-- Hero User Profile -->
        <section class="relative mb-6">
            <img class="w-full h-96 object-cover" src="../document/pictures/<?php echo $user['user_picture']; ?>"
                alt="<?php echo $user['user_name']; ?>" />
            <div class="absolute bottom-0 left-0 w-full p-6 bg-gradient-to-t from-gray-900 to-transparent">
                <h1 class="text-3xl font-bold mb-2 text-white">
                    <?php echo $user['user_name']; ?>
                </h1>
                <p class="text-gray-300 mb-4">
                    <?php echo $user['user_biography']; ?>
                </p>
            </div>
        </section>

        <!-- User's Recipes -->
        <section>
            <h2 class="text-2xl font-bold mb-4">Mes recettes</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Recipe Card -->
                <?php 
                include_once '../app/models/recipesModel.php';
                $recipes = App\Models\RecipesModel\findAllByUserId($connexion, $user['user_id']);
                include_once '../app/views/recipes/_indexByUser.php';
                ?>
            </div>
        </section>
    </div>
    </div>
</main>

