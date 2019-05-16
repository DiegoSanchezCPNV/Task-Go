<?php
/**
 * Created by PhpStorm.
 * User: Diego.SANCHEZ
 * Date: 14.05.2019
 * Time: 10:39
 */
require_once('template.php');
$special = 'àâäãçéèêëìîïòôöõùûüñ &*?!:;,\t#~"^¨%$£?²¤§%*()[]{}<>|\\/`\'';
?>

<h1>Inscription</h1>
<?php if(@$_GET['erreur']==2){ ?><font color="#FF0000">Les deux mot de passe ne sont pas compatible</font><?php unset($_GET['erreur']);} ?>
<?php if(@$_GET['erreur']==4){ ?><font color="#FF0000">Les emails ne sont pas compatible</font><?php unset($_GET['erreur']);} ?>
<?php if(@$_GET['erreur']==1){ ?><font color="#FF0000">cette adresse mail est déjà utilisée</font><?php unset($_GET['erreur']);} ?>
<?php if(@$_GET['erreur']==3){ ?><font color="#FF0000">Veuillez vous créer un compte</font><?php unset($_GET['erreur']);} ?>
<form method="POST" action="index.php?inscription" role="form" id="inscriptionForm" class="Formulaire">
<div class="container">
    <div class="row">
        <div class="col-25">
            <label for="fname">Prénom</label>
        </div>
        <div class="col-75">
            <input type="text" id="fname" name="fname" placeholder="Veuillez entrer votre prénom" pattern="[a-zA-ZÀ-ž\s-]+" title="Veuillez indiquer que des lettres dans ce champ" required>
        </div>
    </div>
    <div class="row">
        <div class="col-25">
            <label for="fsurname">Nom</label>
        </div>
        <div class="col-75">
            <input type="text" id="fsurname" name="fsurname" placeholder="Veuillez entrer votre nom" pattern="[a-zA-ZÀ-ž\s-]+" title="Veuillez indiquer que des lettres dans ce champ" required>
        </div>
    </div>
    <div class="row">
        <div class="col-25">
            <label for="fmail">Email</label>
        </div>
        <div class="col-75">
            <input type="text" id="fmail" name="fmail" placeholder="Veuillez entrer votre adresse mail" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Exemple : prenom.nom@cpnv.ch" required>
        </div>
    </div>
    <div class="row">
        <div class="col-25">
            <label for="fmail2">Confirmez votre email</label>
        </div>
        <div class="col-75">
            <input type="text" id="fmail2" name="fmail2" placeholder="Veuillez confirmer votre adresse mail" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Exemple : prenom.nom@cpnv.ch" required>
        </div>
    </div>
    <div class="row">
        <div class="col-25">
            <label for="fmdp">Mot de passe</label>
        </div>
        <div class="col-75">
            <input type="password" id="fmdp" name="fmdp" placeholder="Veuillez entrer votre mot de passe"
                   pattern="(?=.*?[#?!@$%^&*-])[a-zA-ZÀ-ž0-9\s-]+.{7,}"
                   title="Le mot de passe doit contenir au minimum 8 caractères, dont des lettres en majuscule, miniscule, des chiffres et au moins caractère spécial" required>
        </div>
    </div>
    <div class="row">
        <div class="col-25">
            <label for="fmdp2">Confirmez votre mot de passe</label>
        </div>
        <div class="col-75">
            <input type="password" id="fmdp2" name="fmdp2" placeholder="Veuillez confirmer votre mot de passe"
                   pattern="(?=.*?[#?!@$%^&*-])[a-zA-ZÀ-ž0-9\s-]+.{7,}"
                   title="Le mot de passe doit contenir au minimum 8 caractères, dont des lettres en majuscule, miniscule, des chiffres et au moins caractère spécial" required>
        </div>
    </div><br>
    <div class="row">
        <button type="submit">Terminer l'inscription</button>
        <button type="reset">Effacer</button>
    </div>
</div>
</form>
</body>