<?php
/**
 * Created by PhpStorm.
 * User: Moi
 * Date: mai 2019
 */
require_once('template.php');
?>
<h1>Liste des utilisateurs</h1>
<table class="Table">
    <tr class="TableName">
        <?php
        for ($i = 1; $i < @$resultats->columnCount(); $i++)
        {
                $entete = @$resultats->getColumnMeta($i);
                echo "<th>" . $entete['name'] . "</th>";
        }
        ?>
    </tr>
    <?php foreach (@$resultats as $resultat) :?>
        <!-- Affichage des résultats de la BD -->
        <tr class="TableTR">
            <td><?=$resultat['Prénom']?></td>
            <td><?=$resultat['Nom'];?></td>
            <td><?=$resultat['email'];?></td>
            <td><?=$resultat['CompteActif'];?></td>
            <td>
                <a href="index.php?DeleteUser&ID=<?=$resultat['id'];?>"><img src="/image/delete.png" width="15px" height="15px"></a>
            </td>
        </tr>
    <?php    endforeach;    ?>

</table>