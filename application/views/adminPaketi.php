<br />
<?php
if (isset($poruka)) {
    echo "<span style='color:red;'>" . $poruka . "</span><br /><br />";
}
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
    <div class="row">
        <table class="table table-striped ">
            <?php
            echo "<br />";
            foreach ($paketi as $paket) {
                ?>
                <tr>
                    <td><a name="<?php echo $paket['naziv_paketa']; ?>"><?php
                            echo "<h4>" . $paket['naziv_paketa'] . "</h4><a/><br/>";
                            $filter = array($paket['naziv_paketa']);
                            $filtriraniPaketi = array_filter($paketiStavke, function ($s) use ($filter) {
                                return in_array($s['naziv_paketa'], $filter);
                            });
                            ?>
                    </td>
                    <td>
                        <?php
                        foreach ($filtriraniPaketi as $filtriraniPaket) {
                            echo $filtriraniPaket['opis'] . "<br/>";
                        }
                        ?>
                        <input class="button" type="button" name="brisanjePaketa" value="Izbrisi paket" onclick="confirm('Da li ste sigurni?') ? location.href = '
                               <?php echo site_url(); ?>Admin / brisanjePaketa /<?php echo $paket['idPaketi']; ?>' : false"/>
                        <br /><br />
                        <?php
                    }
                }
                ?>
            </td> 
        </tr>
    </table>
</div>