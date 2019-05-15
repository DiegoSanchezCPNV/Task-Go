<?php
/**
 * Created by PhpStorm.
 * User: Diego.SANCHEZ
 * Date: 14.05.2019
 * Time: 08:45
 */

function ConnexionDB()
{
   // $connexion = new PDO('mysql:host=localhost; dbname=TaskAndGo; charset=utf8','root','1234');
    $connexion = new PDO('mysql:host=localhost; dbname=sanchezd_db; charset=utf8','sanchezd','Messi2011$');


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

    if($fmail == $emailDansBdd)
    {
        $_SESSION['mailConnexion'] = $emailDansBdd;
        header('Location: index.php?inscription&erreur=1');
    }

    $query = $connexion->prepare("insert into user (id, firstName, lastName, password, email, reminder, termBefore, id_DisplayMode, displayNumber, isAdmin, isActive) 
                                            values (null, '".$fname."', '".$fsurname."', '".$fmdp."', '".$fmail."', 0, 0, 1,5,0,0);");
    $query->execute();
}

function ConnexionUser()
{
    $connexion = ConnexionDB();

    //$mdp = sha1($_POST['fmdp']); //convertie le mot de passe

// Requête pour sélectionner la personne loguée
    $requete = "SELECT * FROM user WHERE email= '".$_POST['femail']."' AND password='".$_POST['fmdp']."';";

// Exécution de la requête et renvoi des résultats
    $resultats = $connexion->query($requete);

    $ligne = $resultats->fetch();
    $leMail = $ligne['email'];
    $leMDP = $ligne['password'];
    $isActive = $ligne['isActive'];

//$_SESSION['mailConnexion'] = $mail;

        if($leMail == $_POST['femail'])
        {
            if($leMDP == $_POST['fmdp'])
            {
                if($isActive == 0)
                {
                    header('Location: index.php?connexion&erreur=2');
                }
                else
                {
                    $_SESSION['mailUtilisateur'] = $leMail;
                    header('Location: index.php?inscription');
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