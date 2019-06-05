<?php
/**
 * Created by PhpStorm.
 * User: Diego.SANCHEZ
 * Date: mai-juin 2019
 */
//Template qui apparaitra sur toutes les pages du site
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style/CSS.css">
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


