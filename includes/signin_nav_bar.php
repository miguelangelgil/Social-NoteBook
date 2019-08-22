<?php//barra de autentificación de usuario?>
<nav class="navbar navbar-light bg-light">
  <span class="navbar-brand mb-0 h1">Social NoteBook</span>
  <?php
    function NameOrPasswordIsWrong()
    {
      ?>
        <div class="alert alert-warning" role="alert" style=" font-size:10px">
          Name or password is wrong
        </div>
      <?php
    }

   ?>
  <form class="form-inline" action="?" method="POST">
    <input class="form-control mr-sm-2" type="text" placeholder="name" name="name_login">
    <input class="form-control mr-sm-2" type="password" placeholder="password" name="password_login">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="log_in"><i class="fas fa-sign-in-alt"></i> log in</button>
  </form>
</nav>
<?php
  //Control de atentificacion de usuario
  include_once 'classes/user.php';
  include_once 'classes/session.php';
  $session = new Session();
  $user= new User();
  if (!isset ($_POST['log_in']))$_POST['log_in']=false;
  if(isset($_SESSION['user']))
  {
    header("location: ./view/home.php");
    exit();
  }
  if(isset($_POST['name_login']) && isset($_POST['password_login']))
  {
    if($user->logIn($_POST['name_login'],$_POST['password_login']))
    {
      $user->setUser($_POST['name_login']);
      $session->setCurrentUser($user->getName());
      header("location: ./view/home.php");
      exit();
    }else
    {
      NameOrPasswordIsWrong();
    }

  }




?>