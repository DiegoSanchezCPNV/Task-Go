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