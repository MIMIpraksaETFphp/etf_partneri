<?php echo "<br/><br/><h3>Arhiva predavanja na Elektrotehničkom fakultetu u Beogradu:</h3><br/><br/><br/>"; ?>

<?php
foreach ($predavanja as $predavanje) {
    $datum = mdate('%Y-%m-%d %H:%i:%s', now());
    if ($datum > $predavanje['vreme_predavanja']) {
        ?>
        <table class="table table-striped table-bordered">
            <tbody>
                <tr>
                    <th><?php echo "<h3>" . $predavanje['naslov_srpski'] . "</h3>"; ?></th>
                </tr>
                <tr>
                    <td><?php echo "Opis predavanja:<br/>" . $predavanje['opis_srpski'] . "<br/>"; ?></td>
                </tr>
                <tr>
                    <td><?php echo "Sala:" . $predavanje['sala'] . "<br/>"; ?></td>
                </tr>
                <tr>
                    <td><?php echo "Vreme predavanja:" . $predavanje['vreme_predavanja'] . "<br/>"; ?></td>
                </tr>
                <tr>
                    <td><?php echo "Ime i prezimee predavaca: " . $predavanje['ime_predavaca'] . " " . $predavanje['prezime_predavaca'] . "<br/>"; ?></td>
                </tr>
                <tr>
                    <td><?php echo "Biografija predavaca:<br/>" . $predavanje['cv_srpski'] . "<br/>"; ?></td>
                </tr>

            </tbody>

            <?php
        }
    }
    ?>
</table>