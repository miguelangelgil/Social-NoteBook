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

    class Note
    {
        

        public function saveNote($title, $body, $id_user)
        {
            try{
                $this->database = new Connection();
                $this->db = $this->database->openConnection();

                if($title == '' && $body == '')return false;
                // inserting data into create table using prepare statement to prevent from sql injections
                $stm = $this->db->prepare("INSERT INTO notes (title,body,id_user,date) VALUES (:title, :body, :id_user, :date)") ;
                // inserting a record
                $stm->execute(array(':title' => $title , ':body' => $body , ':id_user' => $id_user, ':date' => date('Y-m-d H:i')));
                ?>
                    <div class="alert alert-success" role="alert">
                        Note saved successfully
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

        public function editNote($id,$title,$body)
        {
            try{
                $this->database = new Connection();
                $this->db = $this->database->openConnection();
                // inserting data into create table using prepare statement to prevent from sql injections
                $sql = "UPDATE notes SET title = ?, body = ?, date = ? WHERE notes . id = ?";
                $result = $this->db->prepare($sql);
                $result->execute([$title, $body, date('Y-m-d H:i'), $id]);
                ?>
                    <div class="alert alert-success" role="alert">
                        Note saved successfully
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
        //esto trae todas las notas que has compartido y las que te han compartido
        public function getAllUserSharedNotesByIdUser($id)
        {
            try
            {
                $this->database = new Connection();
                $this->db = $this->database->openConnection();
                $query = $this->db->prepare('SELECT * FROM notes JOIN shared_notes ON notes . id = shared_notes . id_note AND notes . id_user = :id_user OR notes . id = shared_notes . id_note AND shared_notes . id_friend = :id_user  GROUP BY notes . id');
                $query->execute(['id_user' => $id]);
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

        public function getAllUserNotes($id_user)
        {
            try
            {
                $this->database = new Connection();
                $this->db = $this->database->openConnection();
                $query = $this->db->prepare('SELECT * FROM notes WHERE id_user = :user');
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

        public function deleteNote($id)
        {
            try
            {
                $this->database = new Connection();
                $this->db = $this->database->openConnection();
                $query = $this->db->prepare('DELETE FROM notes WHERE notes . id = :id_note');
                $query->bindParam('id_note', $id);
                $query->execute();
                ?>
                    <div class="alert alert-success" role="alert">
                        Note delete successfully
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

        public function getNote($id)
        {
            try
            {
                $this->database = new Connection();
                $this->db = $this->database->openConnection();
                $result = $this->db->prepare('SELECT * FROM notes WHERE notes . id = :id_note');
                $result->execute(['id_note' => $id]);
                return $result->fetch(PDO::FETCH_LAZY);
                
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