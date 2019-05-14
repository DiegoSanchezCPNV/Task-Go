<?php
/**
 * Created by PhpStorm.
 * User: Diego.SANCHEZ
 * Date: 14.05.2019
 * Time: 08:45
 */

function ConnexionDB()
{
    $connexion = new PDO('mysql:host=localhost; dbname=TaskAndGo; charset=utf8','root','1234');

    $connexion ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $connexion;
}


function CreateAccount()
{
    $connexion = ConnexionDB();
    extract($_POST);

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
    //$idUitlisateur = $ligne['id'];
    //$NomUtilisateur = "".$ligne['firsname']." ".$ligne['surname'];

//$_SESSION['mailConnexion'] = $mail;
    if($leMail == $_POST['femail'] && $leMDP == $_POST['fmdp'])
    {
        $_SESSION['mailUtilisateur'] = $leMail;
    }
    else if($leMail == NULL)
    {
        header('Location: index.php?connexion&erreur=1');
    }
}