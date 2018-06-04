<?php echo "<br/><br/><h3>Arhiva novcanih ugovora :</h3><br/><br/><br/>";?>

 <?php foreach ($DonUgovor as $value){
     if($value['idstatus_ugovora']=='6'){?>
        
     <table class="table table-bordered table-striped">
         <tbody>
     <?php echo "<th colspan='2'><h3>".$value['naziv']."</h3></th>";
     echo "<tr><td>Datum potpisivanja: </td><td>".$value['datum_potpisivanja']."</td></tr>";
     echo "<tr><td>Datum isticanja: </td><td>".$value['datum_isticanja']."</td></tr>";
     echo "<tr><td>Paket: </td><td>".$value['naziv_paketa']."</td></tr>";
     echo "<tr><td>Opis Donacije: </td><td>".$value['opis_donacije']."</td></tr>";
     echo "<tr><td>Procenjena vrednost: </td><td>".$value['procenjena_vrednost'].$value['valuta']."</td></tr>";
     echo "<tr><td>Komentar: </td><td>".$value['komentar']."</td></tr>";
 
     }
     }?>
             </tbody>
</table>