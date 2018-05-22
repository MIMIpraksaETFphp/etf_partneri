<?php
var_dump($partneri);
var_dump($clanovi);
foreach ($clanovi as $clan) {
    echo $clan."<br/>";
    foreach ($clan as $value) {
        echo $value['naziv']."<br/>";
    }
}
