
<?php echo "partneri";?>
<?php
echo form_open("Gost/prikaziPartnere", "method=post");
echo "Pretraga kompanije po nazivu";
echo "<br />";
echo form_input("kompanija", set_value("kompanija")); 
echo form_submit("pronadji", "Pronadji");
echo form_close();
?>
<table>
    <tr>
        <th></th>
    </tr>
</table>

