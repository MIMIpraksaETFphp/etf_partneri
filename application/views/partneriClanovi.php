<?php 
echo "<br />";
echo form_open("$kontroler/$metoda/", "method=post");
echo "Pretraga po nazivu paketa";
echo "<br />";
echo form_input(array(
  'name' => 'paket',
  'value' => '',
  'placeholder' => 'Naziv paketa',
));
echo "<br /><br />";
echo "Pretraga po nazivu kompanije";
echo "<br />";
echo form_input(array(
  'name' => 'kompanija',
  'value' => '',
  'placeholder' => 'Naziv kompanije',
));
echo "<br /><br />";
echo form_checkbox(array(
    'name'        => 'vazeciUgovor',
    'value'       => 'accept',
));
echo "Vazeci ugovori";
echo "<br /><br />";
echo form_submit("pronadji", "Pronadji");
echo "<br /><br />";
echo form_close();

//var_dump($rezultat);

?>

    <?php foreach ($rezultat as $kompanija){ ?>
<table class="table">
    <tr>
        <th scope="col"><a href="#"><?php echo $kompanija['naziv']; ?></a></th>
    </tr>
    <tr>
        <td scope="row">PIB</td>
        <td scope="row">Adresa</td>
        <td scope="row">Grad</td>
        <td>Postanski broj</td>
        <td>Drzava</td>
        <td>Ziro racun</td>
        <td>Valuta racuna</td>
        <td>Kontakt osoba</td>
        <td>Telefon kontakt osobe</td>
        <td>Email kontakt osobe</td>
        <!--<td>Opis</td>-->
        <td>Web adresa</td>
    </tr>
    <tr>
        <td><?php echo $kompanija['PIB']; ?></td>
        <td><?php echo $kompanija['adresa']; ?></td>
        <td><?php echo $kompanija['grad']; ?></td>
        <td><?php echo $kompanija['postanski_broj']; ?></td>
        <td><?php echo $kompanija['drzava']; ?></td>
        <td><?php echo $kompanija['ziro_racun']; ?></td>
        <td><?php echo $kompanija['valuta_racuna']; ?></td>
        <td><?php echo $kompanija['ime_kontakt_osobe']." ". $kompanija['prezime_kontakt_osobe']; ?></td>
        <td><?php echo $kompanija['telefon_kontakt_osobe']; ?></td>
        <td><?php echo $kompanija['email_kontakt_osobe']; ?></td>
        <!--<td><?php echo $kompanija['opis']; ?></td>-->
        <td><?php echo $kompanija['veb_adresa']; ?></td>
    </tr>
    <tr>
        <td colspan="11"><?php echo $kompanija['opis']; ?></td>
    </tr>
    </table>
    <br />
    <?php } ?>
<div class="pagination">
<?php echo $links; ?>
</div>
<br /><br />
