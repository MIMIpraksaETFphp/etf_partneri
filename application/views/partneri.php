
<?php
echo form_open("Gost/index", "method=post");
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
            ?>
            <li>
                <a href="#<?php echo $paket['naziv_paketa']; ?>"><?php echo $paket['naziv_paketa'] . "<br />"; ?></a>
            </li>
            <?php
        }
    }
    ?>
</ul>
<?php
//foreach ($partneri as $partner) {
//
?>
<!--<span style="font-size: large; font-weight: bold;"> <a name="--><?php //echo $partner['naziv_paketa']; ?><!--">--><?php //echo $partner['naziv_paketa'] . "<br />";  ?><!--</a></span>-->
<!---->
<!---->
<!--    <table>-->
<!--        <tr>-->
<!--            <th>-->
<!--                --><?php //echo $partner['naziv'] . "<br />";  ?>
<!--            </th>-->
<!--        </tr>-->
<!--        <tr><td>1</td></tr>-->
<!--<tr><td>1</td></tr><tr><td>1</td></tr><tr><td>1</td></tr><tr><td>1</td></tr><tr><td>1</td></tr><tr><td>1</td></tr><tr><td>1</td></tr><tr><td>1</td></tr><tr><td>1</td></tr><tr><td>1</td></tr><tr><td>1</td></tr><tr><td>1</td></tr>-->
<!--        <tr>-->
<!--            <td>-->
<!--                --><?php //echo $partner['opis'] . "<br />";  ?>
<!--            </td>-->
<!--        </tr>-->
<!--    </table>-->
<?php if(isset($rezultatKompanija)){
     foreach ($rezultatKompanija as $value){
         echo $value['naziv_paketa']."<br />";
         echo $value['naziv']."<br />";
         echo $value['opis']."<br />";
     }
} else {
foreach ($paketi as $paket) {
    ?>
<a name="<?php echo $paket['naziv_paketa']; ?>"><span style="font-size: large; font-weight: bold;">
    <?php echo $paket['naziv_paketa']; ?></span><a/><br/>
        <?php 
    $filter = array($paket['naziv_paketa']);
        $filtriraniPartneri = array_filter($partneri, function ($s) use ($filter) {
            return in_array($s['naziv_paketa'], $filter); });
        if (!empty($filtriraniPartneri)) {
            foreach ($filtriraniPartneri as $filtriraniPartner) {
                if (isset($filtriraniPartner['naziv'])) {
                    echo $filtriraniPartner['naziv'] . "<br/>" . $filtriraniPartner['opis'] . "<br/>";
                }
                echo "<br/><br/>";
            }
        }
    }
}
    ?>
