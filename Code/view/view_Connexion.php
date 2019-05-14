<?php
/**
 * Created by PhpStorm.
 * User: Diego.SANCHEZ
 * Date: 14.05.2019
 * Time: 14:14
 */
require_once('template.php');
?>

<h1>Connexion</h1>
<?php if(@$_GET['erreur']==2){ ?><font color="#FF0000">Les deux mot de passe ne sont pas compatible</font><?php unset($_GET['erreur']);} ?>
<?php if(@$_GET['erreur']==1){ ?><font color="#FF0000">cette adresse mail est déjà utilisée</font><?php unset($_GET['erreur']);} ?>
<?php if(@$_GET['erreur']==3){ ?><font color="#FF0000">Veuillez vous créer un compte</font><?php unset($_GET['erreur']);} ?>
<?php if(@$_GET['erreur']==4){ ?><font color="#FF0000">Connexion OK</font><?php unset($_GET['erreur']);} ?>
<form method="POST" action="index.php?connexion" role="form" id="connexionForm" class="Formulaire">
    <div class="container">
        <div class="row">
            <div class="col-25">
                <label for="femail">Email</label>
            </div>
            <div class="col-75">
                <input type="text" id="femail" name="femail" placeholder="Veuillez entrer votre email">
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="fmdp">Mot de passe</label>
            </div>
            <div class="col-75">
                <input type="text" id="fmdp" name="fmdp" placeholder="Veuillez entrer votre mot de passe">
            </div>
        </div><br>
        <div class="row">
            <button type="submit">Connexion</button>
            <button type="reset">Effacer</button>
        </div>
    </div>
</form>
</body>

