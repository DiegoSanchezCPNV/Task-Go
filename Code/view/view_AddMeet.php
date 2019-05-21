<?php
/**
 * Created by PhpStorm.
 * User: Diego.SANCHEZ
 * Date: Mai 2019
 */
require_once('template.php');

$date = $_GET['date'];
?>

<h1>Formulaire d'ajout d'un rendez-vous</h1>

<form method="POST" action="index.php?addMeet&date=<?= $date?>" role="form" id="MeetForm" class="Formulaire">
    <div class="container">
        <div class="row">
            <div class="col-25">
                <label for="fdesc">Description</label>
            </div>
            <div class="col-75">
                <textarea rows="6" maxlength="100" cols="50" id="fdesc" name="fdesc" placeholder="Veuillez entrer une description" pattern="[a-zA-ZÀ-ž\s-]+" title="Veuillez indiquer que des lettres dans ce champ" required></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="fhour">Heure</label>
            </div>
            <div class="col-75">
                <input type="time" id="ftime" name="ftime" required>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="fterm">Temps du meeting</label>
            </div>
            <div class="col-75">
                <input type="time" id="fterm" name="fterm" required>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="fplace">Lieu</label>
            </div>
            <div class="col-75">
                <input type="text" maxlength="40" id="fplace" name="fplace" placeholder="Veuillez entrer un lieu" pattern="[a-z0-9A-ZÀ-ž\s-]+" title="Veuillez entrer un lieu" required>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="fcomment">Commentaire</label>
            </div>
            <div class="col-75">
                <textarea rows="6" maxlength="100" cols="50" id="fcomment" name="fcomment" placeholder="Veuillez entrer une description" pattern="[a-zA-ZÀ-ž\s-]+" title="Veuillez indiquer que des lettres dans ce champ" required></textarea>
            </div>
        </div><br>
        <div class="row">
            <button type="submit">Terminer l'ajout</button>
            <button type="reset">Effacer</button>
        </div>
    </div>
</form>
</body>
