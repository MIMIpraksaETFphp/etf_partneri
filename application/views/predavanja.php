<br /> 
<h3>Spisak predavanja na Elektrotehničkom fakultetu u Beogradu:</h3>
    <br/>
    <?php
    foreach ($predavanja as $predavanje) {
        $datum = mdate('%Y-%m-%d %H:%i:%s', now());
        if ($datum < $predavanje['vreme_predavanja']) {
            ?>
<table class="table table-striped table-bordered">
            <th colspan="2"><?php echo $predavanje['naslov_srpski'] . "<a href=" . site_url($kontroler . '/predavanjeDetaljnije/' . $predavanje['idpredavanje']) . "> <br/>Detaljnije</a><br/>"; ?></th>
<!--            <tr>
                <td>Opis predavanja</td>
                <td><?php //echo $predavanje['opis_srpski']; ?></td>
            </tr>-->
            <tr>
                <td>Predavač</td>
                <td><?php echo $predavanje['ime_predavaca']." ".$predavanje['prezime_predavaca']; ?></td>
            </tr>
            <tr>
                <td>Sala</td>
                <td><?php echo $predavanje['sala']; ?></td>
            </tr>
            <tr>
                <td>Vreme predavanja</td>
                <td><?php echo $predavanje['vreme_predavanja']; ?></td>
            </tr>
                     </table>
                <br/>     
    <?php
    }
}
?>


<a href="<?php echo site_url($kontroler . '/arhiva/'); ?>"><h3>Arhiva</h3></a>