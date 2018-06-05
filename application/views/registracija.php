<br/>
<span style="background-color:red;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="login-panel panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title col-md-12 col-md-offset-4">Registracija korisnika</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="<?php echo site_url("$kontroler/registruj_se"); ?>">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control col-md-6" placeholder="Korisničko ime" name="username" type="text" value="<?php echo set_value('username'); ?>" autofocus>
                                    <span class="message col-md-6"><?php echo form_error('username'); ?></span>
                                </div>  
                                <div class="form-group">
                                    <input class="form-control col-md-6" placeholder="Lozinka" name="password" type="password" value="">
                                    <span class="message col-md-6"><?php echo form_error('password'); ?></span>
                                </div>
                                <div class="form-group">
                                    <input class="form-control col-md-6" placeholder="Potvrdi Lozinku" name="confirm_password" type="password" value="">
                                    <span class="message col-md-6"><?php echo form_error('confirm_password'); ?></span>
                                </div>
                                <div class="form-group">
                                    <input class="form-control col-md-6" placeholder="Ime" name="ime" type="text" value="<?php echo set_value('ime'); ?>">
                                    <span class="message col-md-6"><?php echo form_error('ime'); ?></span>
                                </div>
                                <div class="form-group">
                                    <input class="form-control col-md-6" placeholder="Prezime" name="prezime" type="text" value="<?php echo set_value('prezime'); ?>">
                                    <span class="message col-md-6"><?php echo form_error('prezime'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="sel1">Datum rodjenja:</label><br />
                                    <input class="form-control col-md-6" placeholder="Datum rodjenja" name="datum_rodjenja" type="date" value="<?php echo set_value('datum_rodjenja'); ?>">
                                    <span class="message col-md-6"><?php echo form_error('datum_rodjenja'); ?></span>
                                </div>
                                <div class="form-group">
                                    <input class="form-control col-md-6" placeholder="Telefon" name="telefon" type="number" value="<?php echo set_value('telefon'); ?>">
                                    <span class="message col-md-6"><?php echo form_error('telefon'); ?></span>
                                </div>
                                <div class="form-group">
                                    <input class="form-control col-md-6" placeholder="Email" name="email" type="text" value="<?php echo set_value('email'); ?>">
                                    <span class="message col-md-6"><?php echo form_error('email'); ?></span>
                                </div>
                                <?php
                                if ($this->session->userdata('korisnik') != null) {
                                    if ($this->session->userdata('korisnik')->status_korisnika_idtable1 == 4) {
                                        ?> 
                                        <div class="form-group">
                                            <label for="sel1">Status korisnika:</label><br />
                                            <select class="form-control col-md-6" style="width: 100%" name="status_korisnika_idtable1">
                                                <option value="2">Član tima</option>
                                                <option value="3">IT menadžer</option>
                                                <option value="4">Admin</option>
                                            </select>
                                        </div>
                                        <br />
                                        <?php
                                    }
                                }
                                ?>
                                <div class="form-group">
                                    <input class="btn btn-lg btn-success btn-block col-md-2" type="submit" value="Registruj se" name="registruj_se" >
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</span>