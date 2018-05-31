<?php
//echo mdate('%Y-%m-%d %H:%i:%s', now())."<br>";
echo "<br/><h3>Spisak novcanih ugovora na Elektrotehnickom fakultetu u Beogradu:</h3><br/>";?>
<table class="table table-striped ">
        <?php
foreach ($novcaniUgovori as $nugovor) {?>
    <tr><td colspan="2">
  <?php  //$datum=mdate('%Y-%m-%d %H:%i:%s', now());
    //if($novcaniUgovorir<$nugovor['vreme_predavanja']){
    echo "<h3>" . $nugovor['naziv'] . "</h3>";?></td></tr>
            <?php
    echo "<tr><td>Datum potpisivanja:</td><td> " . $nugovor['datum_potpisivanja'] . "</td></tr>";
    echo "<tr><td>Datum isticanja:</td><td> " . $nugovor['datum_isticanja'] . "</td></tr>";
    echo "<tr><td>Paket:</td><td> " . $nugovor['naziv_paketa'] . "</td></tr>";
    echo "<tr><td>Tip ugovora:</td><td> " . $nugovor['tip'] . "</td></tr>";
    echo "<tr><td>Vrednost: </td><td>" . $nugovor['vrednost'] . "</td></tr>";
    echo "<tr><td>Valuta: </td><td>" . $nugovor['valuta'] . "</td></tr>";?>

    <tr>
    <?php
    echo form_open("$kontroler/promeniPodatkeUgovora", "method=GET");?>
        <td>
        <?php
    echo form_label("Faktura: &nbsp ");
    ?></td>
    <input type="hidden" name="idUgovor" value="<?php echo $nugovor['idugovor']; ?>"/>
    <td><input type="checkbox" name="faktura" value="1" <?php
    if ($nugovor['faktura'] == 1) {
        echo 'checked';
    }
    ?> /></td></tr>
          <tr><td> <?php
           echo "Uplata: &nbsp ";
           ?></td>
   <td> <input type="checkbox" name="uplata" value="1" <?php
    if ($nugovor['uplata'] == 1) {
        echo 'checked';
    }
    ?> /></td></tr>
         <tr><td>  <?php
           echo "Datum uplate: ";
           ?></td>
   <td> <input class="form-control" style="width: 25%;" placeholder="Datum uplate" name="datum_uplate" type="date" value="<?php if ($nugovor['datum_uplate'] != NULL) {
           echo $nugovor['datum_uplate'];
       }
           ?>"></td></tr>
        <tr><td>   <?php
           echo "Status ugovora: ";
           ?></td>
   <td> <div class="form-group">                                
        <select class="form-control" style="width: 25%;" name="status_ugovora" value="<?php echo $nugovor['opis']; ?>">
            <?php foreach ($statusUgovor as $element) { ?>
                <option value="<?php echo $element['idstatus_ugovora']; ?>" <?php
                if ($nugovor['idstatus_ugovora'] == $element['idstatus_ugovora']) {
                    echo 'selected';
                }
                ?>>
        <?php echo $element['opis']; ?></option>
    <?php } ?>
        </select></td></tr>
    </div>
   <tr><td> <?php
    //echo "<br />";
    echo "Komentar:<br/ >";
    ?></td>
   <td> <textarea name="komentar"><?php if ($nugovor['komentar'] != NULL) {
        echo $nugovor['komentar'];
    } ?></textarea><br /><br /></td></tr>
  <tr><td colspan="2"> 
          <!--<div class="btn btn-lg ">-->
       <input class="btn btn-lg btn-success " type="submit" value="Promeni" name=""/>
        <?php
   // echo form_submit(array('id' => 'submit', 'value' => 'Promeni'));   
    ?>
       <!--</div>-->
      </td></tr>
       <?php
    echo form_close();
}
?>
</table>