      <title><?=$title ?? "Noumene"?></title>
  </head>
<body>
<style>
  body{
    font-family: "Times New Roman";
  }
</style>    
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4 ">
  <div class="container-fluid">
    <a class="navbar-brand">Menu</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="<?=$router->generate("home")?>">acceuille</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?=$router->generate("regle")?>">Documentation</a>
        </li>
        <?php if (empty($_SESSION["auth"])):?>
          <li class="nav-item">
             <a class="nav-link" href="<?=$router->generate("login")?>">s'inscrire</a>
          </li>
          <?php else: ?>
            <li class="nav-item">
             <a class="nav-link" href="<?=$router->generate("compte",["name"=>$_SESSION["auth"]["name"]])?>"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
</svg> Mon compte</a>
          </li>
        <?php endif ?>
      </ul>
      <?php if (!empty($_SESSION["auth"])):?>
         <div class="d-flex">
            <a class="btn btn-outline-success deconect"  data-bs-toggle="modal" data-bs-target="#example">se deconnecter</a>
         </div>
       <?php else:?> 
          <div class="d-flex">
            <a class="btn btn-outline-success" href="<?=$router->generate("connexion")?>">se connecter</a>
         </div>
      <?php endif ?>
    </div>
  </div>
</nav>
<div class="modal" tabindex="-1" role="dialog" id="example">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">deconnexion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>vous etez sur de vouloir vous deconnecter?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary"   data-bs-dismiss="modal">non fermez la boite modal</button>
        <a type="button" class="btn btn-primary" href="?deconnexion">oui j'en suis sur</a>
      </div>
    </div>
  </div>
</div>