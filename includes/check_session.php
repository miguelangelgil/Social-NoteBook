<?php
/*
Autor: Miguel Ángel Gil Martín (MAGMa)
Esta obra está licenciada bajo la Licencia Creative Commons Atribución-CompartirIgual 4.0 
Internacional. Para ver una copia de esta licencia, 
visite http://creativecommons.org/licenses/by-sa/4.0/.
*/
?>
<?php 
    //Se añade en todas las vistas que hay dentro del dominio de un usuario para comprobar el registro del usuario
    include_once '../classes/session.php';
    include_once '../classes/user.php';

    $user = new User();
    $session = new Session();

    if(!isset($_SESSION['user']))
    {
        header("location: ../index.php");
    }else
    {
        $user->setUser($session->getCurrentUser());
    }
?>