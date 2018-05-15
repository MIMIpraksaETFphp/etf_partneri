
<?php
echo form_open("$kontroler/$metoda/", "method=post");
echo "Pretraga kompanije po nazivu";
echo "<br />";
echo form_input("kompanija");
echo form_submit("pronadji", "Pronadji");
echo form_close();
?>
<br />
<?php if (isset($paketi)) { ?>
    <ul>
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
    //    var_dump($filtriraniPartneri);
    if (!empty($filtriraniPartneri)) {
        ?>
        <h1><a name="<?php echo $paket['naziv_paketa']; ?>"><?php echo $paket['naziv_paketa']; ?></a></h1>
        <?php
        foreach ($filtriraniPartneri as $filtriraniPartner) {
            ?>
        <a href="<?php echo $filtriraniPartner['veb_adresa'];?>" target="_blank">
            <img src="<?php echo base_url($filtriraniPartner['putanja']);?>" style="vertical-align: middle; border-style: none; 
                 width: 350px; height: 95px; margin-left: 350px;">
        </a><br />
            <?php
            echo "<p>".$filtriraniPartner['opis'] . "</p><br />";
        }
        echo "<br/><br/>";
    }
}
?>
