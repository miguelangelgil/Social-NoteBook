<?php
    include_once '../includes/header.php';
    include_once '../includes/check_session.php';
    include_once '../includes/user_nav_bar.php';
    include_once '../classes/friend.php';
    include_once '../classes/note.php';
    $friend = new Friend();
    $currentFriends = $friend->getFriendsByIdUser($user->getId());
    $note = new Note();
    $currentNote;
    
    if(isset($_GET['id']))
    {
        $currentNote = $note->getNote($_GET['id']);
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
                                ?>
                            
                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                    <a class="btn btn-success" href="share_note_friend_list.php?shared_view = <?= $myfriend['id_user'] ?>&id = <?= $currentNote['id']?>" role="button" name = "shared_view"><i class="fas fa-eye"></i></a>
                                    <a class="btn btn-success" href="share_note_friend_list.php?shared_edit = <?= $myfriend['id_user'] ?>&id = <?= $currentNote['id']?>" role="button" name = "shared_edit"><i class="fas fa-edit"></i></a>
                                    </div>
                                    <a class="text-secondary" role="button" href="#" style="margin-right:auto;"><?php echo $user->getUserById($myfriend['id_user'])['name'];?></a>
                                    <?php
                                    }
                                else
                                {
                                    ?>
                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                    <a class="btn btn-success" href="share_note_friend_list.php?shared_view = <?= $myfriend['id_friend']?>&id = <?= $currentNote['id']?>" role="button" name = "shared_view"><i class="fas fa-eye"></i></a>
                                    <a class="btn btn-success" href="share_note_friend_list.php?shared_edit = <?= $myfriend['id_friend']?>&id = <?= $currentNote['id']?>" role="button" name = "shared_edit"><i class="fas fa-edit"></i></a>
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