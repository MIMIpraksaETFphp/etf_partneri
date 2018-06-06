<br />
<span style="background-color:red;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="login-panel panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title col-md-12 col-md-offset-4">Dodaj Predavanje</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo form_open_multipart("$kontroler/dodavanjePredavanja", "method=post"); ?>
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control col-md-6" placeholder="Naslov Predavanja" name="naslov_srpski" type="text" value="<?php echo set_value('naslov_srpski'); ?>" autofocus>
                                <span class="message col-md-6"><?php echo form_error('naslov_srpski'); ?></span>
                            </div>
                            <div class="form-group">
                                <input class="form-control col-md-6" placeholder="Naslov Predavanja Engleski" name="naslov_engleski" type="text" value="<?php echo set_value('naslov_engleski'); ?>">
                            </div>
                            <div class="form-group col-md-6">
                                Opis predavanja(srpski)
                                <textarea class="form-control col-md-6" rows="10" name="opis_srpski"><?php echo set_value('opis_srpski'); ?></textarea>
                                <script>
                                    CKEDITOR.replace("opis_srpski");
                                </script>
                            </div>
                            <span class="message col-md-6"><?php echo form_error('opis_srpski'); ?></span>

                            <div class="form-group col-md-6">
                                Opis predavanja(engleski)
                                <textarea class="form-control col-md-6" rows="10" name="opis_engleski" ><?php echo set_value('opis_engleski'); ?></textarea>
                                <script>
                                    CKEDITOR.replace("opis_engleski");
                                </script>
                            </div>
                            <div class="form-group">
                                <label>Vreme predavanja</label><br />
                                <input class="form-control col-md-6" placeholder="Vreme predavanja" name="vreme_predavanja" type="date" value="<?php echo set_value('vreme_predavanja'); ?>">
                                <span class="message col-md-6"><?php echo form_error('vreme_predavanja'); ?></span>
                            </div>
                            <div class="form-group">
                                <input class="form-control col-md-6" placeholder="Sala" name="sala" type="text" value="<?php echo set_value('sala'); ?>">
                                <span class="message col-md-6"><?php echo form_error('sala'); ?></span>
                            </div>
                            <div class="form-group">
                                <input class="form-control col-md-6" placeholder="Ime predavača" name="ime_predavaca" type="text" value="<?php echo set_value('ime_predavaca'); ?>">
                                <span class="message col-md-6"><?php echo form_error('ime_predavaca'); ?></span>
                            </div>
                            <div class="form-group">
                                <input class="form-control col-md-6" placeholder="Prezime predavača" name="prezime_predavaca" type="text" value="<?php echo set_value('prezime_predavaca'); ?>">
                                <span class="message col-md-6"><?php echo form_error('prezime_predavaca'); ?></span>
                            </div>
                            <div class="form-group col-md-6">
                                CV predavača(srpski)
                                <textarea class="form-control col-md-6" rows="10" name="cv_srpski"><?php echo set_value('prezime_predavaca'); ?></textarea>
                                <script>
                                    CKEDITOR.replace("cv_srpski");
                                </script>
                            </div>
                            <div class="form-group col-md-6">
                                CV predavača(engleski)
                                <textarea class="form-control col-md-6" rows="10" name="cv_engleski"><?php echo set_value('prezime_predavaca'); ?></textarea>
                                <script>
                                    CKEDITOR.replace("cv_engleski");
                                </script>
                            </div>
                            <div class="form-control col-md-6">
                                <label>Naziv Partnera</label>
                                <select name="id_partnera" class="form-control">
                                    <?php 
                                    if($this->session->korisnik->status_korisnika_idtable1 == 2){
                                        foreach ($partneriKorisnika as $partnerKorisnika) {
                                    ?>
                                            <option value="<?php echo $partnerKorisnika['idPartner']; ?>"><?php echo $partnerKorisnika['naziv']; ?></option>                                
                                    <?php
                                        }
                                    }
                                    else{
                                        foreach ($partneriPredavanja as $partneriPredavanje) {
                                    ?>
                                            <option value="<?php echo $partneriPredavanje['idPartner']; ?>"><?php echo $partneriPredavanje['naziv']; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div><br /><br /><br /><br />
                            <div class="form-group">
                                <input class="btn btn-lg btn-success btn-block col-md-3" type="submit" value="Dodaj Predavanje" name="dodavanjePredavanja" >
                            </div>
                        </fieldset>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</span>