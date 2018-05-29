<?php
//echo mdate('%Y-%m-%d %H:%i:%s', now())."<br>";
echo "<br/><br/>Spisak novcanih ugovora na Elektrotehnickom fakultetu u Beogradu:<br/><br/><br/>";

foreach ($novcaniUgovori as $nugovor) {
    //$datum=mdate('%Y-%m-%d %H:%i:%s', now());
    //if($novcaniUgovorir<$nugovor['vreme_predavanja']){
    echo "<h3>" . $nugovor['naziv'] . "</h3><br/>";
    echo "Datum potpisivanja: " . $nugovor['datum_potpisivanja'] . "<br/>";
    echo "Datum isticanja: " . $nugovor['datum_isticanja'] . "<br/>";
    echo "Paket: " . $nugovor['naziv_paketa'] . "<br/>";
    echo "Tip ugovora: " . $nugovor['tip'] . "<br/>";
    echo "Vrednost: " . $nugovor['vrednost'] . "<br/>";
    echo "Valuta: " . $nugovor['valuta'] . "<br/>";
    echo form_open("$kontroler/promeniPodatkeUgovora", "method=GET");
    echo form_label("Faktura: &nbsp ");
    ?>
    <input type="hidden" name="idUgovor" value="<?php echo $nugovor['idugovor']; ?>"/>
    <input type="checkbox" name="faktura" value="1" <?php
    if ($nugovor['faktura'] == 1) {
        echo 'checked';
    }
    ?> />
           <?php
           echo "<br />";
           echo "Uplata: &nbsp ";
           ?>
    <input type="checkbox" name="uplata" value="1" <?php
    if ($nugovor['uplata'] == 1) {
        echo 'checked';
    }
    ?> />
           <?php
           echo "<br />";
           echo "Datum uplate: ";
           echo "<br/>";
           ?>
    <input class="form-control" style="width: 25%;" placeholder="Datum uplate" name="datum_uplate" type="date" value="<?php if ($nugovor['datum_uplate'] != NULL) {
           echo $nugovor['datum_uplate'];
       }
           ?>">
           <?php
           echo "Status ugovora: ";
           echo "<br/>";
           ?>
    <div class="form-group">                                
        <select class="form-control" style="width: 25%;" name="status_ugovora" value="<?php echo $nugovor['opis']; ?>">
            <?php foreach ($statusUgovor as $element) { ?>
                <option value="<?php echo $element['idstatus_ugovora']; ?>" <?php
                if ($nugovor['idstatus_ugovora'] == $element['idstatus_ugovora']) {
                    echo 'selected';
                }
                ?>>
        <?php echo $element['opis']; ?></option>
    <?php } ?>
        </select>
    </div>
    <?php
    //echo "<br />";
    echo "Komentar:<br/ >";
    ?>
    <textarea name="komentar"><?php if ($nugovor['komentar'] != NULL) {
        echo $nugovor['komentar'];
    } ?></textarea><br /><br />
   <div class="btn btn-lg ">
       <input class="btn btn-lg btn-success " type="submit" value="Promeni" name="" >
        <?php
   // echo form_submit(array('id' => 'submit', 'value' => 'Promeni'));   
    ?>
       </div>
       <?php
    echo form_close();
    echo "<br/><br/><br/>";
}
?>
