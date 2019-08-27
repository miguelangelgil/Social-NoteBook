<?php
/*
Autor: Miguel Ángel Gil Martín (MAGMa)
Esta obra está licenciada bajo la Licencia Creative Commons Atribución-CompartirIgual 4.0 
Internacional. Para ver una copia de esta licencia, 
visite http://creativecommons.org/licenses/by-sa/4.0/.
*/
?>
<?php
    include_once 'connection.php';

    class SharedNote
    {
        public function share($id_note, $id_friend,$read_permission, $write_permission)
        {
            try{
                $this->database = new Connection();
                $this->db = $this->database->openConnection();
                // inserting data into create table using prepare statement to prevent from sql injections
                $stm = $this->db->prepare("INSERT INTO shared_notes (id_note, id_friend, read_permission, write_permission) VALUES (:id_note, :id_friend, :read_permission, :write_permission)") ;
                // inserting a record
                $stm->execute(array(':id_note' => $id_note , ':id_friend' => $id_friend , ':read_permission' => $read_permission, 'write_permission' => $write_permission ));
                ?>
                    <div class="alert alert-success" role="alert">
                        Shared successfully
                    </div>
                <?php
                return true;
            }
            catch (PDOException $e)
            {
                ?>
                    <div class="alert alert-danger" role="alert">
                        There is some problem in connection: <?=$e->getMessage();?>
                    </div>
                <?php
                return false;
            }

        }
        public function editPermissions($id, $read_permission, $write_permission)
        {
            if(!$read_permission && !$write_permission)
            {
                $this->revokePermissions($id);
                exit();
            }
            try{
                $this->database = new Connection();
                $this->db = $this->database->openConnection();
                // inserting data into create table using prepare statement to prevent from sql injections
                $sql = "UPDATE shared_notes SET read_permission = ?, write_permission = ? WHERE shared_notes . id = ?";
                $result = $this->db->prepare($sql);
                $result->execute([$read_permission, $write_permission, $id]);
                ?>
                    <div class="alert alert-success" role="alert">
                        Shared successfully
                    </div>
                <?php
                return true;
            }
            catch (PDOException $e)
            {
                ?>
                    <div class="alert alert-danger" role="alert">
                        There is some problem in connection: <?=$e->getMessage();?>
                    </div>
                <?php
                return false;
            }

        }
        public function getSharedById($id)
        {
            try
            {
                $this->database = new Connection();
                $this->db = $this->database->openConnection();
                $query = $this->db->prepare('SELECT * FROM shared_notes WHERE shared_notes . id = :id');
                $query->execute(['id' => $id]);
                if ($query->rowCount () > 0)
                {
                    return $query->fetch(PDO::FETCH_LAZY);;
                }
                return false;
            }
            catch (PDOException $e)
            {
                ?>
                    <div class="alert alert-danger" role="alert">
                        There is some problem in connection: <?=$e->getMessage();?>
                    </div>
                <?php
            }

        }
        public function getSharedByIdNote($id_note)
        {
            try
            {
                $this->database = new Connection();
                $this->db = $this->database->openConnection();
                $query = $this->db->prepare('SELECT * FROM shared_notes WHERE id_note = :note');
                $query->execute(['note' => $id_note]);
                if ($query->rowCount () > 0)
                {
                    return $query;
                }
                return false;
            }
            catch (PDOException $e)
            {
                ?>
                    <div class="alert alert-danger" role="alert">
                        There is some problem in connection: <?=$e->getMessage();?>
                    </div>
                <?php
            }

        }

        public function getSharedByIdNoteIdFrien($id_note, $id_friend)
        {
            try
            {
                $this->database = new Connection();
                $this->db = $this->database->openConnection();
                $query = $this->db->prepare('SELECT * FROM shared_notes WHERE id_note = :note AND id_friend = :friend');
                $query->execute(['note' => $id_note, 'friend' => $id_friend]);
                if ($query->rowCount () > 0)
                {
                    return $query->fetch(PDO::FETCH_LAZY);
                }
                return false;
            }
            catch (PDOException $e)
            {
                ?>
                    <div class="alert alert-danger" role="alert">
                        There is some problem in connection: <?=$e->getMessage();?>
                    </div>
                <?php
            }

        }

        public function getSharedByIdUser($id_user)
        {
            try
            {
                $this->database = new Connection();
                $this->db = $this->database->openConnection();
                $query = $this->db->prepare('SELECT * FROM shared_notes WHERE id_friend = :user');
                $query->execute(['user' => $id_user]);
                return $query;
            }
            catch (PDOException $e)
            {
                ?>
                    <div class="alert alert-danger" role="alert">
                        There is some problem in connection: <?=$e->getMessage();?>
                    </div>
                <?php
            }

        }

        public function revokePermissions($id)
        {
            try
            {
                $this->database = new Connection();
                $this->db = $this->database->openConnection();
                $query = $this->db->prepare('DELETE FROM shared_notes WHERE shared_notes . id = :id');
                $query->bindParam('id', $id);
                $query->execute();
                ?>
                    <div class="alert alert-success" role="alert">
                        Revoke permissions
                    </div>
                <?php
            }
            catch (PDOException $e)
            {
                ?>
                    <div class="alert alert-danger" role="alert">
                        There is some problem in connection: <?=$e->getMessage();?>
                    </div>
                <?php
            }
        }
    }
?>