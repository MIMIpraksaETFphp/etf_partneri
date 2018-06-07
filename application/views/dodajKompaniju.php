<br/>
<?php //var_dump($partner);?>
<span style="background-color:red;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="login-panel panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title col-md-12 col-md-offset-4"><?php
                            if ($tip == 'dodaj') {
                                echo "Dodaj partnera";
                            } elseif ($tip == 'promeni') {
                                echo "Promeni podatke partnera";
                            }
                            ?></h3>
                    </div>
                    <div class="panel-body">
                        <?php
                        if ($tip == 'dodaj') {
                            echo form_open_multipart($kontroler . '/dodajPartnera', "method=post");
                        } elseif ($tip == 'promeni') {
                            echo form_open_multipart($kontroler . '/promeniPartnera', "method=post");
                        }
                        if ($tip == 'promeni') {
                            ?>
                            <input type="hidden" name="idPartner" value="<?php echo $partner[0]['idPartner']; ?>">
                        <?php } ?>
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control col-md-6" placeholder="Naziv" name="naziv" type="text" autofocus <?php if ($tip == 'promeni') { if($this->session->userdata('korisnik')->status_korisnika_idtable1 != 4){echo "readonly";}}?> value="<?php
                                if ($tip == 'promeni') {
                                    echo $partner[0]['naziv'];
                                } else {
                                    echo set_value('naziv');
                                }
                                ?>">
                                <span class="message col-md-6"><?php echo form_error('naziv'); ?></span>
                            </div>
                            <div class="form-group">
                                <input class="form-control col-md-6" placeholder="Adresa" name="adresa" type="text" value="<?php
                                if ($tip == 'promeni') {
                                    echo $partner[0]['adresa'];
                                } else {
                                    echo set_value('adresa');
                                }
                                ?>">
                                <span class="message col-md-6"> <?php echo form_error('adresa'); ?></span>
                            </div>
                            <div class="form-group">
                                <input class="form-control col-md-6" placeholder="Grad" name="grad" type="text" value="<?php
                                if ($tip == 'promeni') {
                                    echo $partner[0]['grad'];
                                } else {
                                    echo set_value('grad');
                                }
                                ?>">
                                <span class="message col-md-6"><?php echo form_error('grad'); ?></span>
                            </div>
                            <div class="form-group">
                                <input class="form-control col-md-6" placeholder="Postanski broj" name="postanski_broj" type="text" value="<?php
                                if ($tip == 'promeni') {
                                    echo $partner[0]['postanski_broj'];
                                } else {
                                    echo set_value('postanski_broj');
                                }
                                ?>">
                                <span class="message col-md-6"><?php echo form_error('postanski_broj'); ?></span>
                            </div>
                            <div class="form-group">
                                <input class="form-control col-md-6" placeholder="Država" name="drzava" type="text" value="<?php
                                if ($tip == 'promeni') {
                                    echo $partner[0]['drzava'];
                                } else {
                                    echo set_value('drzava');
                                }
                                ?>">
                                <span class="message col-md-6"><?php echo form_error('drzava'); ?></span>
                            </div>
                            <div class="form-group">
                                <input class="form-control col-md-6" placeholder="Žiro racun" name="ziro_racun" type="text" value="<?php
                                if ($tip == 'promeni') {
                                    echo $partner[0]['ziro_racun'];
                                } else {
                                    echo set_value('ziro_racun');
                                }
                                ?>">
                                <span class="message col-md-6"><?php echo form_error('ziro_racun'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="sel1">Valuta:</label><br />
                                <select class="form-control col-md-6" style="width: 100%" name="valuta_racuna">
                                    <option value="RSD">RSD</option>
                                    <option value="EUR">EUR</option>
                                    <option value="USD">USD</option>
                                </select>
                                <span class="message col-md-6"><?php echo form_error('valuta_racuna'); ?></span>
                            </div>
                            <div class="form-group">
                                <input class="form-control col-md-6" placeholder="PIB" name="PIB" type="number" value="<?php
                                if ($tip == 'promeni') {
                                    echo $partner[0]['PIB'];
                                } else {
                                    echo set_value('PIB');
                                }
                                ?>">
                                <span class="message col-md-6"><?php echo form_error('PIB'); ?></span>
                            </div>
                            <div class="form-group">
                                <input class="form-control col-md-6" placeholder="Telefon1" name="telefon1" type="text" value="<?php
                                if ($tip == 'promeni' && count($telefoni) > 0) {
                                    echo $telefoni[0]['telefon'];
                                } else {
                                    echo set_value('telefon1');
                                }
                                ?>">
                                <input class="form-control col-md-6" name="telefonId1" type="hidden" <?php
                                if ($tip == 'promeni' && count($telefoni) > 0) {
                                    echo "value='" . $telefoni[0]['idTelefon_partnera'] . "'";
                                }
                                ?>>
                                <span class="message col-md-6"><?php echo form_error('telefon1'); ?></span>
                            </div>
                            <div class="form-group">
                                <input class="form-control col-md-6" placeholder="Telefon2" name="telefon2" type="text" value="<?php
                                if ($tip == 'promeni' && count($telefoni) > 1) {
                                    echo $telefoni[1]['telefon'];
                                } else {
                                    echo set_value('telefon2');
                                }
                                ?>">
                                <input class="form-control col-md-6" name="telefonId2" type="hidden" <?php
                                if ($tip == 'promeni' && count($telefoni) > 1) {
                                    echo "value='" . $telefoni[1]['idTelefon_partnera'] . "'";
                                }
                                ?>>
                            </div>
                            <div class="form-group">
                                <input class="form-control col-md-6" placeholder="email1" name="email1" type="text" value="<?php
                                if ($tip == 'promeni' && count($mejlovi) > 0) {
                                    echo $mejlovi[0]['email'];
                                } else {
                                    echo set_value('email1');
                                }
                                ?>">
                                <input class="form-control col-md-6" name="emailId1" type="hidden" <?php
                                if ($tip == 'promeni' && count($mejlovi) > 0) {
                                    echo "value='" . $mejlovi[0]['idEmail_partnera'] . "'";
                                }
                                ?>>
                                <span class="message col-md-6"><?php echo form_error('email1'); ?></span> 
                            </div>
                            <div class="form-group">
                                <input class="form-control col-md-6" placeholder="email2" name="email2" type="text" value="<?php
                                if ($tip == 'promeni' && count($mejlovi) > 1) {
                                    echo $mejlovi[1]['email'];
                                } else {
                                    echo set_value('email2');
                                }
                                ?>">
                                <input class="form-control col-md-6" name="emailId2" type="hidden" <?php
                                if ($tip == 'promeni' && count($mejlovi) > 1) {
                                    echo "value='" . $mejlovi[1]['idEmail_partnera'] . "'";
                                }
                                ?>>
                            </div>
                            <div class="form-group">
                                <input class="form-control col-md-6" placeholder="email3" name="email3" type="text" value="<?php
                                if ($tip == 'promeni' && count($mejlovi) > 2) {
                                    echo $mejlovi[2]['email'];
                                } else {
                                    echo set_value('email3');
                                }
                                ?>">
                                <input class="form-control col-md-6" name="emailId3" type="hidden" <?php
                                if ($tip == 'promeni' && count($mejlovi) > 2) {
                                    echo "value='" . $mejlovi[2]['idEmail_partnera'] . "'";
                                }
                                ?>>
                            </div>
                            <div class="form-group">
                                <input class="form-control col-md-6" placeholder="email4" name="email4" type="text" value="<?php
                                if ($tip == 'promeni' && count($mejlovi) > 3) {
                                    echo $mejlovi[3]['email'];
                                } else {
                                    echo set_value('email4');
                                }
                                ?>">
                                <input class="form-control col-md-6" name="emailId4" type="hidden" <?php
                                if ($tip == 'promeni' && count($mejlovi) > 3) {
                                    echo "value='" . $mejlovi[3]['idEmail_partnera'] . "'";
                                }
                                ?>>
                            </div>
                            <div class="form-group">
                                <input class="form-control col-md-6" placeholder="email5" name="email5" type="text" value="<?php
                                if ($tip == 'promeni' && count($mejlovi) > 4) {
                                    echo $mejlovi[4]['email'];
                                } else {
                                    echo set_value('email5');
                                }
                                ?>">
                                <input class="form-control col-md-6" name="emailId5" type="hidden" <?php
                                if ($tip == 'promeni' && count($mejlovi) > 4) {
                                    echo "value='" . $mejlovi[4]['idEmail_partnera'] . "'";
                                }
                                ?>>
                            </div>             
                            <div class="form-group">
                                <textarea class="form-control col-md-6" placeholder="Opis" name="opis" type="text"><?php
                                    if ($tip == 'promeni') {
                                        echo $partner[0]['opis'];
                                    } else {
                                        echo set_value('opis');
                                    }
                                    ?></textarea>
                                <span class="message col-md-6"><?php echo form_error('opis'); ?></span>
                            </div>
                            <br />
                            <div class="form-group">
                                <input class="form-control col-md-6" placeholder="Veb adresa" name="veb_adresa" type="text" value="<?php
                                if ($tip == 'promeni') {
                                    echo $partner[0]['veb_adresa'];
                                } else {
                                    echo set_value('veb_adresa');
                                }
                                ?>">

                                <span class="message col-md-6"><?php echo form_error('veb_adresa'); ?></span>
                            </div>
                            <div class="form-group">
                                <input class="form-control col-md-6" placeholder="Ime" name="ime_kontakt_osobe" type="text" value="<?php
                                if ($tip == 'promeni') {
                                    echo $partner[0]['ime_kontakt_osobe'];
                                } else {
                                    echo set_value('ime_kontakt_osobe');
                                }
                                ?>">

                                <span class="message col-md-6"><?php echo form_error('ime_kontakt_osobe'); ?></span>
                            </div>
                            <div class="form-group">
                                <input class="form-control col-md-6" placeholder="Prezime" name="prezime_kontakt_osobe" type="text" value="<?php
                                if ($tip == 'promeni') {
                                    echo $partner[0]['prezime_kontakt_osobe'];
                                } else {
                                    echo set_value('prezime_kontakt_osobe');
                                }
                                ?>">

                                <span class="message col-md-6"><?php echo form_error('prezime_kontakt_osobe'); ?></span>
                            </div>
                            <div class="form-group">
                                <input class="form-control col-md-6" placeholder="Telefon kontakt osobe" name="telefon_kontakt_osobe" type="number" value="<?php
                                if ($tip == 'promeni') {
                                    echo $partner[0]['telefon_kontakt_osobe'];
                                } else {
                                    echo set_value('telefon_kontakt_osobe');
                                }
                                ?>">

                                <span class="message col-md-6"><?php echo form_error('telefon_kontakt_osobe'); ?></span>
                            </div>
                            <div class="form-group">
                                <input class="form-control col-md-6" placeholder="Email kontakt osobe" name="email_kontakt_osobe" type="text" value="<?php
                                if ($tip == 'promeni') {
                                    echo $partner[0]['email_kontakt_osobe'];
                                } else {
                                    echo set_value('email_kontakt_osobe');
                                }
                                ?>">

                                <span class="message col-md-6"><?php echo form_error('email_kontakt_osobe'); ?></span>
                            </div>
                            <?php if ($tip == 'dodaj') { ?>
                                <div class="form-group">
                                    Logo: <input type="file" name="logo"/><br>
                                    <span class="message col-md-6"><?php echo form_error('logo'); ?></span>
                                </div>
                            <?php } ?> <div class="form-group">
                                    <input class="btn btn-lg btn-success btn-block col-md-4" type="submit" 
                                   value="
                                   <?php
                                   if ($tip == 'dodaj') {
                                       echo 'Dodaj partnera';
                                   } elseif ($tip == 'promeni') {
                                       echo 'Promeni podatke partnera';
                                   }
                                   ?>" name="dodajPartnera" >
                            </div>
                        </fieldset>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</span>
