<?php
/*
Autor: Miguel Ángel Gil Martín (MAGMa)
Esta obra está licenciada bajo la Licencia Creative Commons Atribución-CompartirIgual 4.0 
Internacional. Para ver una copia de esta licencia, 
visite http://creativecommons.org/licenses/by-sa/4.0/.
*/
?>
<?php //formulario de registro de usuario ?>
<br>
<div class="d-flex justify-content-center">

<div class="card">
  <h5 class="card-header">Create an acount</h5>
  <div class="card-body">
  <form action="?" method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter mail" name= "user_mail">
            <?php
                if(!isset($_POST['user_mail']))$_POST['user_mail'] = '';
             ?>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Name</label>
            <input type="text" class="form-control" placeholder="Enter name" name="user_name">
            <?php
                if(!isset($_POST['user_name']))$_POST['user_name'] = '';
                else
                {
                    if(strlen ($_POST['user_name']) < 4)
                    {
                        ?>
                            <div class="alert alert-warning" role="alert" style=" font-size:10px">
                                Name too short
                            </div>
                        <?php
                    }
                }
             ?>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" placeholder="Enter password" name= "user_password">
        </div>
        <button type="submit" class="btn btn-primary" name="create_an_acount">Create an acount</button>
    </form>
    <?php
        function ThatUserIsAlreadyInUse()
        {
            ?>
                <div class="alert alert-warning" role="alert" style=" font-size:10px">
                    that user is already in use
                </div>
            <?php
        }
    ?>
    
  </div>
</div>
    
</div>

<?php
    //control de creacion de usuario

    include_once 'classes/user.php';
    include_once 'classes/session.php';
   // $session = new Session();
    $user = new User();
    if (!isset ($_POST['create_an_acount']))$_POST['create_an_acount']=false;
    if(isset($_SESSION['user']))
    {
        header("location: ./view/home.php");
        exit();
    }
   
    if(isset($_POST['user_mail']) && isset($_POST['user_name']) && isset($_POST['user_password']))
    {
        if(!$user->userExists( $_POST['user_name'],$_POST['user_mail']))
        {
            if ($user->signIn( $_POST['user_name'],$_POST['user_password'],$_POST['user_mail']))
            {
                $user->setUser($_POST['user_name']);
                $session->setCurrentUser($user->getName());
                header("location: ./view/home.php");
                exit();

            }
        }else
        {
            ThatUserIsAlreadyInUse();
        }
            


    }

?>