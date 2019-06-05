<?php
/**
 * Created by PhpStorm.
 * User: Diego.SANCHEZ
 * Date: mai-juin 2019
 */
require_once('template.php');
extract($_GET);

        //Si la variable du jour contient une *
      if(strpos($day, '*') !== false)
       {
           //1) supprimer l'étoile du string
           $day = str_replace("*","", $day);

           //2) Si plus grand que 20 faire mois -1
           if($day > 20)
           {
               //Si on est au mois de janvier
               if($month==1)
               {
                   $month = 12;
                   $year = $year -1;
                   echo "<h1>$day.$month.$year</h1>";

               }
               //si le mois est inférieur ou egal à 9 rajoute un 0 pour l'affichage du mois
               else if($month <= 9)
               {
                   $month = $month-1;
                   echo "<h1>$day.0$month.$year</h1>";
                   $month = "0".$month;

               }
               else
               {
                   $month = $month-1;
                   echo "<h1>$day.$month.$year</h1>";

               }
           }
           else
           {
               if($month == 12)
               {
                   $month = 1;
                   $year = $year +1;
                   echo "<h1>0$day.0$month.$year</h1>";
                   $day = "0".$day;
                   $month = "0".$month;
                   $GLOBALS['$day'] = $day;
                   $GLOBALS['$month'] = $month;
                   $GLOBALS['$year']= $year;
               }
               else if($month > 0 && $month <= 8)
               {
                   $month = $month+1;
                   echo "<h1>0$day.0$month.$year</h1>";
                   $day = "0".$day;
                   $month = "0".$month;
                   $GLOBALS['$day'] = $day;
                   $GLOBALS['$month'] = $month;
                   $GLOBALS['$year']= $year;
               }
               else if ($month == 9)
               {
                   $month = $month+1;
                   echo "<h1>0$day.$month.$year</h1>";
                   $day = "0".$day;
                   $GLOBALS['$day'] = $day;
                   $GLOBALS['$month'] = $month;
                   $GLOBALS['$year']= $year;
               }
               else if ($month > 9 && $month <=11)
               {
                   $month = $month+1;
                   echo "<h1>0$day.$month.$year</h1>";
                   $day = "0".$day;
                   $GLOBALS['$day'] = $day;
                   $GLOBALS['$month'] = $month;
                   $GLOBALS['$year']= $year;
               }
           }
       }
       else
       {
           //Si contient pas de *
           if($day <10)
           {
               if($month <10)
               {
                   echo "<h1>0$day.0$month.$year</h1>";
                   $day = "0".$day;
                   $month = "0".$month;
                   $_SESSION['$day'] = $day;
                   $_SESSION['$month'] = $month;
                   $_SESSION['$year']= $year;
               }
               else
               {
                   echo "<h1>0$day.$month.$year</h1>";
                   $day = "0".$day;
                   $GLOBALS['$day'] = $day;
                   $GLOBALS['$month'] = $month;
                   $GLOBALS['$year']= $year;
               }
           }
           else
           {
               if($month <10)
               {
                   echo "<h1>$day.0$month.$year</h1>";
                   $month = "0".$month;
                   $GLOBALS['$day'] = $day;
                   $GLOBALS['$month'] = $month;
                   $GLOBALS['$year']= $year;
               }
               else
               {
                   echo "<h1>$day.$month.$year</h1>";
                   $GLOBALS['$day'] = $day;
                   $GLOBALS['$month'] = $month;
                   $GLOBALS['$year']= $year;
               }
           }
       }


$date = $_GET['year']."-".$_GET['month']."-".$_GET['day'];
?>

<h1>Rendez-vous&nbsp<a href="?addMeetForm&date=<?= $date?>"><img class="Image" src="image/add.png"></a></h1>
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
            <td><?=mb_strimwidth($resultat['Description'],0,40,"...")?></td>
            <td><?=$resultat['Date'];?></td>
            <td><?=$resultat['Durée'];?></td>
            <td><?=$resultat['Lieu'];?></td>
            <td><?=mb_strimwidth($resultat['Commentaire'],0,40,"...");?></td>
            <td>
                <a href="index.php?ModifyMeet&ID=<?=$resultat['id'];?>"><img src="/image/modify.png" width="15px" height="15px"></a>
            </td>
            <td>
                <a href="index.php?DeleteMeet&ID=<?=$resultat['id'];?>"><img src="/image/delete.png" width="15px" height="15px"></a>
            </td>
        </tr>
    <?php    endforeach;    ?>

</table>


<h1>Tâches&nbsp<a href="?addTaskForm&date=<?= $date?>""><img class="Image" src="image/add.png"></a></h1>
<table class="Table">
    <tr class="TableName">
        <?php
            for ($i = 1; $i < @$resultatsTask->columnCount(); $i++)
            {
                $entete = @$resultatsTask->getColumnMeta($i);
                echo "<th>" . $entete['name'] . "</th>";
            }
        ?>
    </tr>
    <?php foreach (@$resultatsTask as $resultat) :?>
        <!-- Affichage des résultats de la BD -->
        <tr class="TableTR">
            <td><?=mb_strimwidth($resultat['Description'],0,40,"...")?></td>
            <td><?=$resultat['Date'];?></td>
            <td><?=$resultat['Propriétaire'];?></td>
            <td><?=$resultat['Etat'];?></td>
            <td>
                <a href="index.php?ModifyTask&ID=<?=$resultat['id'];?>"><img src="/image/modify.png" width="15px" height="15px"></a>
            </td>
            <td>
                <a href="index.php?DeleteTask&ID=<?=$resultat['id'];?>"><img src="/image/delete.png" width="15px" height="15px"></a>
            </td>
        </tr>
    <?php    endforeach;    ?>

</table>

