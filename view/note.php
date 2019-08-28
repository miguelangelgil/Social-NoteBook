<?php
/*
Autor: Miguel Ángel Gil Martín (MAGMa)
Esta obra está licenciada bajo la Licencia Creative Commons Atribución-CompartirIgual 4.0 
Internacional. Para ver una copia de esta licencia, 
visite http://creativecommons.org/licenses/by-sa/4.0/.
*/
?>
<?php

include_once '../includes/header.php';
include_once '../includes/check_session.php';
include_once '../includes/user_nav_bar.php';
include_once '../classes/note.php';
include_once '../includes/check_permissions.php';

$note = new Note();
$currentNote = $note->getNote($_GET['id']);
?>
<br>
<div class="d-flex justify-content-center">
  <div class="col-8">
    <div class="card">
    <div class="card-header">
        <a class="text-secondary" role="button" href="update_note.php?id=<?php echo $currentNote["id"] ; ?>"><?php echo $currentNote['title']?></a>
    </div>
    <div class="card-body">
        <blockquote class="blockquote mb-0">
        <a class="text-secondary" role="button" href="update_note.php?id=<?php echo $currentNote["id"] ; ?>"><p class="text-break"><?php echo $currentNote['body'] ?></p></a>
        <footer class="blockquote-footer">Writed by <cite title="Source Title"><?php echo $user->getName() ?></cite></footer>
        </blockquote>
    </div>
    </div>
  </div>
</div>
<?php
    include_once '../includes/footer.php';
?>