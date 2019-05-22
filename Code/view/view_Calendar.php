<?php
/**
 * Created by PhpStorm.
 * User: Diego.SANCHEZ
 * Date: Mai 2019
 */
require_once('template.php');
?>

<h1>Calendrier</h1>

<?php
//https://codes-sources.commentcamarche.net/source/42671-calendrier-simple-facilement-modifiable-affichage-complet
// Récuperation des variables passées, on donne soit année; mois; année+mois
if(!isset($_GET['jour'])) $num_jour = date("j"); else $num_jour = $_GET['jour'];
if(!isset($_GET['mois'])) $num_mois = date("n"); else $num_mois = $_GET['mois'];
if(!isset($_GET['annee'])) $num_an = date("Y"); else $num_an = $_GET['annee'];

// pour pas s'embeter a les calculer a l'affchage des fleches de navigation...
if($num_mois < 1) { $num_mois = 12; $num_an = $num_an - 1; }
elseif($num_mois > 12) {	$num_mois = 1; $num_an = $num_an + 1; }

// nombre de jours dans le mois et numero du premier jour du mois
$int_nbj = date("t", mktime(0,0,0,$num_mois,1,$num_an));
$int_premj = date("w",mktime(0,0,0,$num_mois,1,$num_an));

// tableau des jours, tableau des mois...
$tab_jours = array("","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche");
$tab_mois = array("","Janvier","Fevrier","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Decembre");

$int_nbjAV = date("t", mktime(0,0,0,($num_mois-1<1)?12:$num_mois-1,1,$num_an)); // nb de jours du moi d'avant
$int_nbjAP = date("t", mktime(0,0,0,($num_mois+1>12)?1:$num_mois+1,1,$num_an)); // b de jours du mois d'apres

// on affiche les jours du mois et aussi les jours du mois avant/apres, on les indique par une * a l'affichage on modifie l'apparence des chiffres *
$tab_cal = array(array(),array(),array(),array(),array(),array()); // tab_cal[Semaine][Jour de la semaine]
$int_premj = ($int_premj == 0)?7:$int_premj;
$t = 1; $p = "";
for($i=0;$i<6;$i++) {
    for($j=0;$j<7;$j++) {
        if($j+1 == $int_premj && $t == 1) { $tab_cal[$i][$j] = $t; $t++; } // on stocke le premier jour du mois
        elseif($t > 1 && $t <= $int_nbj) { $tab_cal[$i][$j] = $p.$t; $t++; } // on incremente a chaque fois...
        elseif($t > $int_nbj) { $p="*"; $tab_cal[$i][$j] = $p."1"; $t = 2; } // on a mis tout les numeros de ce mois, on commence a mettre ceux du suivant
        elseif($t == 1) { $tab_cal[$i][$j] = "*".($int_nbjAV-($int_premj-($j+1))+1); } // on a pas encore mis les num du mois, on met ceux de celui d'avant
    }
}
$_SESSION['test']=1;

//$key = array_search($num_jour, $tab_cal);
//var_dump($key);


$GLOBALS['a']= 3;
$GLOBALS['b']=4;
/*
if(in_array($num_jour, $tab_cal))
{
    $GLOBALS['a']= 1;
    $GLOBALS['b']=2;
}
else
{
    $GLOBALS['a']= 3;
    $GLOBALS['b']=4;
}*/


