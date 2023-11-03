<div class="page-header mt-3">
    <h1><?php echo TITRE_USERS_EDITFORM ?></h1>
</div>
<div class="mb-3">
    <a href="<?php echo ADMIN_ROOT; ?>/users" class="btn btn-secondary">
        Retour à la liste des utilisateurs
    </a>
</div>
<div class="card bg-gray mb-3">
    <div class="card-body">
        <form action="<?php echo ADMIN_ROOT; ?>/users/edit" method="post" class="edit">
            <fieldset>
                <legend>Données de l'utilisateur</legend>

                <div class="form-group row">
                    <label for="user_name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="user_name" name="user_name" value="<?php echo $user['user_name']; ?>" />
                        <input type="hidden" id="user_id" name="user_id" value="<?php echo $user['user_id']; ?>" />
                    </div>
                </div>

                <div class="form-group row">
                    <label for="user_email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="user_email" name="user_email" value="<?php echo $user['user_email']; ?>" />
                    </div>
                </div>

                <div class="form-group row">
                    <label for="user_password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="user_password" name="user_password" value="<?php echo $user['user_password']; ?>" />
                    </div>
                </div>

                <div class="form-group row">
                    <label for="bio" class="col-sm-2 col-form-label">Biography</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="user_biography" name="user_biography" value="<?php echo $user['user_biography']; ?>" />
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
