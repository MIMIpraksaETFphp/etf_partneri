<?php
echo "<br/>Spisak donatorskih ugovora na Elektrotehnickom fakultetu u Beogradu:<br/><br/>";

foreach ($donatorskiUgovori as $dugovor) {
    echo "<h3>" . $dugovor['naziv'] . "</h3><br/>";
    echo "Tip ugovora: " . $dugovor['tip'] . "<br/>";
    echo "Datum potpisivanja: " . $dugovor['datum_potpisivanja'] . "<br/>";
    echo "Datum isticanja: " . $dugovor['datum_isticanja'] . "<br/>";
    echo "Paket: " . $dugovor['naziv_paketa'] . "<br/>";
    echo "Procenjena vrednost: " . $dugovor['procenjena_vrednost'] . "<br/>";
    echo "Valuta: " . $dugovor['valuta'] . "<br/>";
    echo form_open("$kontroler/promeniPodatkeDonatorskihUgovora", "method=GET");
    echo "Opis donacije: <br/>";
    ?>
    <input type="hidden" name="idUgovor" value="<?php echo $dugovor['idugovor']; ?>"/>
    <textarea name="opis_donacije"><?php
        if ($dugovor['opis_donacije'] != NULL) {
            echo $dugovor['opis_donacije'];
        }
        ?></textarea><br />
    <?php echo "Isporuka:"; ?>
    <input type="checkbox" name="isporuka" value="1" <?php
    if ($dugovor['isporuka'] == 1) {
        echo 'checked';
    }
    ?>/><br />
           <?php echo "Datum isporuke"; ?>
    <input class="form-control" style="width: 25%;" placeholder="Datum isporuke" type="date" name="datum_isporuke" value="<?php
    if (isset($dugovor['datum_isporuke'])) {
        echo $dugovor['datum_isporuke'];
    }
    ?>" />
    </select>
    <?php echo "Status ugovora: <br />"; ?>
    <select class="form-control" style="width: 25%;" name="status_ugovora" value="<?php echo $dugovor['opis']; ?>">
        <?php foreach ($statusUgovor as $element) { ?>
            <option value="<?php echo $element['idstatus_ugovora']; ?>" <?php
            if ($dugovor['idstatus_ugovora'] == $element['idstatus_ugovora']) {
                echo 'selected';
            }
            ?>>
                <?php echo $element['opis']; ?></option>
        <?php } ?>
    </select>
    <?php
    echo "Komentar:<br />"; 
    ?>
    <textarea name="komentar"><?php
        if ($dugovor['komentar'] != NULL) {
            echo $dugovor['komentar'];
        }
        ?></textarea><br /><br />
        <div class="btn btn-lg ">
           <input class="btn btn-lg btn-success " type="submit" value="Promeni" name="" >
    <?php
    //echo form_submit(array('id' => 'submit', 'value' => 'Promeni'));?>
            </div>
                <?php
    echo form_close();
    echo "<br /><br />";
}
?>
  