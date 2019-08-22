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
                $stm = $this->db->prepare("INSERT INTO shared_notes (id_nota, id_friend, read_permission, write_permission) VALUES (:id_nota, :id_friend, :read_permission, :write_permission)") ;
                // inserting a record
                $stm->execute(array(':id_nota' => $id_note , ':id_friend' => $id_friend , ':read_permission' => $read_permission, 'write_permission' => $write_permission ));
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
            try{
                $this->database = new Connection();
                $this->db = $this->database->openConnection();
                // inserting data into create table using prepare statement to prevent from sql injections
                $sql = "UPDATE shared_notes SET $read_permission = ?, $write_permission = ? WHERE shared_note . id = ?";
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

        public function getSharedByIdNote($id_note)
        {
            try
            {
                $this->database = new Connection();
                $this->db = $this->database->openConnection();
                $query = $this->db->prepare('SELECT * FROM shared_notes WHERE id_note = :note');
                $query->execute(['note' => $id_note]);
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