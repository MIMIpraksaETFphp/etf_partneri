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
                                    <input class="form-control" placeholder="Korisnicko ime" name="username" type="text" value="<?php echo set_value('username');?>" autofocus>
                                </div>
                                <?php echo form_error('username'); ?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Lozinka" name="password" type="password" value="">
                                </div>
                                <?php echo form_error('password'); ?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Potvrdi Lozinku" name="confirm_password" type="password" value="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Ime" name="ime" type="text" value="<?php echo set_value('ime');?>">
                                </div>
                                <?php echo form_error('ime'); ?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Prezime" name="prezime" type="text" value="<?php echo set_value('prezime');?>">
                                </div>
                                <?php echo form_error('prezime'); ?>
                                <div class="form-group">
                                    <label for="sel1">Datum rodjenja:</label>
                                    <input class="form-control" placeholder="Datum rodjenja" name="datum_rodjenja" type="date" value="<?php echo set_value('datum_rodjenja');?>">
                                </div>
                                <?php echo form_error('datum_rodjenja'); ?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Telefon" name="telefon" type="number" value="<?php echo set_value('telefon');?>">
                                </div>
                                <?php echo form_error('telefon'); ?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="email" name="email" type="text" value="<?php echo set_value('email');?>">
                                </div>
                                <?php echo form_error('email'); ?>
                                
                                <?php
                                if ($this->session->userdata('korisnik') != null) {
                                    if ($this->session->userdata('korisnik')->status_korisnika_idtable1 == 4) {
                                        ?> 
                                        <div class="form-group">
                                            <label for="sel1">Status korisnika:</label>
                                            <select class="form-control" style="width: 100%" name="status_korisnika_idtable1">
                                                <option value="2">Clan tima</option>
                                                <option value="3">IT menadzer</option>
                                                <option value="4">Admin</option>
                                            </select>
                                        </div>

                                        <?php
                                        echo "<input type='submit' value='Posalji mail registrovanom korisniku'><br /><br />";
                                    }
                                }
                                ?>
                                
                                <input class="btn btn-lg btn-success btn-block" type="submit" value="Registruj se" name="registruj_se" >
                              <?php  if ($this->session->userdata('korisnik') != null) {
                                    if ($this->session->userdata('korisnik')->status_korisnika_idtable1 == 4) {
                                        echo "<br/><h5><a href=" . site_url($kontroler.'/promenaStatusa') .">Promena Statusa Korisnika</h5></a><br /><br />";
                                             }
                                }
                                ?>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>





</span>