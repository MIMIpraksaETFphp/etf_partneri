
<?php
echo form_open("Gost/index", "method=post");
echo "Pretraga kompanije po nazivu";
echo "<br />";
echo form_input("kompanija", set_value("kompanija"));
echo form_submit("pronadji", "Pronadji");
echo form_close();
?>
<br />
<?php if (isset($paketi)) { ?>
    <ul>
        <?php
        foreach ($paketi as $paket) {
            $naziv_paketa=$paket['naziv_paketa'];
            if(!empty($partneri[$naziv_paketa])) {
                ?>
                <li>
                    <a href="#<?php echo $paket['naziv_paketa']; ?>"><?php echo $paket['naziv_paketa'] . "<br />"; ?></a>
                </li>
                <?php
            }
            else {
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
//foreach ($partneri as $partner) {
//?>
<!--<span style="font-size: large; font-weight: bold;"> <a name="--><?php //echo $partner['naziv_paketa'];?><!--">--><?php //echo $partner['naziv_paketa'] . "<br />"; ?><!--</a></span>-->
<!---->
<!---->
<!--    <table>-->
<!--        <tr>-->
<!--            <th>-->
<!--                --><?php //echo $partner['naziv'] . "<br />"; ?>
<!--            </th>-->
<!--        </tr>-->
<!--        <tr><td>1</td></tr>-->
<!--<tr><td>1</td></tr><tr><td>1</td></tr><tr><td>1</td></tr><tr><td>1</td></tr><tr><td>1</td></tr><tr><td>1</td></tr><tr><td>1</td></tr><tr><td>1</td></tr><tr><td>1</td></tr><tr><td>1</td></tr><tr><td>1</td></tr><tr><td>1</td></tr>-->
<!--        <tr>-->
<!--            <td>-->
<!--                --><?php //echo $partner['opis'] . "<br />"; ?>
<!--            </td>-->
<!--        </tr>-->
<!--    </table>-->
<?php
//}


foreach ($paketi as $paket) {
//    var_dump($filtriraniPartneri);
    $naziv_paketa=$paket['naziv_paketa'];
    $filtriraniPartneri=$partneri[$naziv_paketa];
    if(!empty($filtriraniPartneri)){
?>
        <h3><a name="<?php echo $paket['naziv_paketa']; ?>"><?php echo $paket['naziv_paketa'];?></a></h3>
<?php
        foreach ($filtriraniPartneri as $filtriraniPartner) {
            echo $filtriraniPartner['naziv']."<br/>".$filtriraniPartner['opis']."<br/>";
        }
        echo "<br/><br/>";
    }
}
?>
