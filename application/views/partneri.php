<br />
<?php
echo form_open("$kontroler/$metoda/", "method=post");
echo "Pretraga partnera po nazivu<br />";
echo "<br />";
echo form_input(array(
    'name' => 'kompanija',
//    'value' => '',
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
        <h1><a name="<?php echo $paket['naziv_paketa']; ?>"><?php
                echo ucfirst($paket['naziv_paketa']);
                if ($paket['naziv_paketa'] != "partneri" && $paket['naziv_paketa'] != "partneri katedre") {
                    echo " partneri";
                }
                if ($paket['naziv_paketa'] != "partneri katedre" && $paket['naziv_paketa'] != "ostali") {
                    echo " ETF-a";
                }
                ?></a></h1>
        <?php
        foreach ($filtriraniPartneri as $filtriraniPartner) {
            ?>
            <div class="<?php echo str_replace(' ', '_', $paket['naziv_paketa']); ?>">
                <a href="<?php echo $filtriraniPartner['veb_adresa']; ?>" target="_blank">
                    <?php if ($paket['naziv_paketa'] != "ostali") { ?>
                        <img src="<?php echo base_url($filtriraniPartner['putanja']); ?>"><br />
                    <?php } else {
                        echo $filtriraniPartner['naziv'];
                    }
                    ?>

                </a>
            </div>

            <?php
            if ($paket['naziv_paketa'] != "partneri" && $paket['naziv_paketa'] != "partneri katedre" && $paket['naziv_paketa'] != "ostali") {
                echo "<p>" . $filtriraniPartner['opis'] . "</p><br />";
            }
             echo "<br />";
        }
        echo "<br/>";
    }
}
?>
