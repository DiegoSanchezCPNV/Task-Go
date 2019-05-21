<?php
/**
 * Created by PhpStorm.
 * User: Diego.SANCHEZ
 * Date: 2019
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
    else if(isset($accueilVisiteur))
    {
        session_destroy();
        require('view/view_Home.php');
    }
    else if (isset($SelectedDay))
    {
       showSelectedDay();
    }
    else if(isset($MyTaskMeeting))
    {
        showMyTaskMeeting();
    }
    else if(isset($addMeetForm))
    {
        showAddMeetForm();
    }
    else if(isset($addMeet))
    {
        showAddMeet();
    }
    else if(isset($addTaskForm))
    {
        showAddTaskForm();
    }
    else if(isset($addTask))
    {
        showAddTask();
    }
    else if(isset($calendar))
    {
        showCalendar();
    }
    else
    {
        session_destroy();
        require('view/view_Home.php');
    }
}
catch(Exception $e)
{
    echo 'Erreur: ' . $e->getMessage();
}

?>
