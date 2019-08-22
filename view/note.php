<?php

include_once '../includes/header.php';
include_once '../includes/check_session.php';
include_once '../includes/user_nav_bar.php';
include_once '../classes/note.php';

$note = new Note();
$currentNote = $note->getNote($_GET['id']);

if($user->getId() != $currentNote['id_user'])exit();
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