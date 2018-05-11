
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
        foreach ($paketi as $value) {
            foreach ($value as $nazivPaketa) {
                ?>
                <li>
                    <a href="#<?php echo $nazivPaketa;?>"><?php echo $nazivPaketa . "<br />"; ?></a>
                </li>
                <?php
            }
        }
    }
    ?>
</ul>
<?php
foreach ($naziv as $partner) {
        ?>
<span style="font-size: large; font-weight: bold;"> <a name="<?php echo $partner['naziv_paketa'];?>"><?php echo $partner['naziv_paketa'] . "<br />"; ?></a></span>
        <table>
            <tr>
                <th>
                    <?php echo $partner['naziv'] . "<br />"; ?>
                </th>
            </tr>
            <tr><td>1</td></tr>
<tr><td>1</td></tr><tr><td>1</td></tr><tr><td>1</td></tr><tr><td>1</td></tr><tr><td>1</td></tr><tr><td>1</td></tr><tr><td>1</td></tr><tr><td>1</td></tr><tr><td>1</td></tr><tr><td>1</td></tr><tr><td>1</td></tr><tr><td>1</td></tr>
            <tr>
                <td>
                    <?php echo $partner['opis'] . "<br />"; ?>
                </td>
            </tr>
        </table>
        <?php
}
?>
