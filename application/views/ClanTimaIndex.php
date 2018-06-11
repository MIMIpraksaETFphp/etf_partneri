<?php 
// var_dump($petPotpisivanja);
echo "<br />";
// var_dump($petIsticanja);
// echo "<br />";   
//  var_dump($clanoviUgovor);
 $danasnjiDatum = mdate('%Y-%m-%d %H:%i:%s', now());

?>

<table class="table table-bordered">

            <th colspan="4"><?php echo "Kompanije sa najskorije potpisanim ugovorima: <br/><br/>"; ?></th>
            <tr><td>Naziv Kompanije</td><td>Datum isticanja</td><td>Datum potpisivanja</td><td>Tip ugovora</td></tr>
            <?php
            foreach ($petPotpisivanja as $ugovor) {
                $i=0;
                foreach ($clanoviUgovor as $clanUgovor){
                    if ($ugovor['idugovor'] == $clanUgovor['idugovor']){
                        //echo "<tr><td><font color='red'>" . $ugovor['naziv'] . "</font></td><td>" . $ugovor['datum_isticanja'] . "</td><td>" . $ugovor['datum_potpisivanja'] . "</td><td>" . $ugovor['tip'] . "</td></tr>";
                        //break;
                        $i+=1;
                    } 
                }
                    if($i>0){
                        echo "<tr><td><font color='red'>" . $ugovor['naziv'] . "</font></td><td>" . $ugovor['datum_isticanja'] . "</td><td>" . $ugovor['datum_potpisivanja'] . "</td><td>" . $ugovor['tip'] . "</td></tr>";                        
                    } else{
                        echo "<tr><td>" . $ugovor['naziv'] . "</td><td>" . $ugovor['datum_isticanja'] . "</td><td>" . $ugovor['datum_potpisivanja'] . "</td><td>" . $ugovor['tip'] . "</td></tr>";
                    }
                }
            ?>
        </table>

<table class="table table-bordered">
    
            <th colspan="4"><?php echo "Kompanije sa ugovorima koji uskoro ističu: <br/><br/>"; ?></th>
            <tr><td>Naziv Kompanije</td><td>Datum isticanja</td><td>Datum potpisivanja</td><td>Tip ugovora</td></tr>
            <?php
            foreach ($petIsticanja as $ugovor) {
                $i=0;
                foreach ($clanoviUgovor as $clanUgovor){
                    if ($ugovor['idugovor'] == $clanUgovor['idugovor']){
                        $i+=1;
                    } 
                }
                    if($i>0){
                        echo "<tr><td><font color='red'>" . $ugovor['naziv'] . "</font></td><td>" . $ugovor['datum_isticanja'] . "</td><td>" . $ugovor['datum_potpisivanja'] . "</td><td>" . $ugovor['tip'] . "</td></tr>";                        
                    } else{
                        echo "<tr><td>" . $ugovor['naziv'] . "</td><td>" . $ugovor['datum_isticanja'] . "</td><td>" . $ugovor['datum_potpisivanja'] . "</td><td>" . $ugovor['tip'] . "</td></tr>";
                    }
                }
            ?>
        </table>