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
       require('view/view_Inscription.php');
    }
}

function showConnexion()
{
    if(isset($_POST['femail']))
    {
        ConnexionUser($_POST);

        if($_SESSION['mailUtilisateur'] == $_POST['femail'])
            {
                require "view/view_Home.php";
            }
            else
            {
                header('Location: index.php?connexion&erreur=2');
            }
    }
    else
    {
        if(isset($_SESSION['mailUtilisateur']))
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
