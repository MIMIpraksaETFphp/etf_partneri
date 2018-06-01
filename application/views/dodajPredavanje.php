<br />
<span style="background-color:red;">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Dodaj Predavanje</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo form_open_multipart("$kontroler/dodavanjePredavanja","method=post");?>
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Naslov Predavanja" name="naslov_srpski" type="text" value="<?php echo set_value('naslov_srpski');?>" autofocus>
                                </div>
                                <span style="color: red;"><?php echo form_error('naslov_srpski'); ?></span>

                                <div class="form-group">
                                    <input class="form-control" placeholder="Naslov Predavanja Engleski" name="naslov_engleski" type="text" value="<?php echo set_value('naslov_engleski');?>">
                                </div>
                                <div class="form-group">
                                 Opis predavanja(srpski)
                                 <textarea class="form-control" rows="10" name="opis_srpski"><?php echo set_value('opis_srpski');?></textarea>
                                </div>
                                <span style="color: red;"><?php echo form_error('opis_srpski'); ?></span>
                                
                                <div class="form-group">
                                 Opis predavanja(engleski)
                                    <textarea class="form-control" rows="10" name="opis_engleski" ><?php echo set_value('opis_engleski');?></textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label>Datum predavanja</label>
                                    <input class="form-control" placeholder="Vreme predavanja" name="vreme_predavanja" type="date" value="<?php echo set_value('vreme_predavanja');?>">
                                </div>
                                <span style="color: red;"><?php echo form_error('vreme_predavanja'); ?></span>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Sala" name="sala" type="text" value="<?php echo set_value('sala');?>">
                                </div>
                                <span style="color: red;"><?php echo form_error('sala');?></span>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Ime predavaca" name="ime_predavaca" type="text" value="<?php echo set_value('ime_predavaca');?>">
                                </div>
                                <span style="color: red;"><?php echo form_error('ime_predavaca'); ?></span>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Prezime predavaca" name="prezime_predavaca" type="text" value="<?php echo set_value('prezime_predavaca');?>">
                                </div>
                                <span style="color: red;"><?php echo form_error('prezime_predavaca'); ?></span>
                                <div class="form-group">
                                 CV predavaca(srpski)
                                    <textarea class="form-control" rows="10" name="cv_srpski"><?php echo set_value('prezime_predavaca');?></textarea>
                                </div>
                                
                                <div class="form-group">
                                 CV predavaca(engleski)
                                    <textarea class="form-control" rows="10" name="cv_engleski"><?php echo set_value('prezime_predavaca');?></textarea>
                                </div>
                                
                                <div class="form-control">
                                    <label>Naziv Partnera</label>
                                    <select name="id_partnera" class="form-control">
                                        <?php foreach ($partneriPredavanja as $partneriPredavanje){ ?>
                                            <option value="<?php echo $partneriPredavanje['idPartner']; ?>"><?php echo $partneriPredavanje['naziv'];  ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <input class="btn btn-lg btn-success btn-block" type="submit" value="Dodaj Predavanje" name="dodavanjePredavanja" >
                                <br/><br/>
                            </fieldset>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</span>