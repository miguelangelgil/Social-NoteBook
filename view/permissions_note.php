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
     include_once '../classes/note.php';
    $shared = new SharedNote();

    $note = new Note();
    
    if(isset($_GET['settings']))
    {
        $friends_shared = $shared->getSharedByIdNote($_GET['settings']);
    }
    if(!isset($_GET['shared']))$_GET['shared']=false;
    if(isset($_GET['lead']))
    {
        if($_GET['shared'] != false)
        {
            $note->changeOwner($_GET['settings'], $_GET['lead']);
            $shared->switchOwnerToFriend($user->getId(),$_GET['lead'],$_GET['settings']);
        }
    }
    if(isset($_GET['shared_view']))
    {
        if($_GET['shared'] != false)
        {
            $note_shared = $shared->getSharedById($_GET['shared']);
            if($note_shared['write_permission']==false)
            {
                $shared->editPermissions($_GET['shared'], false, false);

            }else
            {
                $shared->editPermissions($_GET['shared'], true, false);
            }

            
            
        }else
        {
            $shared->share($_GET['settings'], $_GET['shared_view'],true, false);
        }
        
    }
    if(isset($_GET['shared_edit']))
    {
        if($_GET['shared'] != false)
        {
            $note_shared = $shared->getSharedById($_GET['shared']);
            $shared->editPermissions($_GET['shared'], $note_shared['read_permission'], !$note_shared['write_permission']);

        }else
        {
            $shared->share($_GET['settings'], $_GET['shared_edit'],true, true);
        }

    }
    
    ?>
<br>
<div class="d-flex justify-content-center">
    <div class="col-8">
        <ul class="list-group">
            <?php
            if($note->getNote($_GET['settings'])['id_user']!=$user->getId())
            {
             ?>
             <h1 class="text-center text-muted">Don't have permissions<h1>
            <?php
            }
            else
            {
                foreach($friends_shared as $friend_permissions)
                {
                    ?>
                    <li class="list-group-item">
                        <div class="d-flex flex-row-reverse bd-highlight">
                        <?php
                            if($friend_permissions['id_friend'] == $user->getId())
                            {
                                //TODO 
                                $note_shared = $shared->getSharedByIdNoteIdFrien($_GET['settings'], $user->getId());
                                ?>
                                <div class="btn-group mr-2" role="group" aria-label="First group">
                                <a class="<?= $note_shared['read_permission'] ? "btn btn-danger": "btn btn-success"?>" href="?settings=<?= $friend_permissions['id_note']?>&shared_view=<?= $friend_permissions['id_friend'] ?>&shared=<?=$note_shared==false?false:$note_shared['id']?>" role="button" name = "shared_view"><i class="fas fa-eye"></i></a>
                                <a class="<?= $note_shared['write_permission'] ? "btn btn-danger": "btn btn-success"?>" href="?settings=<?= $friend_permissions['id_note']?>&shared_edit=<?= $friend_permissions['id_friend'] ?>&shared=<?=$note_shared==false?false:$note_shared['id']?>" role="button" name = "shared_edit"><i class="fas fa-edit"></i></a>
                                <a class="btn btn-primary" href="?settings=<?= $friend_permissions['id_note']?>&lead=<?=$friend_permissions['id_friend']?>&shared=<?=$friend_permissions==false?false:$note_shared['id']?>" role="button" name = "lead"><i class="fas fa-crown"></i></a>
                                </div>
                                <a class="text-secondary" role="button" href="#" style="margin-right:auto;"><?php echo $user->getName();?></a>
                                <?php
                                }
                            else
                            {
                            
                                $note_shared = $shared->getSharedByIdNoteIdFrien($_GET['settings'], $friend_permissions['id_friend']);
                                ?>
                                <div class="btn-group mr-2" role="group" aria-label="First group">
                                <a class="<?= $note_shared['read_permission'] ? "btn btn-danger": "btn btn-success"?>" href="?settings=<?= $friend_permissions['id_note']?>&shared_view=<?= $friend_permissions['id_friend']?>&shared=<?=$note_shared==false?false:$note_shared['id']?>" role="button" name = "shared_view"><i class="fas fa-eye"></i></a>
                                <a class="<?= $note_shared['write_permission'] ? "btn btn-danger": "btn btn-success"?>" href="?settings=<?= $friend_permissions['id_note']?>&shared_edit=<?= $friend_permissions['id_friend']?>&shared=<?=$note_shared==false?false:$note_shared['id']?>" role="button" name = "shared_edit"><i class="fas fa-edit"></i></a>
                                <a class="btn btn-primary" href="?settings=<?= $friend_permissions['id_note']?>&lead=<?=$friend_permissions['id_friend']?>&shared=<?=$friend_permissions==false?false:$note_shared['id']?>" role="button" name = "lead"><i class="fas fa-crown"></i></a>
                                </div>
                                <a class="text-secondary" role="button" href="#" style="margin-right:auto;"><?php echo $user->getUserById($friend_permissions['id_friend'])['name'];?></a>
                            <?php
                            }
                            ?>
                                
                        </div>
                    </li>
                    <?php
                }
            }
            ?>


        </ul>
    </div>
</div>
<?php
    include_once '../includes/footer.php';
?>