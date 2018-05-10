<link rel="stylesheet" href="<?echo base_url()?>js/smoothness-jquery-ui.css"/> 
<script src="<?echo base_url()?>js/jquery-1.9.1.js"></script> 
<script src="<?echo base_rl()?>1.10.3-jquery-ui.js"></script>

<?php
echo form_open("Gost/registracija", "method=post");
echo "Korisnicko ime";
echo form_input("username", set_value('username'));
echo "<br/>Lozinka";
echo form_password("password", set_value('password'));
echo "<br/>Ponovi lozinku";
echo form_password("password", set_value('password'));
echo "<br/>Ime";
echo form_input("ime", set_value('ime'));
echo "<br/>Prezime";
echo form_input("prezime", set_value('prezime'));
echo "<br/>";
//echo "<br/>Datum rodjenja"; 
// ubacujemo jquery za datum rodjenja...ali ne izbacuje kao na slici na netu kalendar...
?>

<script type="text/javascript">
            $(function() {
                $("#datepicker").datepicker({
                    minDate : 0,
                    dateFormat: 'yy-mm-dd'
                });
                
            });
</script>
          <label id ="pdesc_txt">Datum rodjenja:</label>

            <input type="text" id="datepicker" placeholder="Pickup Date" name="Datum rodjenja"/>
            
<?php

echo "<br/>Telefon";
echo form_input("telefon", set_value('telefon'));
echo "<br/>e-mail";
echo form_input("mail", set_value('mail'));
echo "<br/>";
echo form_submit("registracija", "Registruj se");
echo form_close();

?>

