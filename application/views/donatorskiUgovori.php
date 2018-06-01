<?php  $danasnjiDatum = mdate('%Y-%m-%d %H:%i:%s', now());
echo "<br/><h3>Spisak donatorskih ugovora na Elektrotehničkom fakultetu u Beogradu:</h3><br/>"; ?>
<table class="table table-striped table-bordered">
    <?php foreach ($donatorskiUgovori as $dugovor) { ?>
    <?php if($dugovor['idstatus_ugovora']!='6'){
        ?>
        <tr><td colspan="2">
                
                <?php echo "<h3>" . $dugovor['naziv'] . "</h3>"; ?></td></tr>
                <?php
        echo "<tr><td>Tip ugovora:</td><td> " . $dugovor['tip'] . "</td></tr>";
        echo "<tr><td>Datum potpisivanja:</td><td> " . $dugovor['datum_potpisivanja'] . "</td></tr>";
        echo "<tr><td>Datum isticanja:</td><td>"?><?php if($danasnjiDatum>$dugovor['datum_isticanja']){
            echo "<font color='red'>".$dugovor['datum_isticanja']."</font>";
    }else{ 
        echo $dugovor['datum_isticanja'];
    
    } ?></td></tr>
        <?php echo "<tr><td>Paket:</td><td>" . $dugovor['naziv_paketa'] . "</td></tr>";
        echo "<tr><td>Procenjena vrednost:</td><td>" . $dugovor['procenjena_vrednost'] . "</td></tr>";
        echo "<tr><td>Valuta:</td><td>" . $dugovor['valuta'] . "</td></tr>";
        ?>
        <tr>
            <?php
            echo form_open("$kontroler/promeniPodatkeDonatorskihUgovora", "method=GET");
            echo "<td>Opis donacije: </td>";
            ?>
        <input type="hidden" name="idUgovor" value="<?php echo $dugovor['idugovor']; ?>"/>
        <td><textarea rows="3" cols="40" name="opis_donacije"><?php
        if ($dugovor['opis_donacije'] != NULL) {
            echo $dugovor['opis_donacije'];
        }
            ?></textarea></td></tr>
    <tr>
        <td><?php echo "Isporuka:"; ?></td>
        <td> <input type="checkbox" name="isporuka" value="1" <?php
            if ($dugovor['isporuka'] == 1) {
                echo 'checked';
            }
            ?>/></td></tr>
    <tr><td>
            <?php echo "Datum isporuke"; ?></td>
        <td><input class="form-control" style="width: 25%;" placeholder="Datum isporuke" type="date" name="datum_isporuke" value="<?php
            if (isset($dugovor['datum_isporuke'])) {
                echo $dugovor['datum_isporuke'];
            }
            ?>" /></td></tr>
    <!--    </select>-->
    <tr><td><?php echo "Status ugovora: <br />"; ?></td>
        <td> <select class="form-control" style="width: 25%;" name="status_ugovora" value="<?php echo $dugovor['opis']; ?>">
                <?php foreach ($statusUgovor as $element) { ?>
                    <option value="<?php echo $element['idstatus_ugovora']; ?>" <?php
            if ($dugovor['idstatus_ugovora'] == $element['idstatus_ugovora']) {
                echo 'selected';
            }
                    ?>>
                            <?php echo $element['opis']; ?></option>
                    <?php } ?>
            </select></td></tr>
    <tr><td>
            <?php
            echo "Komentar:<br />";
            ?></td>
        <td><textarea rows="3" cols="40" name="komentar"><?php
        if ($dugovor['komentar'] != NULL) {
            echo $dugovor['komentar'];
        }
            ?></textarea><br /><br /></td></tr>
<!--</table>-->
    <tr><td colspan="2">    
            <div class="btn btn-lg ">
                <input class="btn btn-lg btn-success " type="submit" value="Promeni" name="" onclick="return confirm('Da li ste sigurni da zelite da promenite ugovor?');" >
                <?php //echo form_submit(array('id' => 'submit', 'value' => 'Promeni')); ?>
            </div>
<!--            <br/><br/>-->
        </td></tr>
    <tr>
        <td></td>
        </tr>
    <?php
    echo form_close();
    //echo "<br />";
}
    }
?>
</table>
<a href="<?php echo site_url($kontroler .'/ispisDonatorskihUgovoraArhiva/'); ?>"><h3>Arhiva Ugovora</h3></a>