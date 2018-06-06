<?php //echo "ClanTima";
 //var_dump($petPotpisivanja);
 echo "<br />";
 //var_dump($petIsticanja);
 
 $danasnjiDatum = mdate('%Y-%m-%d %H:%i:%s', now());

?>

<table class="table table-bordered">

            <th colspan="4"><?php echo "Kompanije sa najskorije potpisanim ugovorima: <br/><br/>"; ?></th>
            <tr><td>Naziv Kompanije</td><td>Datum isticanja</td><td>Datum potpisivanja</td><td>Tip ugovora</td></tr>
            <?php
            foreach ($petPotpisivanja as $value) {
                    echo "<tr><td>" . $value['naziv'] . "</td><td>" . $value['datum_isticanja'] . "</td><td>" . $value['datum_potpisivanja'] . "</td><td>" . $value['tip'] . "</td></tr>";
                }
            
            ?>
        </table>

<table class="table table-bordered">
    
            <th colspan="4"><?php echo "Kompanije sa ugovorima koji isticu: <br/><br/>"; ?></th>
            <tr><td>Naziv Kompanije</td><td>Datum isticanja</td><td>Datum potpisivanja</td><td>Tip ugovora</td></tr>
            <?php
            foreach ($petIsticanja as $value) {
                
                    echo "<tr><td>" . $value['naziv'] . "</td><td>" . $value['datum_isticanja'] . "</td><td>" . $value['datum_potpisivanja'] . "</td><td>" . $value['tip'] . "</td></tr>";
                
            }
            ?>
        </table>