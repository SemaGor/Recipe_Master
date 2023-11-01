<div class="page-header mt-3">
    <h1>Ajout d'un utilisateur</h1>
</div>
<div class="mb-3">
    <a href="<?php echo ADMIN_ROOT; ?>/users" class="btn btn-secondary">Retour à la liste des utilisateurs</a>
</div>
<div class="card bg-gray mb-3">
    <div class="card-body">
        <form action="<?php echo ADMIN_ROOT; ?>/categories/add/insert" method="post" class="form-horizontal">
            <fieldset>
                <legend>Données de la catégorie</legend>

                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10">
                        <input type="description" class="form-control" id="description" name="description" placeholder="description" />
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" class="btn btn-lg btn-primary" />
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>