<?php
/*
Autor: Miguel Ángel Gil Martín (MAGMa)
Esta obra está licenciada bajo la Licencia Creative Commons Atribución-CompartirIgual 4.0 
Internacional. Para ver una copia de esta licencia, 
visite http://creativecommons.org/licenses/by-sa/4.0/.
*/
?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Permissions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
        <?php
        $shared_friends = $shared->getSharedByIdNote($_GET['settings']);

        foreach($currentFriends as $shared_friends)
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
        
        ?>
        
       
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
