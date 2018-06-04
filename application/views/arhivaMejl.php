<?php 
    // var_dump($mejlovi);
    // var_dump($primaociMejla);
    foreach ($mejlovi as $mejl) {
        echo "id mejla: ".$mejl['idmejl']."<br/>";
        echo "from: ".$mejl['email']."<br/>";
        echo $mejl['ime'].$mejl['prezime']."<br/>";
        echo "to: ";
        $idMejl = $mejl['idmejl'];
        // var_dump($primaociMejla[$idMejl]);
        for ($i=0; $i<count($primaociMejla[$idMejl]); $i++){
            echo $primaociMejla[$idMejl][$i]['email_primaoca'].", ";
        }
        echo "<br/>";
        echo "vreme slanja: ".$mejl['datum_slanja']."<br/>";
        echo "naslov mejla: ".$mejl['naslov']."<br/>";
        echo "sadrzaj mejla: ".$mejl['sadrzaj']."<br/><br/>";
    }
?>