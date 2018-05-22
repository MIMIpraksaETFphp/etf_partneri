<?php
if(isset($paketi)) {
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
            <a name="<?php echo $paket['naziv_paketa']; ?>"><?php echo "<h4>".$paket['naziv_paketa'] . "</h4><a/><br/>";
            $filter = array($paket['naziv_paketa']);
            $filtriraniPaketi = array_filter($paketiStavke, function ($s) use ($filter) {
                return in_array($s['naziv_paketa'], $filter);
            });
            foreach ($filtriraniPaketi as $filtriraniPaket) {
                echo $filtriraniPaket['opis'] . "<br/>";
            }
            echo "<br/><br/>";
        }
    }