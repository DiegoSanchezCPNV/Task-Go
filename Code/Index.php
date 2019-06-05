<?php
/**
 * Created by PhpStorm.
 * User: Diego.SANCHEZ
 * Date: mai-juin 2019
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
    else if(isset($DeleteUser))
    {
        showDeleteUser();
    }
    else if(isset($DeleteMeet))
    {
        showDeleteMeet();
    }
    else if(isset($DeleteTask))
    {
        showDeleteTask();
    }
    else if(isset($ModifyTask))
    {
        showModifyTask();
    }
    else if(isset($ModifyMeet))
    {
        showModifyMeet();
    }
    else if(isset($settings))
    {
        showSettings();
    }
    else if(isset($valid))
    {
        $user = $_GET['user'];
        showValid($user);
    }
    else if(isset($userList))
    {
        showUserList();
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
