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
 include_once '../classes/shared_note.php';
 include_once '../classes/friend.php';
 include_once '../classes/note.php';

 $shared = new SharedNote();
 $note = new Note();
 $result = $note->getAllUserSharedNotesByIdUser($user->getId());

 if($result == false)
 {
    ?>
    <h1 class="text-center text-muted">Don't have shared notes<h1>
    <?php
 }
 else{
    ?>

    <br>
        <div class="d-flex justify-content-center">
            <div class="col-8">
                <ul class="list-group">
    
    <?php

        foreach($result as $note_list)
        {
            $shared_note = $shared->getSharedByIdNote($note_list['id_note']);
            ?>
            <li class="list-group-item">
                <div class="d-flex flex-row-reverse bd-highlight">
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                        <?php
                            if($shared->getSharedByIdNoteIdFrien($note_list['id_note'], $user->getId())['write_permission'] == true || $note_list['id_user'] == $user->getId())
                            {
                                ?>
                                    <a class="btn btn-primary" href="update_note.php?id=<?php echo $note_list["id"] ; ?>" role="button" name = "edit_note"><i class="fas fa-edit"></i></a>
                                <?php
                            }
                            if($note_list['id_user'] == $user->getId())
                            {
                                ?>
                                <a class="btn btn-warning" href="?settings=<?= $note_list["id"];?>" role="button"><i class="fas fa-ellipsis-v"></i></a>
                                <?php
                            }
                        ?>
                    </div>
                    <p class="text-secondary" style="margin-right:10px;"><?php echo $note_list['date'];?></p>
                    <?php
                        if($shared_note != false)
                        {
                            ?>
                                <p class="text-secondary" style="margin-right:10px;" data-toggle="tooltip" data-placement="bottom" title="
                                <?php
                                    foreach($shared_note as $shared_friend)
                                    {
                                        echo $user->getUserById($shared_friend['id_friend'])['name'];?>&#47;<?php
                                    }
                                ?>
                                "><i style="color: #005BFF;" class="fas fa-user-friends"></i></p>
                            <?php
                        }
                        if($note_list['id_user'] != $user->getId())
                        {
                            ?>
                            <p class="text-secondary" style="margin-right:10px;"><i style="color: #FFD000;" class="fas fa-crown"></i> <?=$user->getUserById($note_list['id_user'])['name']?></p>
                            <?php
                        }
                    ?>
                    <a class="text-secondary" role="button" href="note.php?id=<?= $note_list['id_note'];?>" style="margin-right:auto;"><?php echo $note_list['title'];?></a>
                </div>
            </li>
            <?php

        }
        
    ?>
        </ul>
        </div>
        </div>
        



    <?php
 }
include_once '../includes/footer.php';
?>