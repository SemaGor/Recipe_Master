<div class="pb-4">
    <?php 
    if (isset($ingredients) && $ingredients) {
        foreach ($ingredients as $ingredient) {
            echo "<li>" . htmlspecialchars($ingredient['ingredient']) . "</li>";
        }
    } else {
        echo "Aucun ingrédient mentionné.";
    }
    ?>
</div>
