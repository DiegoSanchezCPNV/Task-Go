<?php
/**
 * Created by PhpStorm.
 * User: Diego.SANCHEZ
 * Date: mai-juin 2019
 */
require_once('template.php');
//Affichage de mes tâches et rendez-vous à venir depuis la bdd
?>

<h1>Mes tâches et rendez-vous à venir</h1>
<table class="Table">
    <tr class="TableName">
        <?php
        //Affichage des rendez-vous depuis le résultat de la bdd
        for ($i = 1; $i < @$resultatsMeet->columnCount()-1; $i++)
        {
            $entete = @$resultatsMeet->getColumnMeta($i);
            echo "<th>" . $entete['name'] . "</th>";
        }
        ?>
    </tr>
    <?php foreach (@$resultatsMeet as $resultat) :
        $date = date("Y-m-d h:i:s");
        if($resultat['Date'] >= $date){?>
        <!-- Affichage des résultats de la BD -->
        <tr class="TableTR">
            <td><?= mb_strimwidth($resultat['Description'],0,40,"...")?></td>
            <td><?=$resultat['Date'];?></td>
            <td><?=$resultat['Durée'];?></td>
            <td><?=$resultat['Lieu'];?></td>
            <td><?= mb_strimwidth($resultat['Commentaire'],0,40, "...");?></td>
        </tr>
    <?php } endforeach;   ?>

</table><br>
<table class="Table">
    <tr class="TableName">
        <?php
        //Affichage des tâches depuis le résultat de la bdd
        for ($i = 1; $i < @$resultatstask->columnCount(); $i++)
        {
            $entete = @$resultatstask->getColumnMeta($i);
            echo "<th>" . $entete['name'] . "</th>";
        }
        ?>
    </tr>
    <?php foreach (@$resultatstask as $resultat) :
    $date = date("Y-m-d h:i:s");
    if($resultat['Date'] >= $date){?>
        <!-- Affichage des résultats de la BD -->
        <tr class="TableTR">
            <td><?=mb_strimwidth($resultat['Description'],0,40,"...")?></td>
            <td><?=$resultat['Date'];?></td>
            <td><?=$resultat['Propriétaire'];?></td>
            <td><?=$resultat['Etat'];?></td>
        </tr>
    <?php  } endforeach;    ?>

</table>