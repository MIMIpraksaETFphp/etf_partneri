
<?php            
        echo "<h2>".$oglas['naziv']."</h2><br/><br/>".$oglas['opis'];
        echo "<br/>";
        // var_dump($oglas);
        // var_dump($fajl);
// if(file_exists("assets/fajlovi/".$oglas['partner_idPartner'] ."_".preg_replace('/\s+/', '_', $oglas['naziv'])."_".md5($oglas['datum_unosenja']).".pdf"))
if(file_exists($fajl['putanja'].".pdf"))
{  ?>
<i class="fa fa-file-pdf-o" aria-hidden="true"></i>
<!-- <a href="<?php //echo base_url("assets/fajlovi/".$oglas['partner_idPartner'] ."_".preg_replace('/\s+/', '_', $oglas['naziv'])."_".md5($oglas['datum_unosenja']).".pdf"); ?>"><?php //echo preg_replace('/\s+/', '_', $oglas['naziv']);?></a> -->
<a href="<?php echo base_url($fajl['putanja']).".pdf"; ?>"><?php echo preg_replace('/\s+/', '_', $oglas['naziv']);;?></a>
<?php 
}