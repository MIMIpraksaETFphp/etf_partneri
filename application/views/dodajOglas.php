<?php 
// var_dump($partneriKorisnika);
?>
<br />
<div class="row">
    <div class="col-md-12">
        <div class="login-panel panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title col-md-12 col-md-offset-4">Dodaj Oglas</h3>
            </div>
            <div class="panel-body">
                <?php echo form_open_multipart("$kontroler/dodavanjeOglasa", "method=post"); ?>
                <fieldset>
                    <div class="form-group">
                        <input class="form-control col-md-6" placeholder="Naslov Oglasa" name="oglasnaslov" type="text" value="<?php echo set_value('oglasnaslov'); ?>" autofocus>
                        <span class="message col-md-6"><?php echo form_error('oglasnaslov'); ?></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="oglastext">Tekst Oglasa</label>
                        <textarea class="form-control col-md-6" rows="10" name="oglastext" id="oglastext"><?php echo set_value('oglastext'); ?></textarea>
                        <script>
                            CKEDITOR.replace("oglastext");
                        </script>        
                    </div>
                    <span class="message col-md-6"><?php echo form_error('oglastext'); ?></span>
                    <div class="form-group"> 
                        <label><input name="praksa" type="checkbox" value="1" checked>Praksa</label>
                    </div>
                    <div class="form-group"> 
                        <label><input name="zaposlenje" type="checkbox" value="1">Zaposlenje</label>
                    </div>
                    <input type="hidden" name="datum_unosenja" value="<?php echo mdate('%Y-%m-%d %H:%i:%s', now()); ?>"/>
                    <div class="form-group">
                        <label>Naziv Partnera</label><br />
                        <select name="id_partnera" class="form-control col-md-6">
                        <?php                        
                            foreach ($partneriKorisnika as $partnerKorisnika) {
                        ?>
                                <option value="<?php echo $partnerKorisnika['idPartner']; ?>"><?php echo $partnerKorisnika['naziv']; ?></option>                                
                        <?php
                            }
                        ?>                       
                        </select>
                    </div>
                    <br />
                    <div class="form-group">
                        File: <input type="file" name="fajl" /><br>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-lg btn-success btn-block col-md-2" type="submit" value="Dodaj Oglas" name="dodavanjeOglasa" >
                    </div>
                </fieldset>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
