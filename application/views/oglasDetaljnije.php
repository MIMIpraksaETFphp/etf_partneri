
<?php      
//        echo "<br/>";
//        echo "<h2>".$oglas['naziv']."</h2><br/><br/>".$oglas['opis'];
//        echo "<br/>";
//        // var_dump($oglas);
        var_dump($fajl);
//if(file_exists($fajl['putanja']))
//{  ?>
<!--<i class="fa fa-file-pdf-o" aria-hidden="true"></i>-->
<!--<a href="<?php // echo base_url($fajl['putanja']); ?>"><?php //echo $oglas['naziv'];?></a>-->
<?php 
//} 
?>

<br/>
<table class="table table-striped ">

    <th colspan="2"><?php echo $oglas['naziv']; ?></th>
    <tr>
        <td></td>
        <td><?php echo $oglas['opis']; ?></td>
    </tr>

</table>
<?php 
if(file_exists($fajl['putanja']))
{  ?>
<i class="fa fa-file" aria-hidden="true"></i>
<a href="<?php echo base_url($fajl['putanja']); ?>"><?php echo $oglas['naziv'];?></a>
<?php 
} 
?>