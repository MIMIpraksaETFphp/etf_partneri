<?php
    $datum = date("Y-m-d H:i:s", strtotime("+6 months"));
    $datum2 = date("Y-m-d H:i:s", strtotime("-6 months"));
    $danasnjiDatum = mdate('%Y-%m-%d %H:%i:%s', now());
    foreach ($partnerIsticeUgovor as $value) {

        if (($value['datum_isticanja'] < $datum) && $value['datum_isticanja'] > $danasnjiDatum) {
            echo "<table><tr><td><a href=" . site_url('ITmenadzer/dosije/' . $value['naziv']) . ">Dosije Kompanije</a>" . $value['naziv'] . "</td><td>" . $value['datum_isticanja'] . "</td></tr>";
            echo "</table>";
        }
    }
?>

    <body>
        <hr>
    </body>

<?php
    foreach ($partnerIsticeUgovor as $value) {
        //if(($value['datum_isticanja']>$datum2) && $value['datum_isticanja']<$danasnjiDatum){
        echo "<table><tr><td><a href=" . site_url('ITmenadzer/dosije/' . $value['naziv']) . ">Dosije Kompanije</a>" . $value['naziv'] . "</td><td>" . $value['datum_isticanja'] . "</td><td>LINK ZA MAIL</td></tr>";
        echo "</table>";
        //}
    }
?>
    <body>
        <hr>
    </body>
            <a href="<?php echo site_url($kontroler.'/predavanja/');?>">Sva predavanja</a>
<?php
    
    foreach ($iscitajPredavanje as $value) {
        if($danasnjiDatum<$value['vreme_predavanja']){
            echo "<table>";
            echo "<tr><td>" . $value['naslov_srpski'] . "</td><td>" . $value['vreme_predavanja'] . "</td><td>" . $value['sala'] . "</td></tr>";
            echo "</table>";
        }
    }
?>
    <body>
        <hr>
    </body>
<?php 
    foreach ($iscitajOglas as $value) {
        //if($danasnjiDatum<$value['vreme_predavanja']){
            echo "<table>";
            echo "<tr><td><a href=" . site_url($kontroler.'/oglasi/') . ">".$value['naziv']."</a>". "</td><td>" . $value['datum_unosenja'] . "</td></tr>";
            echo "</table>";
        //}
    }
?>