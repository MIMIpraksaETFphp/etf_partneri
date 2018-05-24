<?php

// var_dump($oglasi);
foreach ($oglasi as $oglas) {
    echo "<h3>" . $oglas ["partner_naziv"] . "-" . $oglas["oglas_naziv"] . "</h3>" . "<br />";
    echo $oglas["datum_unosenja"] . "<br />";
    if($oglas["praksa"]==1){
        echo "Praksa<br />";
    }
    if($oglas["zaposlenje"]==1){
        echo "Zaposlenje<br />";
    }
    echo "<br />";    
    echo $oglas["oglas_opis"] . "<br />";    
    echo "<a href=" . site_url($kontroler.'/oglasDetaljnije/'.$oglas['idoglas']) . ">Detaljnije</a><br /><br />";
}