<?php
foreach ($partner as $kompanija){
    ?>
    <table class="table">
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
</table>
<?php } ?>