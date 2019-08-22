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
    $note = new Note();
    $result = $note->getAllUserNotes($user->getId());

?>
<br>
    <div class="d-flex justify-content-center">
        <div class="col-8">
            <ul class="list-group">
 
<?php
    
    if(isset($_GET['eliminar']))
    {
        $note->deleteNote($_GET['eliminar']);
        header("Location: note_list.php");
    }

    foreach($result as $note_list)
    {
        ?>
        <li class="list-group-item">
            <div class="d-flex flex-row-reverse bd-highlight">
                <div class="btn-group mr-2" role="group" aria-label="First group">
                    <a class="btn btn-primary" href="update_note.php?id=<?php echo $note_list["id"] ; ?>" role="button" name = "edit_note"><i class="fas fa-edit"></i></a>
                    <a class="btn btn-success" href="share_note_friend_list.php?id=<?= $note_list['id'];?>" role="button" name = "shared_note"><i class="fas fa-share-alt-square"></i></a>
                    <a class="btn btn-danger" href="?eliminar=<?= $note_list["id"] ; ?>" role="button"><i class="fas fa-trash-alt"></i></a>
                </div>
                <p class="text-secondary" style="margin-right:10px;"><?php echo $note_list['date'];?></p>
                <a class="text-secondary" role="button" href="note.php?id=<?= $note_list["id"] ; ?>" style="margin-right:auto;"><?php echo $note_list['title'];?></a>
            </div>
        </li>
        <?php

    }
    
?>
    </ul>
    </div>
    </div>
    
    <?php
    
    include_once '../includes/footer.php';
    ?>