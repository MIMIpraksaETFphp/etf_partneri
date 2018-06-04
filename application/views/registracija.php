<br/>
<span style="background-color:red;">
    <div class="container"><!-- container class is used to centered  the body of the browser with some decent width-->
        <div class="row"><!-- row class is used for grid system in Bootstrap-->
            <div class="col-md-4 col-md-offset-4"><!--col-md-4 is used to create the no of colums in the grid also use for medimum and large devices-->
                <div class="login-panel panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Registracija korisnika</h3>
                    </div>
                    <div class="panel-body">

                        <form role="form" method="post" action="<?php echo site_url("$kontroler/registruj_se"); ?>">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Korisničko ime" name="username" type="text" value="<?php echo set_value('username');?>" autofocus>
                                </div>
                                <span style="color: red;"><?php echo form_error('username'); ?></span>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Lozinka" name="password" type="password" value="">
                                </div>
                                <span style="color: red;"><?php echo form_error('password'); ?></span>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Potvrdi Lozinku" name="confirm_password" type="password" value="">
                                </div>
                                <span style="color: red;"><?php echo form_error('confirm_password'); ?></span>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Ime" name="ime" type="text" value="<?php echo set_value('ime');?>">
                                </div>
                                <span style="color: red;"><?php echo form_error('ime'); ?></span>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Prezime" name="prezime" type="text" value="<?php echo set_value('prezime');?>">
                                </div>
                                <span style="color: red;"><?php echo form_error('prezime'); ?></span>
                                <div class="form-group">
                                    <label for="sel1">Datum rodjenja:</label>
                                    <input class="form-control" placeholder="Datum rodjenja" name="datum_rodjenja" type="date" value="<?php echo set_value('datum_rodjenja');?>">
                                </div>
                                <span style="color: red;"><?php echo form_error('datum_rodjenja'); ?></span>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Telefon" name="telefon" type="number" value="<?php echo set_value('telefon');?>">
                                </div>
                                <span style="color: red;"><?php echo form_error('telefon'); ?></span>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Email" name="email" type="text" value="<?php echo set_value('email');?>">
                                </div>
                                <span style="color: red;"><?php echo form_error('email'); ?></span>
                                
                                <?php
                                if ($this->session->userdata('korisnik') != null) {
                                    if ($this->session->userdata('korisnik')->status_korisnika_idtable1 == 4) {
                                        ?> 
                                        <div class="form-group">
                                            <label for="sel1">Status korisnika:</label>
                                            <select class="form-control" style="width: 100%" name="status_korisnika_idtable1">
                                                <option value="2">Član tima</option>
                                                <option value="3">IT menadžer</option>
                                                <option value="4">Admin</option>
                                            </select>
                                        </div>

                                        <?php
                                    }
                                }
                                ?>
                                <input class="btn btn-lg btn-success btn-block" type="submit" value="Registruj se" name="registruj_se" >
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>





</span>