<?php
/**
 * Created by PhpStorm.
 * User: Diego.SANCHEZ
 * Date: 2019
 * Time: 09:11
 */
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style/CSS.css">
        <script src="function/functionJavaScript.js"></script>
        <meta charset="utf-8">
    </head>
    <header>
        <div class="header">
            <ul>
                <!-- Affichage du header en fonction de l'utilisateur connecté (visiteur/utilisateur/admin) -->
                <?php if(isset($_SESSION['UserMail']))
                {
                    echo "<a href=\"?calendar\" class='AHeader'>Calendrier de ".@$_SESSION['UserName']."</a>";
                    echo "<a href=\"?MyTaskMeeting\" class='AHeader'>Mes tâches et rendez-vous</a>";
                    //echo "<a href=\"?settings\" class='AHeader'>Paramétrage</a>";
                    echo "<a href=\"?settings\" class='AHeader'>Paramétrage</a>";
                    echo "<a href=\"?connexion\" class='AHeader'>Se déconnecter</a>";
                }
                else if(@$_SESSION['UserName'] == "Admin")
                {
                    echo "<a href=\"?userList\" class='AHeader'>Liste des utilisateurs</a>";
                    echo "<a href=\"?connexion\" class='AHeader'>Se déconnecter</a>";
                }
                else if(@$_SESSION['UserMail'] == null)
                {
                    echo "<a href=\"?accueilVisiteur\" class='AHeader'>Accueil</a>";
                }

                ?>
            </ul>

        </div>
    </header>
    <body onload="MailReminder()">


