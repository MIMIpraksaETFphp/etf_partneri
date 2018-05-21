<?php
//echo mdate('%Y-%m-%d %H:%i:%s', now())."<br>";
echo "<br/><br/>Spisak predavanja na Elektrotehnickom fakultetu u Beogradu:<br/><br/><br/>";

foreach ($predavanja as $predavanje) {
    $datum=mdate('%Y-%m-%d %H:%i:%s', now());
    if($datum<$predavanje['vreme_predavanja']){
    echo "<h3><br/>" . $predavanje['naslov_srpski'] . "</h3><a href=" . site_url($kontroler.'/predavanjeDetaljnije/'.$predavanje['idpredavanje']) . ">Detaljnije</a><br/>";
    echo "Opis predavanja:<br/>" . $predavanje['opis_srpski'] . "<br/>";
    echo "Sala:" . $predavanje['sala'] . "<br/>";
    echo "Vreme predavanja:" . $predavanje['vreme_predavanja'] . "<br/>";
    echo "Ime predavaca:" . $predavanje['ime_predavaca'] . "<br/>";
    echo "Prezime predavaca:" . $predavanje['prezime_predavaca'] . "<br/>";
    echo "Biografija predavaca:<br/>" . $predavanje['cv_srpski'] . "<br/>";
    echo "<br/><br/><br/>";
    }
}
?>
        <a href="<?php echo site_url($kontroler.'/arhiva/');?>">Arhiva</a>
        <?php
//        echo "<a href=\"".site_url("$kontroler/arhiva")."\">arhiva</a>";
            ?>