//Affichage Mois
if($_SESSION['test'] == 1)
    {
        ?>




<table class="containerCalendar">
    <tr><td colspan="7" align="center"><a href="index.php?calendar&mois=<?php echo $num_mois-1; ?>&amp;annee=<?php echo $num_an; ?>"><img src="image/ArrowLeft.png" width="15px" height="15px"></a>&nbsp;&nbsp;<?php echo $tab_mois[$num_mois];  ?>&nbsp;&nbsp;<a href="index.php?calendar&mois=<?php echo $num_mois+1; ?>&amp;annee=<?php echo $num_an; ?>"><img src="image/ArrowRight.png"  width="15px" height="15px"></a></td></tr>
    <tr><td colspan="7" align="center"><a href="index.php?calendar&mois=<?php echo $num_mois; ?>&amp;annee=<?php echo $num_an-1; ?>"><img src="image/ArrowLeft.png"  width="15px" height="15px"></a>&nbsp;&nbsp<?php echo $num_an;  ?>&nbsp;&nbsp;<a href="index.php?calendar&mois=<?php echo $num_mois; ?>&amp;annee=<?php echo $num_an+1; ?>"><img src="image/ArrowRight.png"  width="15px" height="15px"></a></td></tr>
    <?php
    echo'<tr>';
    for($i = 1; $i <= 7; $i++){
        echo('<td>'.$tab_jours[$i].'</td>');
    }
    echo'</tr>';

    for($i=0;$i<6;$i++) {
        //<a href="index.php?SelectedDay"></a>
        /*
         *  echo "<td ".(($num_mois == date("n") && $num_an == date("Y") && $tab_cal[$i][$j] == date("j"))?' class="TodayDate"':null).">
                <div class='DayCurrentMonth'>".((strpos($tab_cal[$i][$j],"*")!==false)?str_replace("*","",$tab_cal[$i][$j]).'</div>':$tab_cal[$i][$j])."</td>";
         */
        echo "<tr class='DayCalendar'>";
        for($j=0;$j<7;$j++)
        {
            $DayWanted = $tab_cal[$i][$j];
            $monthWanted = $num_mois;
            $yearWanted = $num_an;

            echo "<td ".(($num_mois == date("n") && $num_an == date("Y") && $tab_cal[$i][$j] == date("j"))?' class="TodayDate"':null).">
                <a class='DayCurrentMonth' href='index.php?SelectedDay&day=$DayWanted&month=$monthWanted&year=$yearWanted'>".((strpos($tab_cal[$i][$j],"*")!==false)?str_replace("*","",$tab_cal[$i][$j]).'</a>':$tab_cal[$i][$j])."</td>";
            //echo  $tab_cal[0][0];
            //$_SESSION['DayWanted'] = $DayWanted;
        }
        echo "</tr>";
    }
    echo "</table>";
 }
//Affichage Semaine
else if($_SESSION['test'] == 0)
{



    ?>
<table class="containerCalendar">
    <tr><td colspan="7" align="center">
            <a href="index.php?calendar&jours=<?php echo $GLOBALS['a']--; $GLOBALS['b']--; ?>&amp;annee=<?php echo $num_an; ?>"><img src="image/ArrowLeft.png" width="15px" height="15px">
                </a>&nbsp;&nbsp;<?php echo "Semaine"  ?>&nbsp;&nbsp;
            <a href="index.php?calendar&jours=<?php echo $GLOBALS['a']= $GLOBALS['a'] +1; echo " - "; echo $GLOBALS['b']++;   ?>&amp;annee=<?php echo $num_an; ?>"><img src="image/ArrowRight.png"  width="15px" height="15px"></a></td></tr>
    <?php
    var_dump($num_jour);
    var_dump($GLOBALS['a']);

    echo'<tr>';
    for($i = 1; $i <= 7; $i++){
        echo('<td>'.$tab_jours[$i].'</td>');
    }
    echo'</tr>';


    for($i=$GLOBALS['a'];$i<$GLOBALS['b'];$i++) {

        echo "<tr class='DayCalendar'>";
        for($j=0;$j<7;$j++)
        {
            $DayWanted = $tab_cal[$i][$j];
            $monthWanted = $num_mois;
            $yearWanted = $num_an;

            /*$first = reset($tab_cal);
            $last = end($tab_cal);

            var_dump($tab_cal);*/




            // tab_cal[Semaine][Jour de la semaine]

            echo "<td ".(($num_mois == date("n") && $num_an == date("Y") && $tab_cal[$i][$j] == date("j"))?' class="TodayDate"':null).">
                <a class='DayCurrentMonth' href='index.php?SelectedDay&day=$DayWanted&month=$monthWanted&year=$yearWanted'>".((strpos($tab_cal[$i][$j],"*")!==false)?str_replace("*","",$tab_cal[$i][$j]).'</a>':$tab_cal[$i][$j])."</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}
?>



