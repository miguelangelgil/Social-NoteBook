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
    $friend = new Friend();
    $currentFriends = $friend->getFriendsByIdUser($user->getId());
    $note = new Note();
    $currentNote;
    
    if(isset($_GET['id']))
    {
        $currentNote = $note->getNote($_GET['id']);
    }
    if(!isset($_GET['shared']))$_GET['shared']=false;
    if(isset($_GET['shared_view']))
    {
        if($_GET['shared'] != false)
        {
            $note_shared = $shared->getSharedById($_GET['shared']);
            $shared->editPermissions($_GET['shared'], !$note_shared['read_permission'], $note_shared['write_permission']);

        }else
        {
            $shared->share($_GET['id'], $_GET['shared_view'],true, false);
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
            $shared->share($_GET['id'], $_GET['shared_edit'],false, true);
        }

    }
    
?>

<br>
    <div class="d-flex justify-content-center">
        <div class="col-8">
            <ul class="list-group">

            <?php
                if($currentFriends->rowCount() < 1)
                {
                    ?>
                        <h1 class="text-center text-muted">Don't Found Friends<h1>
                    <?php
                   
                }
                else
                {
                    foreach($currentFriends as $myfriend)
                    {      
                        ?>
                        <li class="list-group-item">
                            <div class="d-flex flex-row-reverse bd-highlight">
                        <?php
                                if($myfriend['id_friend'] == $user->getId())
                                {
                                    $note_shared = $shared->getSharedByIdNoteIdFrien($_GET['id'], $myfriend['id_user']);
                                ?>
                            
                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                    <a class="<?= $note_shared['read_permission'] ? "btn btn-danger": "btn btn-success"?>" href="?id=<?= $currentNote['id']?>&shared_view=<?= $myfriend['id_user'] ?>&shared=<?=$note_shared==false?false:$note_shared['id']?>" role="button" name = "shared_view"><i class="fas fa-eye"></i></a>
                                    <a class="<?= $note_shared['write_permission'] ? "btn btn-danger": "btn btn-success"?>" href="?id=<?= $currentNote['id']?>&shared_edit=<?= $myfriend['id_user'] ?>&shared=<?=$note_shared==false?false:$note_shared['id']?>" role="button" name = "shared_edit"><i class="fas fa-edit"></i></a>
                                    </div>
                                    <a class="text-secondary" role="button" href="#" style="margin-right:auto;"><?php echo $user->getUserById($myfriend['id_user'])['name'];?></a>
                                    <?php
                                    }
                                else
                                {
                                    $note_shared = $shared->getSharedByIdNoteIdFrien($_GET['id'], $myfriend['id_friend']);
                                    ?>
                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                    <a class="<?= $note_shared['read_permission'] ? "btn btn-danger": "btn btn-success"?>" href="?id=<?= $currentNote['id']?>&shared_view=<?= $myfriend['id_friend']?>&shared=<?=$note_shared==false?false:$note_shared['id']?>" role="button" name = "shared_view"><i class="fas fa-eye"></i></a>
                                    <a class="<?= $note_shared['write_permission'] ? "btn btn-danger": "btn btn-success"?>" href="?id=<?= $currentNote['id']?>&shared_edit=<?= $myfriend['id_friend']?>&shared=<?=$note_shared==false?false:$note_shared['id']?>" role="button" name = "shared_edit"><i class="fas fa-edit"></i></a>
                                    </div>
                                    <a class="text-secondary" role="button" href="#" style="margin-right:auto;"><?php echo $user->getUserById($myfriend['id_friend'])['name'];?></a>
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