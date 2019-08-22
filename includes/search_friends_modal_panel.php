<?php include_once '../classes/user.php' ?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Friends</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
        <form class="form-inline" action="" method="POST">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name = "name_friends">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        

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
                <ul class="list-group">
                <?php
                foreach($result as $user_add)
                {
                
                    ?>
                    <li class="list-group-item">
                        <div class="d-flex flex-row-reverse bd-highlight">
                            <div class="btn-group mr-2" role="group" aria-label="First group">
                                <a class="btn btn-primary" href="update_note.php?id=<?php echo $user_add["id"] ; ?>" role="button" name = "add_friend"><i class="fas fa-user-plus"></i></a>
                            </div>
                            <p class="text-secondary" style="margin-right:auto;"><?php echo $user_add['name'];?></p>
                        </div>
                    </li>
                    <?php
                }
                ?>
                </ul>
                <?php
            }
       
        }
        ?>
        
       
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
