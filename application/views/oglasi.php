<?php
// var_dump($oglasi);
echo "<br/>";
foreach ($oglasi as $oglas) {
    ?>
    <div class="row">
        <div  class="col-sm-12">
            <table class="table table-striped">

                <?php echo "<h3>" . $oglas ["partner_naziv"] . "-" . $oglas["oglas_naziv"] . "</h3>" . "<br />"; ?>
                <tbody>
                    <tr>
                        <td><?php echo $oglas["datum_unosenja"] . "<br />"; ?></td>
                    </tr>
                    <tr>
                        <td>
                        <?php
                        if ($oglas["praksa"] == 1) {
                            echo "Praksa<br />";
                        }
                        if ($oglas["zaposlenje"] == 1) {
                            echo "Zaposlenje<br />";
                        }
                        ?>
                            </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php
    echo "<br />";
    echo $oglas["oglas_opis"] . "<br />";
    echo "<a href=" . site_url($kontroler . '/oglasDetaljnije/' . $oglas['idoglas']) . ">Detaljnije</a><br /><br />";
}
?>