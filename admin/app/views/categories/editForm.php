<div class="page-header mt-3">
    <h1><?php echo TITRE_CATEGORIES_EDITFORM ?></h1>
</div>
<div class="mb-3">
    <a href="<?php echo ADMIN_ROOT; ?>/categories" class="btn btn-secondary">
        Retour à la liste des catégories
    </a>
</div>
<div class="card bg-gray mb-3">
    <div class="card-body">
        <form action="<?php echo ADMIN_ROOT; ?>/categories/edit" method="post" class="edit">
            <fieldset>
                <legend>Données de la catégorie</legend>

                <div class="form-group row">
               
                    <label for="category_name" class="col-sm-2 col-form-label">Nom</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="category_name" name="category_name" value="<?php echo $category['category_name']; ?>" />
                        
                        <input type="hidden" id="category_id" name="category_id" value="<?php echo $category['category_id']; ?>" />

                    </div>
                </div>

                <div class="form-group row">
                    <label for="category_description" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="category_description" name="category_description" value="<?php echo $category['category_description']; ?>" />
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                        <button type="submit" class="btn btn-lg btn-primary">Valider</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
