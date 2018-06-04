<br />
<h3>Arhiva mejlova</h3>

<?php
// var_dump($mejlovi);
// var_dump($primaociMejla);
foreach ($mejlovi as $mejl) {
    ?>
    <div class="row">
        <div class="col-md-8 col-md-offset-4">
            <table class="table table-striped table-bordered">
                <?php
                echo "<tbody>";
                //echo "<tr><td>id mejla: </td><td>" . $mejl['idmejl'] . "</td></tr>";
                echo "<tr><td>from: </td><td>" . $mejl['email'] . "</td></tr>";
                echo "<tr><td>Ime i prezime pošiljaoca: </td><td>" . $mejl['ime'] . " " . $mejl['prezime'] . "</td></tr>";
                echo "<tr><td>to: </td>";
                $idMejl = $mejl['idmejl'];
                // var_dump($primaociMejla[$idMejl]);
                for ($i = 0; $i < count($primaociMejla[$idMejl]); $i++) {
                    echo "<td>" . $primaociMejla[$idMejl][$i]['email_primaoca'] . ", </td></tr>";
                }
                //echo "<br/>";
                echo "<tr><td>vreme slanja: </td><td>" . $mejl['datum_slanja'] . "</td></tr>";
                echo "<tr><td>naslov mejla: </td><td>" . $mejl['naslov'] . "</td></tr>";
                echo "<tr><td>sadrzaj mejla: </td><td>" . $mejl['sadrzaj'] . "</td></tr><br />";
                echo "</tbody>";
            }
            ?>

        </table>
    </div>
</div>