<?php
/**
 * Created by PhpStorm.
 * User: Diego.SANCHEZ
 * Date: 14.05.2019
 * Time: 08:41
 */
require_once('controller/controller.php');
SESSION_start();
extract($_POST);
extract($_GET);


//redirige vers les différentes fonctions suivant la donnée reçu
try
{
    if(isset($inscription))
    {
        showInscription();
    }
    else if(isset($connexion))
    {
        showConnexion();
    }
    else
    {
        require('view/view_Home.php');
    }
}
catch(Exception $e)
{
    echo 'Erreur: ' . $e->getMessage();
}

?>
