
<span style="background-color:red;">
    <div class="container"><!-- container class is used to centered  the body of the browser with some decent width-->
        <div class="row"><!-- row class is used for grid system in Bootstrap-->
            <div class="col-md-4 col-md-offset-4"><!--col-md-4 is used to create the no of colums in the grid also use for medimum and large devices-->
                <div class="login-panel panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Dodaj Kompaniju</h3>
                    </div>
                    <div class="panel-body">

                        <?php echo form_open_multipart('Korisnik/dodajPartnera',"method=post"); ?>
<!--                        <form role="form" method="post" action="<?php //echo site_url('Korisnik/dodajPartnera'); ?>">-->
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Naziv" name="naziv" type="text" value="">
                                </div>
                                <?php echo form_error('naziv'); ?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Adresa" name="adresa" type="text" value="">
                                </div>
                                <?php echo form_error('adresa'); ?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Grad" name="grad" type="text" value="">
                                </div>
                                <?php echo form_error('grad'); ?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Postanski broj" name="postanski_broj" type="text" value="">
                                </div>
                                <?php echo form_error('postanski_broj'); ?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Drzava" name="drzava" type="text" value="">
                                </div>
                                <?php echo form_error('drzava'); ?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Ziro racun" name="ziro_racun" type="text" value="">
                                </div>
                                <?php echo form_error('ziro_racun'); ?>
                                <div class="form-group">
                                    <label for="sel1">Valuta:</label>
                                    <select class="form-control" style="width: 100%" name="valuta_racuna">
                                      <option value="RSD">RSD</option>
                                      <option value="EUR">EUR</option>
                                      <option value="USD">USD</option>
                                    </select>
                                </div>
                                <br/>
                                <?php echo form_error('valuta_racuna'); ?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="PIB" name="PIB" type="number" value="">
                                </div>
                                <?php echo form_error('PIB'); ?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Telefon1" name="telefon1" type="text" value="">
                                </div>
                                <?php echo form_error('telefon1'); ?>
                                               <div class="form-group">
                                                   <input class="form-control" placeholder="Telefon2" name="telefon2" type="text" value="">
                                               </div><!--
                                <?php echo form_error('telefon2'); ?>              -->
                                <div class="form-group">
                                    <input class="form-control" placeholder="email1" name="email1" type="text" value="">
                                </div>
                                <?php echo form_error('email1'); ?>
                                                <div class="form-group">
                                                    <input class="form-control" placeholder="email2" name="email2" type="text" value="">
                                                </div>
                                <?php echo form_error('email2'); ?>
                                                <div class="form-group">
                                                    <input class="form-control" placeholder="email3" name="email3" type="text" value="">
                                                </div>
                                <?php echo form_error('email3'); ?>
                                                <div class="form-group">
                                                    <input class="form-control" placeholder="email4" name="email4" type="text" value="">
                                                </div>
                                <?php echo form_error('email4'); ?>
                                                <div class="form-group">
                                                    <input class="form-control" placeholder="email5" name="email5" type="text" value="">
                                                </div>
                                <?php echo form_error('email5'); ?>             
                               <div class="form-group">
                                    <input class="form-control" placeholder="Opis" name="opis" type="text" value="">
                                </div>
                                <?php echo form_error('opis'); ?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Veb adresa" name="veb_adresa" type="text" value="">
                                </div>
                                <?php echo form_error('veb_adresa'); ?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Ime" name="ime_kontakt_osobe" type="text" value="">
                                </div>
                                <?php echo form_error('ime_kontakt_osobe'); ?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Prezime" name="prezime_kontakt_osobe" type="text" value="">
                                </div>
                                <?php echo form_error('prezime_kontakt_osobe'); ?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Telefon kontakt osobe" name="telefon_kontakt_osobe" type="number" value="">
                                </div>
                                <?php echo form_error('telefon_kontakt_osobe'); ?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Email kontakt osobe" name="email_kontakt_osobe" type="text" value="">
                                </div>
                                <?php echo form_error('email_kontakt_osobe'); ?>
                                <div class="form-group">
                                    Logo: <input type="file" name="logo" /><br>
                                </div>
                                <input class="btn btn-lg btn-success btn-block" type="submit" value="Dodaj partnera" name="dodajPartnera" >
                                <br/><br/>
                            </fieldset>
                        <!--</form>-->
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>





</span>