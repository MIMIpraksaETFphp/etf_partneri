
<?php            
        echo "<h2>".$oglas['naziv']."</h2><br/><br/>".$oglas['opis'];
        echo "<br/>";
       // var_dump(md5($oglas['datum_unosenja']));
if(file_exists("assets/fajlovi/".$oglas['partner_idPartner'] ."_".$oglas['naziv']."_".md5($oglas['datum_unosenja']).".pdf")) 
{  ?>
<i class="fa fa-file-pdf-o" aria-hidden="true"></i>
<a href="<?php echo base_url("assets/fajlovi/".$oglas['partner_idPartner'] ."_".$oglas['naziv']."_".md5($oglas['datum_unosenja']).".pdf"); ?>"><?php echo $oglas['partner_idPartner'] ."_".$oglas['naziv'];?></a>

<?php 
}