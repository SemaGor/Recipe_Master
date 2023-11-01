<?php

namespace Core\Tools;

use Core\Tools;

?>
<h1>
    <?php echo TITRE_CATEGORIES_INDEX ?>
</h1>
<a href="<?php echo ADMIN_ROOT; ?>/categories/add/form" class="btn btn-primary rounded">Ajouter une catégorie </a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>id</th>
            <th>Name</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($allCategories as $category): ?>
            <tr>
                <td>
                    <?php echo $category['category_id'] ?>
                </td>
                <td>
                    <?php echo $category['category_name'] ?>
                </td>
                <td>
                    <?php echo $category['category_description'] ?>
                </td>
                <td>
                    <button type="button" class="edit"> Modifier </button>
                    <button type="button" class="delete"> Supprimer </button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>