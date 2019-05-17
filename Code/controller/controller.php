<?php
/**
 * Created by PhpStorm.
 * User: Diego.SANCHEZ
 * Date: 14.05.2019
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
        if(isset($_SESSION['UserMail']))
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
    require "view/view_MyTaskMeeting.php";
}