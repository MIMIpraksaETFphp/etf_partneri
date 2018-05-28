<?php
//echo mdate('%Y-%m-%d %H:%i:%s', now())."<br>";
//echo "<br/><br/>Spisak predavanja na Elektrotehnickom fakultetu u Beogradu:";

//foreach ($predavanja as $predavanje) {
//    $datum=mdate('%Y-%m-%d %H:%i:%s', now());
//    if($datum<$predavanje['vreme_predavanja']){
//    echo "<h3><br/>" . $predavanje['naslov_srpski'] . "</h3><a href=" . site_url($kontroler.'/predavanjeDetaljnije/'.$predavanje['idpredavanje']) . ">Detaljnije</a><br/>";
//    echo "Opis predavanja:<br/>" . $predavanje['opis_srpski'] . "<br/>";
//    echo "Sala:" . $predavanje['sala'] . "<br/>";
//    echo "Vreme predavanja:" . $predavanje['vreme_predavanja'] . "<br/>";
//    echo "Ime predavaca:" . $predavanje['ime_predavaca'] . "<br/>";
//    echo "Prezime predavaca:" . $predavanje['prezime_predavaca'] . "<br/>";
//    echo "Biografija predavaca:<br/>" . $predavanje['cv_srpski'] . "<br/>";
//    echo "<br/><br/><br/>";
//    }
//}
//?>

        <?php
//        echo "<a href=\"".site_url("$kontroler/arhiva")."\">arhiva</a>";
            ?>

<br/>
<h3>Spisak predavanja na Elektrotehnickom fakultetu u Beogradu:</h3>
<table class="table table-striped ">
    <?php
    foreach ($predavanja as $predavanje) {
        $datum = mdate('%Y-%m-%d %H:%i:%s', now());
        if ($datum < $predavanje['vreme_predavanja']) {
            ?>
            <tbody>
            <th colspan="2"><?php echo $predavanje['naslov_srpski'] . "<a href=" . site_url($kontroler . '/predavanjeDetaljnije/' . $predavanje['idpredavanje']) . "> <br/>Detaljnije</a><br/>"; ?></th>
            <tr>
                <td>Opis predavanja</td>
                <td><?php echo $predavanje['opis_srpski']; ?></td>
            </tr>
            <tr>
                <td>Ime predavaca</td>
                <td><?php echo $predavanje['ime_predavaca']; ?></td>
            </tr>
            <tr>
                <td>Prezime predavaca</td>
                <td><?php echo $predavanje['prezime_predavaca']; ?></td>
            </tr>
            <tr>
                <td>Sala</td>
                <td><?php echo $predavanje['sala']; ?></td>
            </tr>
            <tr>
                <td>Vreme predavanja</td>
                <td><?php echo $predavanje['vreme_predavanja']; ?></td>
            </tr>
            <tr>
                <td>Biografija predavaca</td>
                <td><?php echo $predavanje['cv_srpski']; ?></td>
            </tr>
            <br/>
        </tbody>

    <?php
    }
}
?>
</table>

<a href="<?php echo site_url($kontroler . '/arhiva/'); ?>"><h3>Arhiva</h3></a>