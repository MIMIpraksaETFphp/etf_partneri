<br />
<?php //var_dump($partner);?>
<br/>
<table class="table table-striped" >
    <?php foreach ($partner as $kompanija) { 
    $idPartner = $kompanija['idPartner'];?>
        <tr>
            <th colspan="2" style="color: blue;"><h1><?php echo $kompanija['naziv']; ?></h1></th>
        </tr>
        <?php
        if (isset($logoi)) {
            for ($i = 0; $i < count($logoi); $i++) {
                $a = $i + 1;
                echo "<tr><th>Logo " . $a . "</th></tr>";
                ?>
                <tr>
                    <td colspan="2"><img src="<?php echo base_url($logoi[$i]['putanja']);?>" alt="<?php echo $kompanija['naziv']; ?>"/></td>
                </tr>
                <?php
            }
        } ?>
                <tr>
                        <th>PIB</th> 
                        <td><?php echo $kompanija['PIB']; ?></td>
                    </tr>
                    <tr>
                        <th>Adresa</th> 
                        <td><?php echo $kompanija['adresa']; ?></td>
                    </tr>
                    <tr>
                        <th>Grad</th>
                        <td><?php echo $kompanija['grad']; ?></td>
                    </tr>
                    <tr>
                        <th>Poštanski broj</th>    
                        <td><?php echo $kompanija['postanski_broj']; ?></td>
                    </tr>
                    <tr>
                        <th>Država</th>
                        <td><?php echo $kompanija['drzava']; ?></td>
                    </tr>
                    <tr>
                        <th>Žiro racun</th>
                        <td><?php echo $kompanija['ziro_racun']; ?></td>
                    </tr>
                    <tr>
                        <th>Valuta racuna</th>
                        <td><?php echo $kompanija['valuta_racuna']; ?></td>
                    </tr>
                    <tr>
                        <th>Kontakt osoba</th>
                        <td><?php echo $kompanija['ime_kontakt_osobe'] . " " . $kompanija['prezime_kontakt_osobe']; ?></td>
                    </tr>
                    <tr>
                        <th>Telefon kontakt osobe</th>
                        <td><?php echo $kompanija['telefon_kontakt_osobe']; ?></td>
                    </tr>
                    <tr>
                        <th>Email kontakt osobe</th>
                        <td><?php echo $kompanija['email_kontakt_osobe']; ?></td>
                    </tr>
                    <tr>
                        <th>Web adresa</th>
                        <td><a href="<?php echo $kompanija['veb_adresa']; ?>" target="_blanck"><?php echo $kompanija['veb_adresa']; ?></a></td>
                    </tr>
        <?php
    }
    if (isset($telefoni)) {
        for ($i = 0; $i < count($telefoni); $i++) {
            $a = $i + 1;
            echo "<tr><th>Telefon " . $a . "</th>";
            echo "<td>" . $telefoni[$i]['telefon'] . "</td></tr>";
        }
    }
    if (isset($mejlovi)) {
        for ($i = 0; $i < count($mejlovi); $i++) {
            $a = $i + 1;
            echo "<tr><th>Email " . $a . "</th>";
            echo "<td>" . $mejlovi[$i]['email'] . "</td></tr>";
        }
    }
    ?>
    <tr>
        <th>Opis</th>
        <td ><?php echo $kompanija['opis']; ?></td>
    </tr>
</table>
<?php $value=1;?>
<input type="button" class="btn btn-default" value="Izmeni podatke" onclick="location.href = '<?php echo site_url("$kontroler/dosije/$idPartner/$value");?>';">
<br />
<br />
<table class="table">
    <tr colspan="4" style="text-align: center;"><th>Ugovori</th></tr>
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
