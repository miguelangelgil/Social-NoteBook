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
    include_once '../classes/friend.php';
    include_once '../includes/friends_nav_bar.php';
    include_once '../classes/shared_note.php';
    $friend = new Friend();

    $result = $friend->getFriendsByIdUser($user->getId());

    if(isset($_GET['eliminar']))
    {
        $friend->removeRequestOrFriend(($_GET['eliminar']));
        header("Location: friend_list.php");
    }

?>
    <br>
    <div class="d-flex justify-content-center">
        <div class="col-8">
            <ul class="list-group">

            <?php
                if($result->rowCount() < 1)
                {
                    ?>
                        <h1 class="text-center text-muted">Don't Found Friends<h1>
                    <?php
                   
                }
                else
                {
                    foreach($result as $myfriend)
                    {
                        ?>
                        <li class="list-group-item">
                            <div class="d-flex flex-row-reverse bd-highlight">
                                <div class="btn-group mr-2" role="group" aria-label="First group">
                                    <a class="btn btn-primary" href="#" role="button" name = "edit_note"><i class="fas fa-sticky-note"></i>  <span class="badge badge-light">0</span></a>
                                    <a class="btn btn-danger" href="?eliminar=<?= $myfriend["id"];?>" role="button"><i class="fas fa-times"></i></a>
                                </div>
                                <?php
                                if($myfriend['id_friend'] == $user->getId())
                                {
                                    ?>
                                    <a class="text-secondary" role="button" href="#" style="margin-right:auto;"><?php echo $user->getUserById($myfriend['id_user'])['name'];?></a>
                                    <?php
                                }
                                else
                                {
                                    ?>
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
        include_once '../includes/button_add_friends.php';
        include_once '../includes/footer.php';
    ?>
