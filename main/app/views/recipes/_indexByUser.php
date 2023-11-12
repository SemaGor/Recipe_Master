
<!-- Recipe Card -->
<?php foreach ($recipes as $recipe): ?>
<article class="bg-white rounded-lg overflow-hidden shadow-lg relative">
   
        <img src="<?php echo $recipe['picture']; ?>" alt="<?php echo $recipe['name']; ?>" class="w-full h-48 object-cover" />
        <div class="p-4">
            <h3 class="text-xl font-bold mb-2">
                <?php echo $recipe['name']; ?>
            </h3>
            <div class="flex items-center mb-2">
                <span class="text-yellow-500 mr-1"><i class="fas fa-star"></i></span>
                <span>
                    <?php echo $recipe['avg_rating']; ?>
                </span>
            </div>
            <p class="text-gray-600">
                <?php echo substr($recipe['name'], 0, 150); ?>
            </p>
            <a href="recipes/<?php echo $recipe['id']; ?>/<?php echo Core\Tools\slugify($recipe['name']); ?>"
                class="inline-block mt-4 bg-red-500 hover:bg-red-800 rounded-full px-4 py-2 text-white">Voir
                la recette</a>
        </div>
    
</article>
<?php endforeach; ?>