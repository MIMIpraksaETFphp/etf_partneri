<?php 
echo "<br />";
echo form_open("$kontroler/$metoda/", "method=get");
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
echo form_label( form_checkbox( array(
    'name'        => 'vazeciUgovor',
    'value'       => '1',
) ) . ' Vazeci ugovori' );
echo "<br /><br />";
echo form_submit("pronadji", "Pronadji");
echo "<br /><br />";
echo form_close();
var_dump($ukupanBroj);
echo "<br />";
//print_r($this->session->all_userdata());
echo "<br />";
    
foreach ($rezultat as $kompanija){ ?>
<a href="<?php echo site_url("Korisnik/dosije/".$kompanija['naziv']);?>"><?php echo $kompanija['naziv']; ?></a>

    <br />
    <?php } ?>
<div class="pagination">
<?php if(isset($links)) 
    { echo $links; }?>
</div>
<br /><br />
