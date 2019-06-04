<?php
/**
 * Created by PhpStorm.
 * User: Diego.SANCHEZ
 * Date: mai 2019
 */

function ConnexionDB()
{
    //BDD en local
    //$connexion = new PDO('mysql:host=localhost; dbname=TaskAndGo; charset=utf8','root','1234');
    //BDD du site en ligne
    $connexion = new PDO('mysql:host=localhost; dbname=sanchezd_TPI; charset=utf8','sanchezd_TPI','SanchezTPI2019$');


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
    else
    {
        $query = $connexion->prepare("insert into user (id, firstName, lastName, password, email, reminder, termBefore, id_DisplayMode, displayNumber, isAdmin, isActive) 
                                            values (null, '".$fname."', '".$fsurname."', '".$mdp."', '".$fmail."', 0, 0, 1,5,0,0);");
        $query->execute();
    }
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
    $Admin = $ligne['isAdmin'];

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
                    if($Admin == 1)
                    {
                        $_SESSION['UserName'] = "Admin";
                        $_SESSION['UserId']= $id;
                        header('Location: index.php?userList');
                    }
                    else
                    {
                        $_SESSION['UserMail'] = $leMail;
                        $_SESSION['UserName'] = $UserName;
                        $_SESSION['UserId']= $id;
                        header('Location: index.php?calendar');
                    }

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


    $requete = "SELECT task.id, description as Description, hour as Date, user.firstname as Propriétaire, state.name as Etat FROM task 
                inner join user on task.id_Task_User = user.id 
                inner join state on task.id_State = state.id 
                where hour LIKE '".$date."%'
                and id_Task_User = '".$_SESSION['UserId']."'
                order by hour";

    $resultatsTask = $connexion->query($requete);

    return $resultatsTask;

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
    $requete = "SELECT id, description as Description, hour as Date, term as Durée, place as Lieu, comment as Commentaire, id_Meeting_User 
                FROM meet 
                where hour LIKE '".$date."%'
                AND id_Meeting_User = '".$_SESSION['UserId']."' 
                order by hour;";

    $resultatsMeet = $connexion->query($requete);

    return $resultatsMeet;
}

function CreationMeet($date)
{
    $connexion = ConnexionDB();

    extract($_POST);

    $Hour = $date." ".$ftime.":00";

    $resultDesc = addslashes($fdesc);
    $resultComment = addslashes($fcomment);

    $query = $connexion->prepare("insert into meet (id, description, hour, term, place, comment, id_Meeting_User) 
            values (null,'".$resultDesc."','".$Hour."','".$fterm."','".$fplace."','".$resultComment."','".$_SESSION['UserId']."');");

    $query->execute();
}


function CreationTask($date)
{
    $connexion = ConnexionDB();

    extract($_POST);

    $Hour = $date." ".$ftime;

    $resultDesc = addslashes($fdesc);

    $query = $connexion->prepare("insert into task (id, description, hour, id_Task_User, id_State) 
                values (null,'".$resultDesc."','".$Hour."','".$_SESSION['UserId']."',1);");

    $query->execute();
}
function showReminderUser()
{
    $connexion = ConnexionDB();

    $requete = "SELECT displayNumber from user where id = '".$_SESSION['UserId']."'";

    $resultat = $connexion->query($requete);

    return $resultat;
}

function ShowAllMeet($display)
{
    $connexion = ConnexionDB();

    $requete = "SELECT id, description as Description, hour as Date, term as Durée, place as Lieu, comment as Commentaire, id_Meeting_User 
                FROM meet 
                where id_Meeting_User = '".$_SESSION['UserId']."'
                order by hour desc
                limit $display;";

    $resultatsMeet = $connexion->query($requete);

    return $resultatsMeet;
}

function ShowAllTask($display)
{
    $connexion = ConnexionDB();

    $requete = "SELECT task.id, description as Description, hour as Date, user.firstName as Propriétaire, state.name as Etat FROM task 
                inner join user on task.id_Task_User = user.id 
                inner join state on task.id_State = state.id
                where id_Task_User = '".$_SESSION['UserId']."'
                order by hour desc
                limit $display;";

    $resultatstask = $connexion->query($requete);

    return $resultatstask;
}

function UserList()
{

    $connexion = ConnexionDB();

    $requete = "SELECT id,firstname as Prénom, lastname as Nom, email, isActive as CompteActif FROM user where id != '".$_SESSION['UserId']."';";

    $resultats = $connexion->query($requete);

    return $resultats;
}

function DeleteUser($id)
{
    $connexion = ConnexionDB();

    //$query = $connexion->prepare("delete from user where id = '".$id."'");

    $query = $connexion->prepare("update user set isActive = 0 where id = '".$id."';");

    $query->execute();
}

function DeleteMeet($id)
{
    $connexion = ConnexionDB();

    $query = $connexion->prepare("delete from meet where id = '".$id."'");

    $query->execute();
}

function DeleteTask($id)
{
    $connexion = ConnexionDB();

    $query = $connexion->prepare("delete from task where id = '".$id."'");

    $query->execute();
}

function ShowTaskModif($id)
{
    $connexion = ConnexionDB();

    $requete = "SELECT id,description, hour, id_Task_User, id_State FROM task 
                where id = '".$id."' order by hour;";

    $resultats = $connexion->query($requete);

    return $resultats;
}
function ShowMeetModif($id)
{
    $connexion = ConnexionDB();

    $requete = "SELECT id,description, hour, term, place, comment, id_Meeting_User FROM meet 
                where id = '".$id."' order by hour;";

    $resultats = $connexion->query($requete);

    return $resultats;
}
function ModifyMeet($id,$date,$desc,$hour,$term,$place,$comment)
{
    $connexion = ConnexionDB();

    $Hour = $date." ".$hour;

    $resultDesc = addslashes($desc);
    $resultComment = addslashes($comment);

    $query = $connexion->prepare("update meet set description = '".$resultDesc."', hour = '".$Hour."', 
                                            term = '".$term."', place = '".$place."', comment = '".$resultComment."' where id = '".$id."'");

    $query->execute();
}

function ModifyTask($id,$date,$desc,$hour,$state)
{
    $connexion = ConnexionDB();

    $Hour = $date." ".$hour;

    $resultDesc = addslashes($desc);

    $query = $connexion->prepare("update task set description = '".$resultDesc."', hour = '".$Hour."', 
                                            id_State = '".$state."' where id = '".$id."'");

    $query->execute();
}

function ModifySettings($displayModeNumber,$choixVue,$choixRappel,$numberRappel)
{
    $connexion = ConnexionDB();

    $query = $connexion->prepare("update user set reminder = '".$choixRappel."', termBefore = '".$numberRappel."', 
                                    id_DisplayMode = '".$choixVue."', displayNumber = '".$displayModeNumber."' where id = '".$_SESSION['UserId']."'");

    $query->execute();
}



function mailValidation($mailUser)
{
    extract($_GET);


    // Envoi du mail
    $to = $mailUser;

    // Le message
    $message = "http://taskandgo.mycpnv.ch/index.php?valid&user=$mailUser";

    $sujet = "Voici votre lien afin de valider votre compte sur Task&Go. \r\n ";


    // Dans le cas où nos lignes comportent plus de 120 caractères, nous les coupons en utilisant wordwrap()
    $message = wordwrap($message, 120, "\r\n");

    mail($to,$sujet,$message,"From: admin@taskandgo.mycpnv.ch");
}

function ValidUserAccount($user)
{
    $connexion = ConnexionDB();

    $query = $connexion->prepare("update user set isActive = 1 where email = '".$user."'");

    $query->execute();
}

function HaveTaskBDD($Day)
{
    $connexion = ConnexionDB();

    $requete = "SELECT task.id from task 
                inner join user on task.id_Task_User = user.id 
                where hour LIKE '".$Day."%' and id_Task_User = '".$_SESSION['UserId']."'";

    $resultatTask = $connexion->query($requete);

    return $resultatTask;
}

function HaveMeetBDD($Day)
{
    $connexion = ConnexionDB();

    $requete = "SELECT meet.id from meet  
                inner join user on meet.id_Meeting_User = user.id 
                where hour LIKE '".$Day."%' and id_Meeting_User = '".$_SESSION['UserId']."'";

    $resultatMeet = $connexion->query($requete);

    return $resultatMeet;
}



