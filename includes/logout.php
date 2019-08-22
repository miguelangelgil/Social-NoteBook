<?php
/*
Autor: Miguel Ángel Gil Martín (MAGMa)
Esta obra está licenciada bajo la Licencia Creative Commons Atribución-CompartirIgual 4.0 
Internacional. Para ver una copia de esta licencia, 
visite http://creativecommons.org/licenses/by-sa/4.0/.
*/
?>
<?php
//cierra la session y devuelve la vista al registro de usuario
include_once '../classes/session.php';

    $session = new Session();
    $session->closeSession();
    include_once 'check_session.php';

?>