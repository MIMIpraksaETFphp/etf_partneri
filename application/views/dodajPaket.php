<!--<script type="text/javascript">
    var br = 0;
    function dodaj_polje() {
        br++;
        var a = document.getElementById('stavka').value;
        document.getElementById('forma').innerHTML += '<input class="form-control " style="width: 1000px" type="text" name="stavka[]" placeholder="Uneti stavku" id="stavka'+br+'" value="' + a + '" readonly/><button type="button" class="mb-4" onclick="ukloni('+br+')" id="dugme'+br+'">Ukloni</button>';
        document.getElementById('dodajDugme').disabled = true;
    }
    function omoguci() {
        document.getElementById('dodajDugme').disabled = false;
    }
    function ukloni(br) {
            var stavka = document.getElementById("stavka"+br);
            var dugme = document.getElementById("dugme"+br);
            var forma = document.getElementById("forma");
            forma.removeChild(stavka);
            forma.removeChild(dugme);
    }
</script>-->
<?php //var_dump($stavkeUbazi);?>
<!--<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-success">-->
<div class="panel-heading">
    <h3 class="panel-title">Dodaj Paket</h3>
</div>
<div class="panel-body">
    <?php echo form_open("Admin/dodavanjePaketa", "method=post"); ?>
    <!--<fieldset>-->
    <div class="form-group">
        <label for="naziv">Naziv Paketa</label>
        <input class="form-control" type="text" name="naziv" placeholder="Uneti naziv Paketa" id="naziv">
    </div>
    <?php // echo form_error('paketnaslov'); ?>
    <div class="form-group">
        <label for="vrednost">Vrednost Paketa u EUR</label><br />
        <input class="form-control" type="number" name="vrednost" placeholder="Uneti vrednost Paketa u EUR" id="vrednost" min="0">
    </div>
    <div class="form-group">
        <label for="trajanje">Trajanje ugovora</label><br />
        <input class="form-control" type="number" name="trajanje" placeholder="Uneti godine trajanja ugovora" id="trajanje" min="0">
    </div>
    <div class="form-group">
        <label for="maxbroj">Maksimalni broj kompanija u paketu</label><br />
        <input class="form-control" type="number" name="maxbroj" placeholder="Uneti max broj kompanija u paketu" id="maxbroj" min="0">
    </div>
    <div class="form-group">
        <label for="stavkeUbazi">Izaberite stavke paketa:</label><br />
        <?php for ($i = 0; $i < count($stavkeUbazi); $i++) { ?>
            <input type="checkbox" name="stavkeUbazi[]" value="<?php echo $stavkeUbazi[$i]['idstavke'];?>" id="stavke<?php echo $i; ?>"> <label for="stavke<?php echo $i;?>"><?php echo $stavkeUbazi[$i]['opis']; ?></label><br /> 
            <!--for($i) umesto foreach() zbog label taga-->
        <?php } ?>
    </div>
    <!--                    <div class="form-group">
                            <label for="stavka">Tekst nove stavke Paketa</label><br />
                            <input type="button" id="dodajDugme" onclick="dodaj_polje()" value="Dodaj polje" disabled="disabled"/>
                            <div  id="forma"> 
                                <input class="form-control" style="width: 1000px" type="text" name="stavka[]" placeholder="Uneti stavku" id="stavka" onkeyup="omoguci()"><br />
                            </div>
                        </div>-->

    <input class="btn btn-lg btn-success " type="submit" value="Dodaj Paket" name="dodavanjePaketa"/>

    <!--                </fieldset>-->
    <?php echo form_close(); ?>
    <br/> 
    <?php echo form_open("Admin/dodavanjeStavke", "method=post"); ?>
    <div class="form-group">
        <label for="novaStavka">Nova Stavka</label><br />
        <input class="form-control" type="text" name="novaStavka" placeholder="Uneti novu Stavku" id="novaStavka"><br />
        <input class="btn btn-lg btn-success " type="submit" value="Dodaj Stavku" name="dodavanjeStavke"/>
    </div>
    <?php if (isset($message)) { ?>
        <script type='text/javascript'>alert('<?php echo $message; ?>')</script>
    <?php } ?>
    <?php echo form_close(); ?>
    <!--            </div>
            </div>
        </div>-->
</div>

