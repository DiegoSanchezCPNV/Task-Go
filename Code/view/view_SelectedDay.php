<?php
/**
 * Created by PhpStorm.
 * User: Diego.SANCHEZ
 * Date: 2019
 * Time: 08:41
 */
require_once('template.php');
extract($_GET);

      if(strpos($day, '*') !== false)
       {
           //1) supprimer l'étoile du string
           $day = str_replace("*","", $day);

           //2) Si plus grand que 20 faire mois -1
           if($day > 20)
           {
               $month = $month-1;
               echo "<h1>$day.$month.$year</h1>";
           }
           else
           {
               $month = $month+1;
               echo "<h1>$day.$month.$year</h1>";
           }
           //3) Si plus petit que 20 faire mois + 1

           echo 'il contient';
           echo $day;
       }
       else
       {
           echo 'il contient pas';
           if($day <10)
           {
               if($month <10)
               {
                   echo "<h1>0$day.0$month.$year</h1>";
               }
               else
               {
                   echo "<h1>0$day.$month.$year</h1>";
               }
           }
           else
           {
               if($month <10)
               {
                   echo "<h1>$day.0$month.$year</h1>";
               }
               else
               {
                   echo "<h1>$day.$month.$year</h1>";
               }
           }

       }
?>


