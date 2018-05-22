<?php
// var_dump($partneri);
// var_dump($clanovi);
foreach ($clanovi as $clan) {
    $usernameClana=$clan['username'];
    $filtriraniPartneri = $partneri[$usernameClana];
    if (!empty($filtriraniPartneri)) {
        echo $usernameClana."<br/>";
        foreach ($filtriraniPartneri as $filtriraniPartner) {
            echo $filtriraniPartner['naziv']."<br/>";
        }
        echo "<br/><br/>";
    }
}
