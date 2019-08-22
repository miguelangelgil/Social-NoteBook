<?php
    include_once '../includes/header.php';
    include_once '../includes/check_session.php';
    include_once '../includes/user_nav_bar.php';
    include_once '../classes/friend.php';
    include_once '../includes/friends_nav_bar.php';
    $friend = new Friend();

    $result = $friend->searchRequestsSentByUserById($user->getId());

    if(isset($_GET['delete']))
    {
        $friend->removeRequestOrFriend($_GET['delete']);
        header("Location: your_requests_list.php");
    }
?>
   
<br>
<div class="d-flex justify-content-center">
    <div class="card" style="min-width: 50rem;">
        <div class="card-body">
            <h5 class="card-title">Your requests</h5>
        </div>
        <?php
       
        if($result->rowCount() < 1)
        {
            ?>
                <h1 class="text-center text-muted">You haven't sent requests<h1>
            <?php
        }
        else
        {
            ?>
            <ul class="list-group list-group-flush">
                <?php
                foreach($result as $request)
                {
                    ?>
                    <li class="list-group-item">
                            <div class="d-flex flex-row-reverse bd-highlight">
                                <div class="btn-group mr-2" role="group" aria-label="First group">
                                    <a class="btn btn-outline-danger" href="your_requests_list.php?delete=<?php echo $request["id"] ; ?>" role="button"><i class="fas fa-times"></i></a>
                                </div>
                                <p class="text-secondary" style="margin-right:auto;"><?php echo $user->getUserById($request['id_friend'])['name'];?></p>
                            </div>
                        </li>

                    <?php
                }
            ?>
            </ul>
            <?php
        }
        ?>
    </div>
</div>
<?php
    include_once '../includes/button_add_friends.php';
    include_once '../includes/footer.php';
?>