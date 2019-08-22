<?php
//cierra la session y devuelve la vista al registro de usuario
include_once '../classes/session.php';

    $session = new Session();
    $session->closeSession();
    include_once 'check_session.php';

?>