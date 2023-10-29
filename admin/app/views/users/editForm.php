<div class="page-header mt-3">
    <h1><?php echo TITRE_USERS_EDITFORM ?></h1>
</div>
<div class="mb-3">
    <a href="<?php echo ADMIN_ROOT; ?>/users" class="btn btn-secondary">Retour à la liste des utilisateurs</a>
</div>
<div class="card bg-gray mb-3">
    <div class="card-body">
    <form action="<?php echo ADMIN_ROOT; ?>/users/edit"
              method="post"
              class="edit" >
            
            <fieldset>
                <legend>Données de l'utilisateur</legend>

                <div class="form-group">
                    <label for="user_name" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                    
                        <input 
                            type="text" class="form-control" 
                            id="user_name" 
                            name="user_name" 
                            value="<?php echo $user['user_name']; ?>" />
                        <input 
                            type="hidden" 
                            id="user_id" 
                            name="user_id" 
                            value="<?php echo $user['user_id']; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" class="btn btn-lg btn-primary" value="Valider" />
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
