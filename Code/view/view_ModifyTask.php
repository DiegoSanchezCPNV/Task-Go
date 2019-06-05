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
//formulaire de modification d'une tâche
?>
<h1>Formulaire de modification d'une tâche</h1>

<form method="POST" action="index.php?ModifyTask&date=<?= $date?>&ID=<?= $ligne['id']?>" role="form" id="TaskForm" class="Formulaire">
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
                <label for="fhour">Etat</label>
            </div>
            <div class="col-75">
                <label for="cat">Catégorie :</label>
                <select class="form-control" name="fcat" id="cat" required>
                    <option value="1" id="1" <?php if(@$ligne['id_State'] == 1){echo "selected";} ?> >En cours</option>
                    <option value="2" id="2" <?php if(@$ligne['id_State'] == 2){echo "selected";} ?>>Pas commencé</option>
                    <option value="3" id="3" <?php if(@$ligne['id_State'] == 3){echo "selected";} ?>>Terminé</option>
                </select>
            </div>
        </div><br>
        <div class="row">
            <button type="submit">Terminer la modification</button>
        </div>
    </div>
</form>
</body>
