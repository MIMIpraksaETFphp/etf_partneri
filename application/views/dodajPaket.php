<script type="text/javascript">
    var br = 0;
    function dodaj_polje() {
        br++;
        var a = document.getElementById('stavka').value;
        document.getElementById('forma').innerHTML += '<input class="form-control " style="width: 1000px" type="text" name="stavka" placeholder="Uneti stavku" id="stavka'+br+'" value="' + a + '"/><button type="button" class="mb-4" onclick="ukloni('+br+')" id="dugme'+br+'">Ukloni</button>';
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
</script>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Dodaj Paket</h3>
            </div>
            <div class="panel-body">
                <?php echo form_open("Amin/dodavanjePaketa", "method=post"); ?>
                <fieldset>
                    <div class="form-group">
                        <label for="naziv">Naziv Paketa</label>
                        <input class="form-control" placeholder="Uneti naziv Paketa" name="naziv" type="text" id="naziv">
                    </div>
                    <?php // echo form_error('paketnaslov'); ?>
                    <div class="form-group">
                        <label for="vrednost">Vrednost Paketa</label><br />
                        <input class="form-control" type="number" name="vrednost" placeholder="Uneti vrednost Paketa" id="vrednost">
                    </div>

                    <div class="form-group" id="roditelj">
                        <label for="stavka">Tekst Stavke Paketa</label><br />
                        <input type="button" id="dodajDugme" onclick="dodaj_polje()" value="Dodaj polje" disabled="disabled"/>
                        <div  id="forma"> 
                            <input class="form-control" style="width: 1000px" type="text" name="stavka[]" placeholder="Uneti stavku" id="stavka" onkeyup="omoguci()"><br />
                        </div>
                    </div>
                    <?php // echo form_error('pakettext'); ?>

                    <!--                    <div class="checkbox">
                                            <label><input name="praksa" type="checkbox" value="1" checked>Praksa</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input name="zaposlenje" type="checkbox" value="1">Zaposlenje</label>
                                        </div>
                    <?php //echo form_error(''); ?>
                                        <input type="hidden" name="datum_unosenja" value="<?php echo mdate('%Y-%m-%d %H:%i:%s', now()); ?>"/>
                    
                                        <div class="form-control">
                                            <label>Naziv Partnera</label>
                                            <select name="id_partnera" class="form-control">
                    <?php foreach ($partneriOglasi as $partneriOglas) { ?>
                                                        <option value="<?php echo $partneriOglas['idPartner']; ?>"><?php echo $partneriOglas['naziv']; ?></option>
                    <?php } ?>
                                            </select>
                                        </div>-->
                    <!--
                                        <div class="form-group">
                                            Logo: <input type="file" name="fajl" /><br>
                                        </div>-->
                    <input class="btn btn-lg btn-success btn-block" type="submit" value="Dodaj Paket" name="dodavanjeOglasa" >

                </fieldset>
                <!--</form>-->
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

