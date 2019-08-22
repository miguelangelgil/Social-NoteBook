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
    $friend = new Friend();
    if(isset($_GET['friend']))
    {
        $friend->requestFriend($user->getId(), $_GET['friend']);
        header("Location: add_friend.php");
    }
    
?>

<br>
<div class="d-flex justify-content-center">
    <div class="card" style="min-width: 50rem;">
        <div class="card-body">
            <h5 class="card-title">Search Friens</h5>
            <p class="card-text">
                <form class="form-inline" action="" method="POST">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name = "name_friends">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
                <br>
            </p>
        </div>
        <?php
        if(isset($_POST['name_friends']))
        {
            $result = $user->getUsersByName($_POST['name_friends']);

            if($result->rowCount() < 1)
            {
                ?>
                    <h1 class="text-center text-muted">Results not found<h1>
                <?php
            }
            else
            {
                ?>
                <ul class="list-group list-group-flush">
                    <?php
                    foreach($result as $user_add)
                    {
                        if($user_add['id'] != $user->getId())
                        {
                            if($friend->areFriends($user->getId(), $user_add['id'])==false)
                            {
                                ?>
                                <li class="list-group-item">
                                    <div class="d-flex flex-row-reverse bd-highlight">
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            <?php
                                            if($friend->requestSent($user->getId(), $user_add['id']))
                                            {
                                                ?>
                                                <p class="btn btn-secondary" ><i class="fas fa-user-plus"></i></p>
                                                <?php
                                            }
                                            else{
                                            ?>
                                                <a class="btn btn-primary" href="add_friend.php?friend=<?php echo $user_add["id"] ; ?>" role="button"><i class="fas fa-user-plus"></i></a>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <p class="text-secondary" style="margin-right:10px;"><?php echo $user_add['mail'];?></p>
                                        <p class="text-secondary" style="margin-right:auto;"><?php echo $user_add['name'];?></p>
                                    </div>
                                </li>
                            <?php
                            }
                        }
                    }
                    ?>
                </ul>
            <?php
            }

        }
        ?>
    </div>
</div>

<?php
    include_once '../includes/footer.php';
?>