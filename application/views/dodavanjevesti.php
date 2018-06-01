<?php
   // echo validation_errors();

    echo form_open_multipart("Korisnik/dodavanjeVesti","method=post");    
    echo "Naslov:";
    echo form_input("naziv",set_value("naziv")); 
    echo form_error("naziv",'<span style="color:red">','</span>');
    echo "<br>Sadrzaj:";
    ?>
<input type="text" name="sadrzaj" value="<?php echo set_value("sadrzaj")?>"/>
<?php   
    echo form_error("sadrzaj",'<span style="color:red">','</span>');
    echo "<br>";
    ?>
<input type="file" name="slika" size="20" /><br>
<?php
    echo form_submit("dodaj", "Dodaj");
    echo form_close();
?>
