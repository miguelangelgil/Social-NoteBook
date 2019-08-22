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
  
//formulario para crear una nota  
?>
<br>
<div class="d-flex justify-content-center">
  <div class="col-8">
    <form action="?" method="POST">
      <div class="form-group">
        <label for="exampleFormControlInput1"></label>
        <input type="text" class="form-control" placeholder="Title" name = "title">
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1"></label>
        <textarea class="form-control" rows="8" placeholder="Write..." name = "body"></textarea>
      </div>
      <div class="d-flex flex-row-reverse bd-highlight">
        <button type="submit" class="btn btn-primary" role="button">Save</button>
      </div>
      
    </form>
  </div>
  
</div>

<?php
  //control de registro de notas
  include_once '../classes/note.php';
  $note = new Note();
  $currentNote;

if (!isset($_POST['title']))$_POST['title'] = '';
if (!isset($_POST['body']))$_POST['body'] ='';

if (isset($_POST['body']) && isset($_POST['title']))
{
  $note->saveNote($_POST['title'], $_POST['body'], $user->getId());
}

  include_once '../includes/footer.php';
?>