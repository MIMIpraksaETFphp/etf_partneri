<?php
if (isset($paketi)) {
    foreach ($paketi as $paket) {
        ?>
        <div class="row">
            <table class="table table-striped ">
                <tr>
                    <th class="col-sm-4"><a href="#<?php echo $paket['naziv_paketa']; ?>"><?php echo $paket['naziv_paketa']; ?></a></th>
                    <td class="col-sm-4"><?php echo $paket['vrednost_paketa']; ?></td>
                    <td><?php echo $paket['valuta']; ?></td>
                </tr>
            </table>
        </div>
        <?php
    }
    ?>
    <table class="table table-striped ">
        <?php
        foreach ($paketi as $paket) {
            ?>
        <tr>
                    <td><a name="<?php echo $paket['naziv_paketa']; ?>"><?php
                            echo "<h3>".$paket['naziv_paketa'] . "</h3><a/><br/>";
                            $filter = array($paket['naziv_paketa']);
                            $filtriraniPaketi = array_filter($paketiStavke, function ($s) use ($filter) {
                                return in_array($s['naziv_paketa'], $filter);
                            });
                            ?>
                    </td>
                    <td>
                        <?php
//        var_dump($filtriraniPaketi);
                        foreach ($filtriraniPaketi as $filtriraniPaket) {
                            echo $filtriraniPaket['opis'] . "<br/>";
                        }
                        echo "<br/><br/>";
                    }
                }
                ?>
            </td> 
        </tr>
</table>