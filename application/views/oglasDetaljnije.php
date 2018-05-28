
<?php      
        echo "<br/>";
        echo "<h2>".$oglas['naziv']."</h2><br/><br/>".$oglas['opis'];
        echo "<br/>";
        // var_dump($oglas);
        // var_dump($fajl);
if(file_exists($fajl['putanja']))
{  ?>
<i class="fa fa-file-pdf-o" aria-hidden="true"></i>
<a href="<?php echo base_url($fajl['putanja']); ?>"><?php echo $oglas['naziv'];?></a>
<?php 
} 
?>