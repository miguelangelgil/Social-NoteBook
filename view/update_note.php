<?php
  include_once '../includes/header.php';
  include_once '../includes/check_session.php';
  include_once '../includes/user_nav_bar.php';
  include_once '../classes/note.php';
  $note = new Note();
  $currentNote;
     
$currentNote = $note->getNote($_GET['id']);
if($user->getId() != $currentNote['id_user'])exit();
//formulario para crear una nota  
?>
<br>
<div class="d-flex justify-content-center">
  <div class="col-8">
    <form action="" method="POST">
      <div class="form-group">
        <label for="exampleFormControlInput1"></label>
        <input type="text" class="form-control" value="<?php if(isset($currentNote['title'])) echo $currentNote['title']; ?>" placeholder="Title" name = "title">
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1"></label>
        <textarea class="form-control" rows="8" placeholder="Write..." name = "body"><?php if(isset($currentNote['body'])) echo $currentNote['body']; ?> </textarea>
      </div>
      <div class="d-flex flex-row-reverse bd-highlight">
        <button type="submit" class="btn btn-primary" role="button">Save</button>
      </div>
      
    </form>
  </div>
  
</div>

<?php
  //control de registro de notas
 
if (!isset($_POST['title']))$_POST['title'] = '';
if (!isset($_POST['body']))$_POST['body'] ='';
if (!isset($_GET['saved']))$_GET['saved'] = false;

if (!isset($currentNote['title']))$currentNote['title']='';
if (!isset($currentNote['body']))$currentNote['body']='';

if (isset($_POST['body']) && isset($_POST['title']) && ($_POST['title'] != $currentNote['title'] || $_POST['body'] != $currentNote['body']) &&($_POST['title'] != '' || $_POST['body'] != '' ))
{
    if($note->editNote($currentNote['id'],$_POST['title'], $_POST['body']))
      header("Location: update_note.php?id=". $currentNote['id']);

}

  include_once '../includes/footer.php';
?>