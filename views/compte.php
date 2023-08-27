<?php 
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
use App\Redirect;
global $router;
if(isset($_GET['deconnexion'])){
unset($_SESSION["auth"]);
$redirect=new Redirect("" . $router->generate("home"));
$redirect->go();
}
?>
<h1>mon compte<h1>
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