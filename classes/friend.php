<?php
    include_once 'connection.php';

    class Friend
    {

        public function requestFriend($id_user, $id_friend)
        {
            try{
                $this->database = new Connection();
                $this->db = $this->database->openConnection();
                // inserting data into create table using prepare statement to prevent from sql injections
                $stm = $this->db->prepare("INSERT INTO friends (id_user, id_friend) VALUES (:id_user, :id_friend)") ;
                // inserting a record
                $stm->execute(array(':id_user' => $id_user , ':id_friend' => $id_friend));
                ?>
                    <div class="alert alert-success" role="alert">
                        Made friend successfully
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
        public function requestSent($id_user, $id_friend)
        {
            try
            {
                
                $this->database = new Connection();
                $this->db = $this->database->openConnection();
                $query = $this->db->prepare('SELECT * FROM friends WHERE id_user = :id_user AND id_friend = :id_friend AND are_friend = 0');
                $query->execute(['id_friend' => $id_friend, 'id_user' => $id_user]);
                
                if($query->rowCount() == 0)
                {
                    $query = $this->db->prepare('SELECT * FROM friends WHERE id_user = :id_friend AND id_friend = :id_user AND are_friend = 0');
                    $query->execute(['id_friend' => $id_friend, 'id_user' => $id_user]);
                    return $query->rowCount()>0 ;

                }else
                {
                    return $query->rowCount()>0 ;
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

        public function areFriends($id_user, $id_friend)
        {
            try
            {
                $this->database = new Connection();
                $this->db = $this->database->openConnection();
                $query = $this->db->prepare('SELECT * FROM friends WHERE id_user = :id_user AND id_friend = :id_friend AND are_friend = 1');
                $query->execute(['id_friend' => $id_friend, 'id_user' => $id_user]);
                
                if($query->rowCount() == 0)
                {
                    $query = $this->db->prepare('SELECT * FROM friends WHERE id_user = :id_friend AND id_friend = :id_user AND are_friend = 1');
                    $query->execute(['id_friend' => $id_friend, 'id_user' => $id_user]);
                    return $query->rowCount()>0 ;

                }else
                {
                    return $query->rowCount()>0 ;
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


        public function searchRequestsSentByUserById($id_user)
        {
            try
            {
                $this->database = new Connection();
                $this->db = $this->database->openConnection();
                $query = $this->db->prepare('SELECT * FROM friends WHERE id_user = :user AND are_friend = false');
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

        public function searchRequestsReceivedByUserById($id_user)
        {
            try
            {
                $this->database = new Connection();
                $this->db = $this->database->openConnection();
                $query = $this->db->prepare('SELECT * FROM friends WHERE id_friend = :user AND are_friend = false');
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
        public function acceptRequest($id)
        {
            try{
                $this->database = new Connection();
                $this->db = $this->database->openConnection();
                // inserting data into create table using prepare statement to prevent from sql injections
                $sql = "UPDATE friends SET are_friend = ? WHERE friends . id = ?";
                $result = $this->db->prepare($sql);
                $result->execute([1, $id]);
                ?>
                    <div class="alert alert-success" role="alert">
                        Request accepted successfully
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
        public function getFriendsByIdUser($id_user)
        {
            try
            {
                $this->database = new Connection();
                $this->db = $this->database->openConnection();
                $query = $this->db->prepare('SELECT * FROM friends WHERE id_friend = :user AND are_friend = true OR id_user = :user AND are_friend = true');
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
        public function removeRequestOrFriend($id)
        {
            try
            {
                $this->database = new Connection();
                $this->db = $this->database->openConnection();
                $query = $this->db->prepare('DELETE FROM friends WHERE friends . id = :id');
                $query->bindParam('id', $id);
                $query->execute();
                ?>
                    <div class="alert alert-success" role="alert">
                        Friend deleted successfully
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