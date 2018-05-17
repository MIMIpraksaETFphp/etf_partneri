<?php 
    foreach ($partnerIsticeUgovor as $value){
        $datum=date("Y-m-d H:i:s", strtotime("+6 months"));
        if($value['datum_isticanja']<$datum){
            echo "<table><tr><td><a href=".site_url('ITmenadzer/dosije/'.$value['naziv']).">Dosije Kompanije</a>".$value['naziv']."</td><td>".$value['datum_isticanja']."</td>";
            echo "</table>";
        }
    }
?>