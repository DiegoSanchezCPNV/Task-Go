<?php
/**
 * Created by PhpStorm.
 * User: Diego.SANCHEZ
 * Date: 2019
 * Time: 08:44
 */


require_once('model/model.php');
extract($_POST);

//Cette page sert à rediriger le code vers la bonne fonction de la page model.php

function showInscription()
{
    if(isset($_POST['fname']))
    {
        if($_POST['fmail'] == $_POST['fmail2'])
        {
            if($_POST['fmdp'] == $_POST['fmdp2'])
            {
                CreateAccount();
                $mailUser = $_POST['fmail'];
                mailValidation($mailUser);
                require "view/view_Connexion.php";
            }
            else
            {
                header('Location: index.php?inscription&erreur=2');
            }
        }
        else
        {
            header('Location: index.php?inscription&erreur=4');
        }
    }
    else
    {
       require('view/view_Inscription.php');
    }
}

function showConnexion()
{
    if(isset($_POST['femail']))
    {
        ConnexionUser($_POST);
    }
    else
    {
        if(isset($_SESSION['UserName']))
        {
            //Zone de déconnexion
            session_destroy();
            header('Location: index.php?connexion');
        }
        else
        {
            require "view/view_Connexion.php";
        }
    }
}


function showCalendar()
{
    require "view/view_Calendar.php";
}

function showMyTaskMeeting()
{
    $resultatsMeet = ShowAllMeet();
    $resultatstask = ShowAllTask();
    require "view/view_MyTaskMeeting.php";
}

function showSelectedDay()
{
    $day = $_GET['day'];
    $month = $_GET['month'];
    $year = $_GET['year'];

    $resultatsTask = ShowTask($day,$month,$year);
    $resultatsMeet = ShowMeet($day,$month,$year);
    require "view/view_SelectedDay.php";
}

function showAddMeetForm()
{
    require "view/view_AddMeet.php";
}
function showAddMeet()
{
    $date = $_GET['date'];
    CreationMeet($date);
    require "view/view_Calendar.php";
}

function showAddTaskForm()
{
    require "view/view_AddTask.php";
}
function showAddTask()
{
    $date = $_GET['date'];
    CreationTask($date);
    require "view/view_Calendar.php";
}

function showUserList()
{
    $resultats = UserList();
    require "view/view_UserList.php";
}

function showDeleteUser()
{
    $id = $_GET['ID'];
    DeleteUser($id);
    header('Location: index.php?userList');
}

function showDeleteMeet()
{
    $id = $_GET['ID'];
    DeleteMeet($id);
    require "view/view_Calendar.php";
}

function showDeleteTask()
{
    $id = $_GET['ID'];
    DeleteTask($id);
    require "view/view_Calendar.php";
}

function showModifyTask()
{
    if(isset($_POST['fdesc']))
    {
        $id = $_GET['ID'];
        $date = $_GET['date'];
        $desc = $_POST['fdesc'];
        $hour = $_POST['ftime'];
        $state = $_POST['fcat'];

        ModifyTask($id,$date,$desc,$hour,$state);
        require "view/view_Calendar.php";
    }
    else
    {
        if (isset($_GET['ID']))
        {
            $id = $_GET['ID'];
            $resultats = ShowTaskModif($id);
            require "view/view_ModifyTask.php";
        }
    }

}

function showModifyMeet()
{
    if(isset($_POST['fdesc']))
    {
        $id = $_GET['ID'];
        $date = $_GET['date'];
        $desc = $_POST['fdesc'];
        $hour = $_POST['ftime'];
        $term = $_POST['fterm'];
        $place = $_POST['fplace'];
        $comment = $_POST['fcomment'];

        ModifyMeet($id,$date,$desc,$hour,$term,$place,$comment);
        require "view/view_Calendar.php";
    }
    else
    {
        if (isset($_GET['ID']))
        {
            $id = $_GET['ID'];
            $resultats = ShowMeetModif($id);
            require "view/view_ModifyMeet.php";
        }
    }
}

function showSettings()
{
    //https://css-tricks.com/exposing-form-fields-radio-button-css/

    if(isset($_POST['fnumber']))
    {
        $displayModeNumber = $_POST['fnumber'];
        $choixVue = $_POST['fchoixVue'];
        $choixRappel = $_POST['fchoix'];
        $numberRappel = $_POST['fnumberRappel'];

        ModifySettings($displayModeNumber,$choixVue,$choixRappel,$numberRappel);
        require "view/view_Calendar.php";
    }
    else
    {
        //$resultats = ShowSettingsModif();
        require "view/view_Settings.php";
    }
}

function showValid($user)
{
    ValidUserAccount($user);
    require "view/view_validation.php";
}