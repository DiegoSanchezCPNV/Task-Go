<?php

//Connexion a la base de donnée
function ConnexionDBB()
{
    $connexion = new PDO('mysql:host=localhost; dbname=sanchezd_TPI; charset=utf8','sanchezd_TPI','SanchezTPI2019$');
    $connexion ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $connexion;
}

//Fonction qui va sortir tous les rendez-vous qui sont dans le temps du reminder précédement définit
function Meeting()
{
     $connexion = ConnexionDBB();
  
        
    $requete = "SELECT meet.id, user.id, id_Meeting_User, description, comment,user.email as mail,user.termBefore as term, hour, now(), TIMESTAMPDIFF(SECOND,now(), hour) 
                FROM meet 
                inner join user on meet.id_Meeting_User = user.id
                WHERE meet.id_Meeting_User = user.id
                and TIMESTAMPDIFF(SECOND,now(), hour) < (user.termBefore)
                and TIMESTAMPDIFF(SECOND,now(), hour) > 0";
       
    $resultatsMeet = $connexion->query($requete);
    return $resultatsMeet;
}

//fonction qui construit le mail et l'envoie via SwissCenter
function MailTO($user,$term,$Message)
{
    $to = $user;

    $message = "Ce mail est un rappel pour vous annoncer que vous avez $Message dans moins de $term";

    $sujet = "Mail de rappel. \r\n ";

    $message = wordwrap($message, 120, "\r\n");
    
    $header = 'Content-type: text/html; charset=UTF-8' . "\r\n";
    $header .= 'From: admin@taskandgo.mycpnv.ch'."\r\n";

    mail($to,$sujet,$message,$header);
    echo "mailto ok";
    
}

$resultatsMeet = Meeting();

//Si des rendez-vous apparaissent, envoie un mail à l'utilisateur propriétaire du rendez-vous
if(isset($resultatsMeet))
{
    echo "meet ok";
    foreach ($resultatsMeet as $key)
    {
        $user = $key['mail'];
        $term = $key['term'];
        $Message = "un rendez-vous";
        MailTO($user,$term,$Message);
    }
}

























