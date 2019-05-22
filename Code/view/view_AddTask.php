<?php
/**
 * Created by PhpStorm.
 * User: Diego.SANCHEZ
 * Date: Mai 2019
 */
require_once('template.php');
$date = $_GET['date'];
?>

<h1>Formulaire d'ajout d'une tâche</h1>

<form method="POST" action="index.php?addTask&date=<?= $date?>" role="form" id="TaskForm" class="Formulaire">
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
        </div><br>
        <div class="row">
            <button type="submit">Terminer l'ajout</button>
            <button type="reset">Effacer</button>
        </div>
    </div>
</form>
</body>