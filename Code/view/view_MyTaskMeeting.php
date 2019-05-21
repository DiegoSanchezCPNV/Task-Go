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
    <?php foreach (@$resultatsMeet as $resultat) :?>
        <!-- Affichage des résultats de la BD -->
        <tr class="TableTR">
            <td><?=$resultat['Description']?></td>
            <td><?=$resultat['DateEtHeure'];?></td>
            <td><?=$resultat['Durée'];?></td>
            <td><?=$resultat['Lieu'];?></td>
            <td><?=$resultat['Commentaire'];?></td>
        </tr>
    <?php    endforeach;    ?>

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
    <?php foreach (@$resultatstask as $resultat) :?>
        <!-- Affichage des résultats de la BD -->
        <tr class="TableTR">
            <td><?=$resultat['description']?></td>
            <td><?=$resultat['hour'];?></td>
            <td><?=$resultat['id_Task_User'];?></td>
            <td><?=$resultat['id_State'];?></td>
        </tr>
    <?php    endforeach;    ?>

</table>