<?php
 //var_dump($partneri);
 echo "<br/><br/>";
// var_dump($clanovi);
foreach ($clanovi as $clan) {
    $usernameClana=$clan['username'];
    $filtriraniPartneri = $partneri[$usernameClana];
    if (!empty($filtriraniPartneri)) {
        echo $usernameClana."<br/>";
        foreach ($filtriraniPartneri as $filtriraniPartner) {
            echo $filtriraniPartner['naziv']."<a href=" . site_url("$kontroler/izbrisiPartnerClan/".$filtriraniPartner['idKorisnik']."/".$filtriraniPartner['idPartner']) . ">Izbrisi</a><br />";
        }
        echo "<br/><br/>";
    }
}
