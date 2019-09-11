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

    class User 
    {
        private $name;
        private $id;
        private $database;
        private $db;


        public function userExists($user, $mail){

            try
            {
                $this->database = new Connection();
                $this->db = $this->database->openConnection();
                $sql = "SELECT * FROM users WHERE name = '$user' " ;
                $result = $this->db->query($sql);
                if ($result->rowCount () > 0)
                {
                    return true;
                }
            }
            catch (PDOException $e)
            {
                ?>
                    <div class="alert alert-danger" role="alert">
                        There is some problem in connection: <?=$e->getMessage();?>
                    </div>
                <?php
            }

            try
            {
                $this->database = new Connection();
                $this->db = $this->database->openConnection();
                $sql = "SELECT * FROM users WHERE mail = '$mail' " ;
                $result = $this->db->query($sql);
                if ($result->rowCount () > 0)
                {
                    return true;
                }
                else{return false;}
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

        public function logIn($user ,$pass)
        {
            try
            {
                $this->database = new Connection();
                $this->db = $this->database->openConnection();
                $sql = "SELECT * FROM users WHERE name = '$user' && password = '$pass'" ;
                $result = $this->db->query($sql);
                if ($result->rowCount () > 0)
                {
                    return true;
                }
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

        public function setUser($user){
            try{
                $this->database = new Connection();
                $this->db = $this->database->openConnection();
                // inserting data into create table using prepare statement to prevent from sql injections
                $query = $this->db->prepare('SELECT * FROM users WHERE name = :user');
                $query->execute(['user' => $user]);
            
            foreach ($query as $currentUser) {
                $this->name = $currentUser['name'];
                $this->id = $currentUser['id'];
            }
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
        ///registramos al usuario
        public function signIn($user , $pass, $gmail){

            try{
                $this->database = new Connection();
                $this->db = $this->database->openConnection();
                // inserting data into create table using prepare statement to prevent from sql injections
                $stm = $this->db->prepare("INSERT INTO users (name,mail,password) VALUES (:name, :mail, :password)") ;
                // inserting a record
                $stm->execute(array(':name' => $user , ':mail' => $gmail , ':password' => $pass));
                ?>
                    <div class="alert alert-success" role="alert">
                        New user created successfully
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
        //pensado para conseguir el nombre de los amigos 
        public function getUserById($id)
        {
            try{
                $this->database = new Connection();
                $this->db = $this->database->openConnection();
                // inserting data into create table using prepare statement to prevent from sql injections
                $query = $this->db->prepare('SELECT name FROM users WHERE id = :id');
                $query->execute(['id' => $id]);
                return $query->fetch(PDO::FETCH_LAZY);
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

        public function getUsersByName($name)
        {
            try{
                $this->database = new Connection();
                $this->db = $this->database->openConnection();
                // inserting data into create table using prepare statement to prevent from sql injections
                $query = $this->db->prepare('SELECT * FROM users WHERE name LIKE :name OR mail Like :name');
                $query->execute(['name' => "%$name%"]);
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
    
        public function getName(){
            return $this->name;
        }
    
         public function getId(){
            return $this->id;
        }
    }

?>