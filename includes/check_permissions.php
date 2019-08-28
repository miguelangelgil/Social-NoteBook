<?php
/*
Autor: Miguel Ángel Gil Martín (MAGMa)
Esta obra está licenciada bajo la Licencia Creative Commons Atribución-CompartirIgual 4.0 
Internacional. Para ver una copia de esta licencia, 
visite http://creativecommons.org/licenses/by-sa/4.0/.
*/
?>
<?php
    include_once '../classes/note.php';
    include_once '../classes/shared_note.php';
    $note = new Note();
    $shared = new SharedNote();
    $current_note = $note->getNote($_GET['id']);
    $current_shared = $shared->getSharedByIdNoteIdFrien($_GET['id'],$user->getId());
    if($current_note['id_user'] != $user->getId() && $current_shared == false)
    {
        ?>
        <br>
        <div class="d-flex justify-content-center">
            <div class="col-8">
                <h1 class="text-center text-muted">You don't have permission<h1>
            </div>
        </div>
        <?php
        exit();
    }
    else
    {
        if($current_note['id_user'] != $user->getId() && $current_shared['write_permission'] == false && strpos($_SERVER['REQUEST_URI'], 'update_note.php') != false)
        {
            ?>
            <br>
            <div class="d-flex justify-content-center">
                <div class="col-8">
                    <h1 class="text-center text-muted">You don't have permission<h1>
                </div>
            </div>
            <?php
            exit();

        }
    }
?>