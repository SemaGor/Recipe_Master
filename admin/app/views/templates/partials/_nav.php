<!-- Fixed navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
        aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="users/dashboard.php">BACKOFFICE RECIPE MASTER</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="users/dashboard.php">DASHBOARD</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
            aria-expanded="false">GESTION <span class="caret"></span></a>
          <ul class="dropdown-menu">

            <li class="dropdown-header">GESTION DES UTILISATEURS</li>
            <li><a href="<?php echo ADMIN_ROOT; ?>/users">Liste des utilisateurs</a></li>
            <li><a href="<?php echo ADMIN_ROOT; ?>/users/add/form">Ajouter un utilisateur</a></li>
            <li role="separator" class="divider"></li>

            <li class="dropdown-header">GESTION DES RECETTES</li>
            <li><a href="<?php echo ADMIN_ROOT; ?>/recipes">Liste des recettes</a></li>
            <li><a href="<?php echo ADMIN_ROOT; ?>/recipes/add/form">Ajouter une recette</a></li>
            <li role="separator" class="divider"></li>

            <li class="dropdown-header">GESTION DES CATÉGORIES</li>
            <li><a href="<?php echo ADMIN_ROOT; ?>/categories">Liste des catégories</a></li>
            <li><a href="<?php echo ADMIN_ROOT; ?>/categories/add/form">Ajouter une catégorie</a></li>
            <li role="separator" class="divider"></li>

            <li class="dropdown-header">GESTION DES INGREDIENTS</li>
            <li><a href="href=<?php echo ADMIN_ROOT; ?>/ingredients">Liste des ingrédients</a></li>
            <li><a href="href=<?php echo ADMIN_ROOT; ?>/ingredients">Ajouter un ingrédient</a></li>
          </ul>
        </li>
        <li class="active"><a href="<?php echo ADMIN_ROOT; ?>/users/logout">DECONNEXION</a></li>
      </ul>

    </div>
    <!--/.nav-collapse -->

  </div>
</nav>