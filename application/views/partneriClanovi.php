<?php 
echo "<br />";
echo form_open("$kontroler/part/", "method=get");
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
echo form_label(form_checkbox( array(
    'name'        => 'vazeciUgovor',
    'value'       => '1',
) ) . ' Važeci ugovori' );
echo "<br /><br />";
echo form_submit("pronadji", "Pronadji");
echo "<br /><br />";
echo form_close();
var_dump($ukupanBroj);
echo "<br />";
echo "<br />";
    
foreach ($rezultat as $kompanija){ ?>
<a href="<?php echo site_url("$kontroler/dosije/".$kompanija['naziv']);?>"><?php echo $kompanija['naziv']; ?></a>

    <br />
    <?php } ?>
<div class="pagination">
<?php if(isset($links)) 
    { echo $links; }?>
</div>
<br /><br />
