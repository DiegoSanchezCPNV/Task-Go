<?php
/**
 * Created by PhpStorm.
 * User: Diego.SANCHEZ
 * Date: 2019
 * Time: 08:45
 */

function ConnexionDB()
{
    //BDD en local
    $connexion = new PDO('mysql:host=localhost; dbname=TaskAndGo; charset=utf8','root','1234');
    //BDD du site en ligne
    //$connexion = new PDO('mysql:host=localhost; dbname=sanchezd_TPI; charset=utf8','sanchezd_TPI','SanchezTPI2019$');


    $connexion ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $connexion;
}


function CreateAccount()
{
    $connexion = ConnexionDB();
    extract($_POST);

    //test si l'email mit par l'utilisateur n'est pas déjà lié à un compte
    $requete = "SELECT * FROM user WHERE email='".$fmail."';";
    $emailAtest =$connexion->query($requete);
    $ligne = $emailAtest->fetch();
    $emailDansBdd = $ligne['email'];
    $mdp = sha1($fmdp);

    if($fmail == $emailDansBdd)
    {
        $_SESSION['mailConnexion'] = $emailDansBdd;
        header('Location: index.php?inscription&erreur=1');
    }

    $query = $connexion->prepare("insert into user (id, firstName, lastName, password, email, reminder, termBefore, id_DisplayMode, displayNumber, isAdmin, isActive) 
                                            values (null, '".$fname."', '".$fsurname."', '".$mdp."', '".$fmail."', 0, 0, 1,5,0,0);");
    $query->execute();
}

function ConnexionUser()
{
    $connexion = ConnexionDB();

    $leMDP = sha1($_POST['fmdp']); //converti en SHA1 le mot de passe entré par l'utilisateur

// Requête pour sélectionner la personne loguée
    $requete = "SELECT * FROM user WHERE email= '".$_POST['femail']."' AND password='".$leMDP."';";

// Exécution de la requête et renvoi des résultats
    $resultats = $connexion->query($requete);

    $ligne = $resultats->fetch();
    $leMail = $ligne['email'];
    $mdp = $ligne['password'];
    $id = $ligne['id'];

    $isActive = $ligne['isActive'];

    $UserName = "".$ligne['firstName']." ".$ligne['lastName'];

        if($leMail == $_POST['femail'])
        {
            if($mdp == $leMDP)
            {
                if($isActive == 0)
                {
                    header('Location: index.php?connexion&erreur=2');
                }
                else
                {
                    $_SESSION['UserMail'] = $leMail;
                    $_SESSION['UserName'] = $UserName;
                    $_SESSION['UserId']= $id;
                    header('Location: index.php?calendar');
                }
            }
            else
            {
                header('Location: index.php?connexion&erreur=1');
            }
        }
        else
        {
            header('Location: index.php?connexion&erreur=1');
        }
}

function ShowTask($day,$month,$year)
{
    $connexion = ConnexionDB();

    if (strlen($month) == 1)
    {
        $month = "0".$month;
    }
    if (strlen($day) == 1)
    {
        $day = "0".$day;
    }
    $date = $year."-".$month."-".$day."";


    $requete = "SELECT id, description, hour, id_Task_User, id_State FROM task where hour LIKE '".$date."%';";

    $resultats = $connexion->query($requete);

    return $resultats;

}

function ShowMeet($day,$month,$year)
{
    $connexion = ConnexionDB();

    if (strlen($month) == 1)
    {
        $month = "0".$month;
    }
    if (strlen($day) == 1)
    {
        $day = "0".$day;
    }
    $date = $year."-".$month."-".$day."";
    //$requete = "SELECT id, description, hour, term, place, comment, id_Meeting_User FROM meet where hour LIKE '%".$date."%';";
    $requete = "SELECT id, description as Description, hour as DateEtHeure, term as Durée, place as Lieu, comment as Commentaire, id_Meeting_User FROM meet where hour LIKE '".$date."%';";

    $resultats = $connexion->query($requete);

    return $resultats;
}

function CreationMeet($date)
{
    $connexion = ConnexionDB();

    extract($_POST);

    $Hour = $date." ".$ftime;

    $query = $connexion->prepare("insert into meet (id, description, hour, term, place, comment, id_Meeting_User) 
            values (null,'".$fdesc."','".$Hour."','".$fterm."','".$fplace."','".$fcomment."','".$_SESSION['UserId']."');");

    $query->execute();
}


function CreationTask()
{
    $connexion = ConnexionDB();

    $query = $connexion->prepare("insert into meet (id, description, hour, term, place, comment, id_Meeting_User) values (null,'Entretien','2019-05-18','01:30:00','Nespresso','Ne pas oublier CV',9);");

    $query->execute();
}


function ShowAllMeet()
{
    $connexion = ConnexionDB();

    $requete = "SELECT id, description as Description, hour as DateEtHeure, term as Durée, place as Lieu, comment as Commentaire, id_Meeting_User FROM meet where id_Meeting_User = '".$_SESSION['UserId']."';";

    $resultatsMeet = $connexion->query($requete);

    return $resultatsMeet;
}

function ShowAllTask()
{
    $connexion = ConnexionDB();

    $requete = "SELECT id, description, hour, id_Task_User, id_State FROM task where id_Task_User = '".$_SESSION['UserId']."';";

    $resultatstask = $connexion->query($requete);

    return $resultatstask;
}