<?php 
    // var_dump($mejlovi);
    foreach ($mejlovi as $mejl) {
        echo "id mejla: ".$mejl['idmejl']."<br/>";
        echo "from: ".$mejl['email']."<br/>";
        echo $mejl['ime'].$mejl['prezime']."<br/>";
        echo "to: ".$mejl['email_primaoca']."<br/>";
        echo "vreme slanja: ".$mejl['datum_slanja']."<br/>";
        echo "naslov mejla: ".$mejl['naslov']."<br/>";
        echo "sadrzaj mejla: ".$mejl['sadrzaj']."<br/>";
    }
?>