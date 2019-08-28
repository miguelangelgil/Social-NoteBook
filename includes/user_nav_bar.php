<?php
/*
Autor: Miguel Ángel Gil Martín (MAGMa)
Esta obra está licenciada bajo la Licencia Creative Commons Atribución-CompartirIgual 4.0 
Internacional. Para ver una copia de esta licencia, 
visite http://creativecommons.org/licenses/by-sa/4.0/.
*/
?>
<?php//barra de navegacion del usuario?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#"><?php echo  $user->getName(); ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item<?php if(strpos($_SERVER['REQUEST_URI'], 'new_note.php') != false){?> active <?php }?>">
        <a class="nav-link" href="../view/new_note.php"><i class="fas fa-plus-square"></i> <span class="sr-only">(current)</span>Add note</a>
      </li>
      <li class="nav-item<?php if(strpos($_SERVER['REQUEST_URI'], 'note_list.php') != false){?> active <?php }?>">
        <a class="nav-link" href="../view/note_list.php"><i class="fas fa-sticky-note"></i> My notes</a>
      </li>
      <li class="nav-item<?php if(strpos($_SERVER['REQUEST_URI'], 'shared_notes_list.php') != false){?> active <?php }?>">
        <a class="nav-link" href="../view/shared_notes_list.php"><i class="fas fa-share-alt-square"></i> Shared notes</a>
      </li>
      <li class="nav-item<?php if(strpos($_SERVER['REQUEST_URI'], 'friend_list.php') != false){?> active <?php }?>">
        <a class="nav-link" href="../view/friend_list.php"><i class="fas fa-users"></i> Friends</a>
      </li>
      </li>
    </ul>
  </div>
  <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="../includes/logout.php"><i class="fas fa-sign-out-alt"></i> Log out</a>
            </li>
        </ul>
    </div>
</nav>