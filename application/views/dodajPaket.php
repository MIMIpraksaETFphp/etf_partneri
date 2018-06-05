<br />
<div class="row">
    <div class="col-md-12">
        <div class="login-panel panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title col-md-12 col-md-offset-4">Dodaj Paket</h3>
            </div>
            <div class="panel-body">
                <?php echo form_open("Admin/dodavanjePaketa", "method=post"); ?>
                <div class="form-group">
                    <label for="naziv">Naziv Paketa</label><br />
                    <input class="form-control col-md-6" type="text" name="naziv" placeholder="Uneti naziv Paketa" id="naziv" value="<?php echo set_value('naziv'); ?>">
                    <span class="message col-md-6"><?php echo form_error('naziv'); ?></span>
                </div>
                <div class="form-group">
                    <label for="vrednost">Vrednost Paketa u EUR</label><br />
                    <input class="form-control col-md-6" type="number" name="vrednost" placeholder="Uneti vrednost Paketa u EUR" id="vrednost" min="0" value="<?php echo set_value('vrednost'); ?>">
                    <span class="message col-md-6"><?php echo form_error('vrednost'); ?></span>
                </div>
                <div class="form-group">
                    <label for="trajanje">Trajanje ugovora</label><br />
                    <input class="form-control col-md-6" type="number" name="trajanje" placeholder="Uneti godine trajanja ugovora" id="trajanje" min="0" value="<?php echo set_value('trajanje'); ?>">
                    <span class="message col-md-6"><?php echo form_error('trajanje'); ?></span>
                </div>
                <div class="form-group">
                    <label for="maxbroj">Maksimalni broj kompanija u paketu</label><br />
                    <input class="form-control col-md-6" type="number" name="maxbroj" placeholder="Uneti max broj kompanija u paketu" id="maxbroj" min="0" value="<?php echo set_value('maxbroj'); ?>">
                    <span class="message col-md-6"><?php echo form_error('maxbroj'); ?></span>
                </div>
                <div class="form-group">
                    <label for="stavkeUbazi">Izaberite stavke paketa:</label><br />
                    <?php for ($i = 0; $i < count($stavkeUbazi); $i++) { ?>
                        <input type="checkbox" name="stavkeUbazi[]" value="<?php echo $stavkeUbazi[$i]['idstavke']; ?>" id="stavke<?php echo $i; ?>"> <label for="stavke<?php echo $i; ?>"><?php echo $stavkeUbazi[$i]['opis']; ?></label><br /> 
                        <!--for($i) umesto foreach() zbog label taga-->
                    <?php } ?>
                </div>
                <div class="form-group">
                    <input class="btn btn-lg btn-success btn-block col-md-2" type="submit" value="Dodaj Paket" name="dodavanjePaketa"/>
                </div>
                <?php echo form_close(); ?>
                <br />
                <?php echo form_open("Admin/dodavanjeStavke", "method=post"); ?>
                <div class="form-group">
                    <label for="novaStavka">Nova Stavka</label><br />
                    <input class="form-control col-md-6" type="text" name="novaStavka" placeholder="Uneti novu Stavku" id="novaStavka" value="<?php echo set_value('novaStavka'); ?>">
                    <span class="message col-md-6"><?php echo form_error('novaStavka'); ?></span>
                </div>
                <div class="form-group">
                    <input class="btn btn-lg btn-success btn-block col-md-2" type="submit" value="Dodaj Stavku" name="dodavanjeStavke"/>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
