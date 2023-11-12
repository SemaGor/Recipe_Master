<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <?php foreach ($allUsers as $user): ?>
        <article class="bg-white rounded-lg overflow-hidden shadow-lg relative">
            <img class="w-full h-48 object-cover"src="../document/pictures/<?php echo $user['user_picture']; ?>"
                alt="<?php echo $user
        ['user_name']; ?> " />
            <div class="p-4">
                <h3 class="text-xl font-bold mb-2">
                    <?php echo $user['user_name']; ?>

                </h3>
                <div class="flex items-center mb-2">
                    <span class="text-yellow-500 mr-1"><i class="fas fa-star"></i></span>
                    <span>
                        <?php echo $user['avg_rating']; ?>
                    </span>
                </div>
                <p class="text-gray-500">
                    <?php echo $user['biography']; ?>
                </p>
                <a href="users/<?php echo $user['user_id']; ?>/<?php echo Core\Tools\slugify($user['user_name']); ?>"
                    class="inline-block mt-4 bg-red-500 hover:bg-red-800 rounded-full px-4 py-2 text-white">
                    More details
                </a>
            </div>
        </article>
    <?php endforeach; ?>
</div>