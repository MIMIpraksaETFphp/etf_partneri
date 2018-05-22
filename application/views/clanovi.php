<?php
var_dump($partneri);
var_dump($clanovi);
foreach ($clanovi as $clan) {
    $usernameClana=$clan['username'];
    
    foreach ($clan as $value) {
        echo $value['naziv']."<br/>";
    }
}
