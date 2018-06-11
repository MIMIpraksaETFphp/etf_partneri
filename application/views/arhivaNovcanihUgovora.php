<?php echo "<br/><br/><h3>Arhiva novčanih ugovora :</h3><br/><br/><br/>"; 
 //var_dump($NovUgovor);?>

 <?php foreach ($NovUgovor as $value){
     if($value['idstatus_ugovora']=='6'){?>

       <table class="table table-bordered table-striped"> 
           <tbody>
     <?php
     echo "<th colspan='2'><h3>".$value['naziv']."</h3></th>";
     echo "<tr><td>Datum potpisivanja: </td><td>".$value['datum_potpisivanja']."</td></tr>";
     echo "<tr><td>Datum isticanja: </td><td>".$value['datum_isticanja']."</td></tr>";
     echo "<tr><td>Paket: </td><td>".$value['naziv_paketa']."</td></tr>";
     echo "<tr><td>Vrednost: </td><td>".$value['vrednost'].$value['valuta']."</td></tr>";
     echo "<tr><td>Komentar: </td><td>".$value['komentar']."</td></tr>";
 
     }
     }?>
               </tbody>
</table>