<br />
<?php
echo form_open("$kontroler/partneri/", "method=post");
echo "Pretraga partnera po nazivu<br />";
echo "<br />";
echo form_input(array(
  'name' => 'kompanija',
  'value' => '',
  'placeholder' => 'Naziv kompanije',
));
echo form_submit("pronadji", "Pronadji");
echo form_close();
?>
<br />
<?php if (isset($paketi)) { ?>

    <ul class="list-unstyled" style="font-size:24px">
        <?php
        foreach ($paketi as $paket) {

            $naziv_paketa = $paket['naziv_paketa'];
            if (!empty($partneri[$naziv_paketa])) {
                ?>
                <li>
                    <a href="#<?php echo $paket['naziv_paketa']; ?>"><?php echo $paket['naziv_paketa'] . "<br />"; ?></a>
                </li>
                <?php
            } else {
                ?>
                <li>
                    <span href="#<?php echo $paket['naziv_paketa']; ?>"><?php echo $paket['naziv_paketa'] . " - nema partnera<br />"; ?></span>
                </li>
                <?php
            }
        }
    }
    ?>
</ul>
<?php
foreach ($paketi as $paket) {
    $naziv_paketa = $paket['naziv_paketa'];
    $filtriraniPartneri = $partneri[$naziv_paketa];
   //   var_dump($filtriraniPartneri);
    if (!empty($filtriraniPartneri)) {
        ?>
        <h1><a name="<?php echo $paket['naziv_paketa']; ?>"><?php echo $paket['naziv_paketa']; ?></a></h1>
        <?php
        foreach ($filtriraniPartneri as $filtriraniPartner) {
            ?>
        <a href="<?php echo $filtriraniPartner['veb_adresa'];?>" target="_blank">
            <img src="<?php echo base_url($filtriraniPartner['putanja']);?>" style="vertical-align: middle; border-style: none; 
                 width: 350px; height: 105px; margin-left: 350px;">
        </a><br />
            <?php
            echo "<p>".$filtriraniPartner['opis'] . "</p><br />";
        }
        echo "<br/><br/>";
    }
}
?>
