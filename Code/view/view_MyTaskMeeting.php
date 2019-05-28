<?php
/**
 * Created by PhpStorm.
 * User: Diego.SANCHEZ
 * Date: 2019
 * Time: 08:41
 */
require_once('template.php');
?>

<h1>Mes tâches et rendez-vous</h1>
<table class="Table">
    <tr class="TableName">
        <?php
        for ($i = 1; $i < @$resultatsMeet->columnCount()-1; $i++)
        {
            $entete = @$resultatsMeet->getColumnMeta($i);
            echo "<th>" . $entete['name'] . "</th>";
        }
        ?>
    </tr>
    <?php foreach (@$resultatsMeet as $resultat) :
        $date = date("Y-m-d h:i:s");
        if($resultat['DateEtHeure'] >= $date){?>
        <!-- Affichage des résultats de la BD -->
        <tr class="TableTR">
            <td><?= mb_strimwidth($resultat['Description'],0,40,"...")?></td>
            <td><?=$resultat['DateEtHeure'];?></td>
            <td><?=$resultat['Durée'];?></td>
            <td><?=$resultat['Lieu'];?></td>
            <td><?= mb_strimwidth($resultat['Commentaire'],0,40, "...");?></td>
        </tr>
    <?php } endforeach;   ?>

</table><br>
<table class="Table">
    <tr class="TableName">
        <?php
        for ($i = 1; $i < @$resultatstask->columnCount(); $i++)
        {
            $entete = @$resultatstask->getColumnMeta($i);
            echo "<th>" . $entete['name'] . "</th>";
        }
        ?>
    </tr>
    <?php foreach (@$resultatstask as $resultat) :
    $date = date("Y-m-d h:i:s");
    if($resultat['DateEtHeure'] >= $date){?>
        <!-- Affichage des résultats de la BD -->
        <tr class="TableTR">
            <td><?=mb_strimwidth($resultat['Description'],0,40,"...")?></td>
            <td><?=$resultat['DateEtHeure'];?></td>
            <td><?=$resultat['Propriétaire'];?></td>
            <td><?=$resultat['Etat'];?></td>
        </tr>
    <?php  } endforeach;    ?>

</table>