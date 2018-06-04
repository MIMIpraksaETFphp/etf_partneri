<?php
$danasnjiDatum = mdate('%Y-%m-%d %H:%i:%s', now());
//echo mdate('%Y-%m-%d %H:%i:%s', now())."<br>";
echo "<br/><h3>Spisak novčanih ugovora na Elektrotehničkom fakultetu u Beogradu:</h3><br/>";
var_dump($broj);
//echo $godinePaket[0]['trajanje_paketa_godine'];
//    if($novcaniUgovori['idstatus_ugovora']!='6'){
//        ?>
<table class="table table-striped table-bordered">
        <?php
foreach ($novcaniUgovori as $nugovor) {?>
    <?php if($nugovor['idstatus_ugovora']!='6'){?>
    
    <tr><td colspan="2">
  <?php  //$datum=mdate('%Y-%m-%d %H:%i:%s', now());
    //if($novcaniUgovorir<$nugovor['vreme_predavanja']){
  
    echo "<h3>" . $nugovor['naziv'] . "</h3>";?></td></tr>
            <?php
    echo "<tr><td>Datum potpisivanja:</td><td> " . $nugovor['datum_potpisivanja'] . "</td></tr>";
    echo "<tr><td>Datum isticanja:</td><td> "?><?php if($danasnjiDatum>$nugovor['datum_isticanja']){
            echo "<font color='red'>".$nugovor['datum_isticanja']."</font>";
    }else{ 
        echo $nugovor['datum_isticanja'];
    
    } ?></td></tr>
    <?php
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
        <select class="form-control" style="width: 25%;" name="status_ugovora" value="<?php echo $nugovor['opis']; ?>" >
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
   <td> <textarea rows="4" cols="70" name="komentar"><?php if ($nugovor['komentar'] != NULL) {
        echo $nugovor['komentar'];
    } ?></textarea><br /><br /></td></tr>
  <tr><td colspan="2"> 
          <!--<div class="btn btn-lg ">-->
       <input class="btn btn-lg btn-success " type="submit" value="Promeni" name="" onclick="return confirm('Da li ste sigurni da zelite da promenite status ugovora?');"/>
        <?php
   // echo form_submit(array('id' => 'submit', 'value' => 'Promeni'));   
    ?>
       <!--</div>-->
      </td></tr>
  <tr>
      <td>
          
      </td>
  </tr>
       <?php
    echo form_close();
}
} 
?>
</table>

<a href="<?php echo site_url($kontroler . '/ispisNovcanihUgovoraArhiva/'); ?>"><h3>Arhiva Ugovora</h3></a>