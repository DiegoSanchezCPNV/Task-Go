<?php
/**
 * Created by PhpStorm.
 * User: Diego.SANCHEZ
 * Date: mai 2019
 */
require_once('template.php');

?>

<h1>Paramétrage</h1>
<form method="POST" action="index.php?settings" role="form" id="inscriptionForm" class="Formulaire">
    <div class="container">
        <div class="row">
            <div class="col-40">
                <label for="fnumber" class="TextTooLong">Nombre de tâches et de rendez-vous à afficher</label>
            </div>
            <div class="col-60">
                <input type="number" id="fnumber" name="fnumber" min="1" max="100" pattern="[0-9]+" title="Veuillez indiquer que des chiffres dans ce champ" required>
            </div>
        </div><br>
        <div class="row">
            <div class="col-40">
                <label for="fvue" class="TextTooLong">Vue par défaut à l'ouverture du site</label>
            </div>
            <div class="col-60">
                <div class="radio"><input type="radio" name="fchoixVue" value="1" required>Mois</div>
                <div class="radio"><input type="radio" name="fchoixVue" value="2">Semaine</div>
                <div class="radio"><input type="radio" name="fchoixVue" value="3" >Jour</div>
            </div>
        </div><br>
        <div class="row">
            <div class="col-40">
                <label for="fmail">Choix d'un email de rappel</label>
            </div>
            <div class="col-60">
                <input class="radio" type="radio" id="fchoixOui" name="fchoix" value="1" required>Oui
                <input class="radio" type="radio" id="fchoixNon" name="fchoix" value="0">Non<br>
                <label for="fmail">Durée avant rappel</label>
                <div class="reveal-if-active">
                <input type="number"  width="30px" id="fnumber" name="fnumberRappel" min="1" max="120" pattern="[0-9]+"
                       placeholder="En minutes" title="Veuillez indiquer que des chiffres dans ce champ" required><br>
                </div></div>
        </div><br>
    <div class="row">
            <button type="submit">valider les changements</button>
        </div>
    </div>
</form>
</body>