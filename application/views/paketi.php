<?php
if (isset($paketi)) {
    foreach ($paketi as $paket) {
        ?>
        <table>
            <tr>
                <th><a href="#<?php echo $paket['naziv_paketa']; ?>"><?php echo $paket['naziv_paketa']; ?></a></th>
                <td><?php echo $paket['vrednost_paketa']; ?></td>
                <td><?php echo $paket['valuta']; ?></td>
            </tr>
        </table>

        <?php
    }
    echo "<br />";
    foreach ($paketi as $paket) {
        ?>
        <a name="<?php echo $paket['naziv_paketa']; ?>"><?php
            echo "<h3>" . $paket['naziv_paketa'] . "</h3><a/><br/>";
            echo "<p>Paket ";
            if ($paket['trajanje_paketa_godine'] == 1) {
                echo "na jednogodisnjem nivou";
            } elseif ($paket['trajanje_paketa_godine'] == 2) {
                echo "na dvogodisnjem nivou";
            }
            echo " obuhvata:</p >";
            $filter = array($paket['naziv_paketa']);
            $filtriraniPaketi = array_filter($paketiStavke, function ($s) use ($filter) {
                return in_array($s['naziv_paketa'], $filter);
            });
//        var_dump($filtriraniPaketi);
            foreach ($filtriraniPaketi as $filtriraniPaket) {
                echo $filtriraniPaket['opis'] . "<br/>";
            }
            echo "<br/><br/>";
        }
    }
    ?>