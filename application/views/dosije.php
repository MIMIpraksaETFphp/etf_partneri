
<table class="table">
    <?php
    foreach ($partner as $kompanija) {
        ?>
        <tr>
            <th style="color: blue;"><?php echo $kompanija['naziv']; ?></th>
        </tr>
        <tr>
            <th>PIB</th>
        </tr>
        <tr>
            <td><?php echo $kompanija['PIB']; ?></td>
        </tr>
        <tr>
            <th>Adresa</th>
        </tr>
        <tr>
            <td><?php echo $kompanija['adresa']; ?></td>
        </tr>
        <tr>
            <th>Grad</th>
        </tr>
        <tr>
            <td><?php echo $kompanija['grad']; ?></td>
        </tr>
        <tr>
            <th>Postanski broj</th>
        </tr>
        <tr>
            <td><?php echo $kompanija['postanski_broj']; ?></td>
        </tr>
        <tr>
            <th>Drzava</th>
        </tr>
        <tr>
            <td><?php echo $kompanija['drzava']; ?></td>
        </tr>
        <tr>
            <th>Ziro racun</th>
        </tr>
        <tr>
            <td><?php echo $kompanija['ziro_racun']; ?></td>
        </tr>
        <tr>
            <th>Valuta racuna</th>
        </tr>
        <tr>
            <td><?php echo $kompanija['valuta_racuna']; ?></td>
        </tr>
        <tr>
            <th>Kontakt osoba</th>
        </tr>
        <tr>
            <td><?php echo $kompanija['ime_kontakt_osobe'] . " " . $kompanija['prezime_kontakt_osobe']; ?></td>
        </tr>
        <tr>
            <th>Telefon kontakt osobe</th>
        </tr>
        <tr>
            <td><?php echo $kompanija['telefon_kontakt_osobe']; ?></td>
        </tr>
        <tr>
            <th>Email kontakt osobe</th>
        </tr>
        <tr>
            <td><?php echo $kompanija['email_kontakt_osobe']; ?></td>
        </tr>
        <tr>
            <th>Web adresa</th>
        </tr>
        <tr>
            <td><a href="<?php echo $kompanija['veb_adresa']; ?>" target="_blanck"><?php echo $kompanija['veb_adresa']; ?></a></td>
        </tr>
        <tr>
            <th>Opis</th>
        </tr>
        <tr>
            <td><?php echo $kompanija['opis']; ?></td>
        </tr>

    <?php } ?>
</table>
<br />
<table class="table">
    <tr colspan="4" style="text-align: center;">
        <th>Ugovori</th>
    </tr>
    <tr>
        <td>Tip</td>
        <td>Paket</td>
        <td>Datum potpisivanja</td>
        <td>Datum isticanja</td>
    </tr>
    <?php
    foreach ($ugovori as $ugovor) {
        $datum = mdate('%Y-%m-%d %H:%i:%s', now());
        if ($datum < $ugovor['datum_isticanja']) {
            $color = 'blue';
        } else {
            $color = 'red';
        }
        ?>
        <tr style="color: <?php echo $color; ?>;">
            <td><?php echo $ugovor['tip']; ?></td>
            <td><?php echo $ugovor['naziv_paketa']; ?></td>
            <td><?php echo $ugovor['datum_potpisivanja']; ?></td>
            <td><?php echo $ugovor['datum_isticanja']; ?></td>
        </tr>
        <?php
}
?>
    </table>
    