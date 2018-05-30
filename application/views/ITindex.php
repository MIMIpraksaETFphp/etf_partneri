<p>
    A basic timeline. You can move and zoom the timeline, and select items.
</p>

<div id="visualization"></div>
<?php
// var_dump($partnerIsticeUgovor);
$datum = date("Y-m-d H:i:s", strtotime("+6 months"));
$datum2 = date("Y-m-d H:i:s", strtotime("-6 months"));
$datum3 = date("Y-m-d H:i:s", strtotime("+2 months"));
$danasnjiDatum = mdate('%Y-%m-%d %H:%i:%s', now());
?>
<br/>
<hr>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered">

            <th colspan="4"><?php echo "Kompanije kojima u narednih 6 meseci istice ugovor: <br/><br/>"; ?></th>
            <?php
            foreach ($partnerIsticeUgovor as $value) {
                
                if ( $value['datum_isticanja'] > $danasnjiDatum && ($value['datum_isticanja'] < $datum3)) {     //OTKOMENTARISATI kad budemo imali kompanije kojima istice ugovor za 6 meseci
                    echo "<tr><td><a href=" . site_url("$kontroler/dosije/" . $value['naziv']) . ">Dosije Kompanije</a>" . "</td><td>" . $value['naziv'] . "</td><td>" . $value['datum_isticanja'] . "</td><td>LINK mail</td></tr>";
                }
                
                
                else if (($value['datum_isticanja'] < $datum) && $value['datum_isticanja'] > $danasnjiDatum) {     //OTKOMENTARISATI kad budemo imali kompanije kojima istice ugovor za 6 meseci
                    echo "<tr><td><a href=" . site_url("$kontroler/dosije/" . $value['naziv']) . ">Dosije Kompanije</a>" . "</td><td>" . $value['naziv'] . "</td><td>" . $value['datum_isticanja'] . "</td><td></td></tr>";
                }
            }
            ?>
        </table>
        <hr>

        <table class="table table-bordered">
            <th colspan="4"><?php echo "Kompanije kojima je u prethodnih 6 meseci istekao ugovor: "; ?></th>
            <?php
            foreach ($partnerIsticeUgovor as $value) {
                if (($value['datum_isticanja'] > $datum2) && $value['datum_isticanja'] < $danasnjiDatum) {
                    echo "<tr><td><a href=" . site_url("$kontroler/dosije/" . $value['naziv']) . ">Dosije Kompanije</a></td><td>" . $value['naziv'] . "</td><td>" . $value['datum_isticanja'] . "</td><td>LINK ZA MAIL</td></tr>";
                }
            }
            ?>
        </table>

        <hr>



        <table class="table table-bordered">
            <th colspan="5"><a href="<?php echo site_url($kontroler . '/predavanja/'); ?>">Sva predavanja</a></th>

<?php
foreach ($iscitajPredavanje as $value) {
    if ($danasnjiDatum < $value['vreme_predavanja']) {

        echo "<tr><td><a href=" . site_url($kontroler . '/predavanjeDetaljnije/' . $value['idpredavanje']) . ">Detaljnije</a></td><td>" . $value['naslov_srpski'] . "</td><td>" . $value['vreme_predavanja'] . "</td><td>" . $value['sala'] . "</td><td>" . "<a href=" . site_url($kontroler . '/posaljiPredavanjeMejlom/' . $value['idpredavanje']) . ">Posalji studentima na mejl</a><br/>" . "</td></tr>";
    }
}
?>
        </table>

        <hr>


        <table class="table table-bordered">
            <th colspan="3"><?php echo "Oglasi: "; ?></th>
<?php
foreach ($iscitajOglase as $value) {
    //if($danasnjiDatum<$value['datum_unosenja']){      nemamo u bazi nijedno predavanje koje sledi tako da je zato ovo zakomentarisano...kad budemo imali oglase koji nisu istekli treba da se odkomentarise

    echo "<tr><td><a href=" . site_url($kontroler . '/oglasDetaljnije/' . $value['idoglas']) . ">" . $value['naziv'] . "</a>" . "</td><td>" . $value['datum_unosenja'] . "</td><td>" . "<a href=" . site_url($kontroler . '/posaljiOglasMejlom/' . $value['idoglas']) . ">Posalji studentima na mejl</a><br/>" . "</td></tr>";

    //}
}
?>
        </table>
</div>
    </div>

        <script type="text/javascript">

//            var item = 'item5<br><a href="http://visjs.org" target="_blank">click here</a>';

            // DOM element where the Timeline will be attached
            var container = document.getElementById('visualization');

            // Create a DataSet (allows two way data-binding)
            var items = new vis.DataSet([
<?php
for ($i = 0; $i < count($partnerIsticeUgovor); $i++) {
    if (($partnerIsticeUgovor[$i]['datum_isticanja'] < $datum) && $partnerIsticeUgovor[$i]['datum_isticanja'] > $danasnjiDatum) {
        ?>
                        {id: <?php echo $i; ?>, content: '<?php echo $partnerIsticeUgovor[$i]["naziv"] . " - " . $partnerIsticeUgovor[$i]["naziv_paketa"];?>
            <a href="<?php echo site_url("$kontroler/dosije/". $partnerIsticeUgovor[$i]["naziv"]);?>" target="_blank">dosije</a>', start: '<?php echo $partnerIsticeUgovor[$i]["datum_isticanja"]; ?>'},
        <?php
    }
}
?>
                // {id: 2, content: 'item 2', start: '2014-04-14'},
                // {id: 3, content: 'item 3', start: '2014-04-18'},
                // {id: 4, content: 'item 4', start: '2014-04-16', end: '2014-04-19'},
                // {id: 5, content: 'item 5', start: '2014-04-25'},
                // {id: 6, content: 'item 6', start: '2014-04-27', type: 'point'} 
            ]);

            // Configuration for the Timeline
            var options = {};

            // Create a Timeline
            var timeline = new vis.Timeline(container, items, options);
        </script>