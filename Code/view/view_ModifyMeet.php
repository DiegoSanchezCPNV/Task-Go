<?php
/**
 * Created by PhpStorm.
 * User: Diego.SANCHEZ
 * Date: mai-juin 2019
 */
require_once('template.php');
$ligne = $resultats->fetch();

$time =  substr($ligne['hour'], -8, 8); // retourne que l'heure du meeting
$date = substr($ligne['hour'],0,10);
//formulaire de modification d'un rendez-vous
?>

<h1>Formulaire de modification d'un rendez-vous</h1>

<form method="POST" action="index.php?ModifyMeet&date=<?= $date?>&ID=<?= $ligne['id']?>" role="form" id="MeetForm" class="Formulaire">
    <div class="container">
        <div class="row">
            <div class="col-25">
                <label for="fdesc">Description</label>
            </div>
            <div class="col-75">
                <textarea rows="6" maxlength="100" cols="50" id="fdesc" name="fdesc" placeholder="Veuillez entrer une description" pattern="[a-zA-ZÀ-ž\s-]+"
                          title="Veuillez indiquer que des lettres dans ce champ" required><?=@$ligne['description']; ?></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="fhour">Heure</label>
            </div>
            <div class="col-75">
                <input type="time" id="ftime" name="ftime" value="<?=@$time; ?>" required>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="fterm">Temps du meeting</label>
            </div>
            <div class="col-75">
                <input type="time" id="fterm" name="fterm" value="<?=@$ligne['term']; ?>" required>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="fplace">Lieu</label>
            </div>
            <div class="col-75">
                <input type="text" maxlength="40" id="fplace" name="fplace" placeholder="Veuillez entrer un lieu" pattern="[a-z0-9A-ZÀ-ž\s-]+"
                       title="Veuillez entrer un lieu" value="<?=@$ligne['place']; ?>" required>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="fcomment">Commentaire</label>
            </div>
            <div class="col-75">
                <textarea rows="6" maxlength="100" cols="50" id="fcomment" name="fcomment" placeholder="Veuillez entrer une description" pattern="[a-zA-ZÀ-ž\s-]+"
                          title="Veuillez indiquer que des lettres dans ce champ" required><?=@$ligne['comment']; ?></textarea>
            </div>
        </div><br>
        <div class="row">
            <button type="submit">Terminer la modification</button>
        </div>
    </div>
</form>
</body>
