<br/>
<span style="background-color:red;">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php
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
                                <input class="form-control" placeholder="Naziv" name="naziv" type="text" autofocus value="<?php
                                if ($tip == 'promeni') {
                                    echo $partner[0]['naziv'];
                                } else {
                                    echo set_value('naziv');
                                }
                                ?>"> 
                            </div>
                            <span style="color: red;"><?php echo form_error('naziv'); ?></span>
                            <div class="form-group">
                                <input class="form-control" placeholder="Adresa" name="adresa" type="text" value="<?php
                                if ($tip == 'promeni') {
                                    echo $partner[0]['adresa'];
                                } else {
                                    echo set_value('adresa');
                                }
                                ?>">
                            </div>
                            <span style="color: red;"> <?php echo form_error('adresa'); ?></span>
                            <div class="form-group">
                                <input class="form-control" placeholder="Grad" name="grad" type="text" value="<?php
                                if ($tip == 'promeni') {
                                    echo $partner[0]['grad'];
                                } else {
                                    echo set_value('grad');
                                }
                                ?>">
                            </div>
                            <span style="color: red;"><?php echo form_error('grad'); ?></span>
                            <div class="form-group">
                                <input class="form-control" placeholder="Postanski broj" name="postanski_broj" type="text" value="<?php
                                if ($tip == 'promeni') {
                                    echo $partner[0]['postanski_broj'];
                                } else {
                                    echo set_value('postanski_broj');
                                }
                                ?>">
                            </div>
                            <span style="color: red;"><?php echo form_error('postanski_broj'); ?></span>
                            <div class="form-group">
                                <input class="form-control" placeholder="Drzava" name="drzava" type="text" value="<?php
                                if ($tip == 'promeni') {
                                    echo $partner[0]['drzava'];
                                } else {
                                    echo set_value('drzava');
                                }
                                ?>">
                            </div>
                            <span style="color: red;"><?php echo form_error('drzava'); ?></span>
                            <div class="form-group">
                                <input class="form-control" placeholder="Ziro racun" name="ziro_racun" type="text" value="<?php
                                if ($tip == 'promeni') {
                                    echo $partner[0]['ziro_racun'];
                                } else {
                                    echo set_value('ziro_racun');
                                }
                                ?>">
                            </div>
                            <span style="color: red;"><?php echo form_error('ziro_racun'); ?></span>
                            <div class="form-group">
                                <label for="sel1">Valuta:</label>
                                <select class="form-control" style="width: 100%" name="valuta_racuna">
                                    <option value="RSD">RSD</option>
                                    <option value="EUR">EUR</option>
                                    <option value="USD">USD</option>
                                </select>
                            </div>
                            <br/>
                            <span style="color: red;"><?php echo form_error('valuta_racuna'); ?></span>
                            <div class="form-group">
                                <input class="form-control" placeholder="PIB" name="PIB" type="number" value="<?php
                                if ($tip == 'promeni') {
                                    echo $partner[0]['PIB'];
                                } else {
                                    echo set_value('PIB');
                                }
                                ?>">
                            </div>
                            <span style="color: red;"><?php echo form_error('PIB'); ?></span>
                            <div class="form-group">
                                <input class="form-control" placeholder="Telefon1" name="telefon1" type="text" value="<?php
                                if ($tip == 'promeni' && count($telefoni) > 0) {
                                    echo $partner[0]['telefon1'];
                                } else {
                                    echo set_value('telefon1');
                                }
                                ?>">
                                <div class="form-group">
                                    <input class="form-control" name="telefonId1" type="hidden" <?php
                                    if ($tip == 'promeni' && count($telefoni) > 0) {
                                        echo "value='" . $telefoni[0]['idTelefon_partnera'] . "'";
                                    }
                                    ?>>
                                </div>
                                <span style="color: red;"><?php echo form_error('telefon1'); ?></span>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Telefon2" name="telefon2" type="text" value="<?php
                                    if ($tip == 'promeni' && count($telefoni) > 1) {
                                        echo $partner[0]['telefon2'];
                                    } else {
                                        echo set_value('telefon2');
                                    }
                                    ?>">
                                    <input class="form-control" name="telefonId2" type="hidden" <?php
                                    if ($tip == 'promeni' && count($telefoni) > 1) {
                                        echo "value='" . $telefoni[1]['idTelefon_partnera'] . "'";
                                    }
                                    ?>>
                                </div><!--
                                <?php echo form_error('telefon2'); ?>              -->
                                <div class="form-group">
                                    <input class="form-control" placeholder="email1" name="email1" type="text" value="<?php
                                    if ($tip == 'promeni' && count($mejlovi) > 0) {
                                        echo $partner[0]['email1'];
                                    } else {
                                        echo set_value('email1');
                                    }
                                    ?>">
                                    <input class="form-control" name="emailId1" type="hidden" <?php
                                    if ($tip == 'promeni' && count($mejlovi) > 0) {
                                        echo "value='" . $mejlovi[0]['idEmail_partnera'] . "'";
                                    }
                                    ?>>
                                </div>
                                <span style="color: red;"><?php echo form_error('email1'); ?></span>
                                <div class="form-group">
                                    <input class="form-control" placeholder="email2" name="email2" type="text" value="<?php
                                    if ($tip == 'promeni' && count($mejlovi) > 1) {
                                        echo $partner[0]['email2'];
                                    } else {
                                        echo set_value('email2');
                                    }
                                    ?>">
                                    <input class="form-control" name="emailId2" type="hidden" <?php
                                    if ($tip == 'promeni' && count($mejlovi) > 1) {
                                        echo "value='" . $mejlovi[1]['idEmail_partnera'] . "'";
                                    }
                                    ?>>
                                </div>
                                <?php echo form_error('email2'); ?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="email3" name="email3" type="text" value="<?php
                                    if ($tip == 'promeni' && count($mejlovi) > 2) {
                                        echo $partner[0]['email3'];
                                    } else {
                                        echo set_value('email3');
                                    }
                                    ?>">
                                    <input class="form-control" name="emailId3" type="hidden" <?php
                                    if ($tip == 'promeni' && count($mejlovi) > 2) {
                                        echo "value='" . $mejlovi[2]['idEmail_partnera'] . "'";
                                    }
                                    ?>>
                                </div>
                                <?php echo form_error('email3'); ?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="email4" name="email4" type="text" value="<?php
                                    if ($tip == 'promeni' && count($mejlovi) > 3) {
                                        echo $partner[0]['email4'];
                                    } else {
                                        echo set_value('email4');
                                    }
                                    ?>">
                                    <input class="form-control" name="emailId4" type="hidden" <?php
                                    if ($tip == 'promeni' && count($mejlovi) > 3) {
                                        echo "value='" . $mejlovi[3]['idEmail_partnera'] . "'";
                                    }
                                    ?>>
                                </div>
                                <?php echo form_error('email4'); ?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="email5" name="email5" type="text" value="<?php
                                    if ($tip == 'promeni' && count($mejlovi) > 4) {
                                        echo $partner[0]['email5'];
                                    } else {
                                        echo set_value('email5');
                                    }
                                    ?>">
                                    <input class="form-control" name="emailId5" type="hidden" <?php
                                    if ($tip == 'promeni' && count($mejlovi) > 4) {
                                        echo "value='" . $mejlovi[4]['idEmail_partnera'] . "'";
                                    }
                                    ?>>
                                </div>
                                <?php echo form_error('email5'); ?>             
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Opis" name="opis" type="text"><?php
                                        if ($tip == 'promeni') {
                                            echo $partner[0]['opis'];
                                        } else {
                                            echo set_value('opis');
                                        }
                                        ?></textarea>
                                </div>
                                <span style="color: red;"><?php echo form_error('opis'); ?></span>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Veb adresa" name="veb_adresa" type="text" value="<?php
                                    if ($tip == 'promeni') {
                                        echo "value='" . $partner[0]['veb_adresa'] . "'";
                                    } else {
                                        echo set_value('veb_adresa');
                                    }
                                    ?>">
                                </div>
                                <span style="color: red;"><?php echo form_error('veb_adresa'); ?></span>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Ime" name="ime_kontakt_osobe" type="text" value="<?php
                                    if ($tip == 'promeni') {
                                        echo "value='" . $partner[0]['ime_kontakt_osobe'] . "'";
                                    } else {
                                        echo set_value('ime_kontakt_osobe');
                                    }
                                    ?>">
                                </div>
                                <span style="color: red;"><?php echo form_error('ime_kontakt_osobe'); ?></span>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Prezime" name="prezime_kontakt_osobe" type="text" value="<?php
                                    if ($tip == 'promeni') {
                                        echo "value='" . $partner[0]['prezime_kontakt_osobe'] . "'";
                                    } else {
                                        echo set_value('prezime_kontakt_osobe');
                                    }
                                    ?>">
                                </div>
                                <span style="color: red;"><?php echo form_error('prezime_kontakt_osobe'); ?></span>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Telefon kontakt osobe" name="telefon_kontakt_osobe" type="number" value="<?php
                                    if ($tip == 'promeni') {
                                        echo "value='" . $partner[0]['telefon_kontakt_osobe'] . "'";
                                    } else {
                                        echo set_value('telefon_kontakt_osobe');
                                    }
                                    ?>">
                                </div>
                                <span style="color: red;"><?php echo form_error('telefon_kontakt_osobe'); ?></span>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Email kontakt osobe" name="email_kontakt_osobe" type="text" value="<?php
                                    if ($tip == 'promeni') {
                                        echo "value='" . $partner[0]['email_kontakt_osobe'] . "'";
                                    } else {
                                        echo set_value('email_kontakt_osobe');
                                    }
                                    ?>">
                                </div>
                                <span style="color: red;"><?php echo form_error('email_kontakt_osobe'); ?></span>
                                <?php if ($tip == 'dodaj') { ?>
                                    <div class="form-group">
                                        Logo: <input type="file" name="logo" /><br>
                                    </div>
                                <?php } ?>
                                <input class="btn btn-lg btn-success btn-block" type="submit" 
                                       value="
                                       <?php
                                       if ($tip == 'dodaj') {
                                           echo 'Dodaj partnera';
                                       } elseif ($tip == 'promeni') {
                                           echo 'Promeni podatke partnera';
                                       }
                                       ?>" name="dodajPartnera" >
                                <br/><br/>
                        </fieldset>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</span>
