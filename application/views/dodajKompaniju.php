<br/>
<?php //var_dump($mejlovi);?>
<span style="background-color:red;">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-4">
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
                            <?php for ($i = 1; $i <= 2; $i++) { ?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Telefon<?php echo $i; ?>" name="telefon<?php echo $i; ?>" type="number" value="<?php
                                    if ($tip == 'promeni' && count($telefoni) > $i - 1) {
                                        echo $telefoni[$i - 1]['telefon'];
                                    } else {
                                        echo set_value("telefon$i");
                                    }
                                    ?>">
                                    <input class="form-control" name="telefonId<?php echo $i; ?>" type="hidden" <?php
                                    if ($tip == 'promeni' && count($telefoni) > $i - 1) {
                                        echo "value='" . $telefoni[$i - 1]['idTelefon_partnera'] . "'";
                                    }
                                    ?>>
                                </div>
                                <?php if ($i == 1) { ?>
                                    <span style="color: red;"><?php echo form_error("telefon1"); ?></span>
                                <?php
                                }
                            }
                            for ($i = 1; $i <= 5; $i++) {
                                ?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="email<?php echo $i; ?>" name="email<?php echo $i; ?>" type="text" value="<?php
                                    if ($tip == 'promeni' && count($mejlovi) > $i - 1) {
                                        echo $mejlovi[$i - 1]['email'];
                                    } else {
                                        echo set_value('email1');
                                    }
                                    ?>">
                                    <input class="form-control" name="emailId1" type="hidden" <?php
                                    if ($tip == 'promeni' && count($mejlovi) > $i - 1) {
                                        echo "value='" . $mejlovi[$i - 1]['idEmail_partnera'] . "'";
                                    }
                                    ?>>
                                </div>
                                <?php if ($i == 1) { ?>
                                    <span style="color: red;"><?php echo form_error('email1'); ?></span>
                                <?php }
                            } ?>
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
                                    echo $partner[0]['veb_adresa'];
                                } else {
                                    echo set_value('veb_adresa');
                                }
                                ?>">
                            </div>
                            <span style="color: red;"><?php echo form_error('veb_adresa'); ?></span>
                            <div class="form-group">
                                <input class="form-control" placeholder="Ime" name="ime_kontakt_osobe" type="text" value="<?php
                                if ($tip == 'promeni') {
                                    echo $partner[0]['ime_kontakt_osobe'];
                                } else {
                                    echo set_value('ime_kontakt_osobe');
                                }
                                ?>">
                            </div>
                            <span style="color: red;"><?php echo form_error('ime_kontakt_osobe'); ?></span>
                            <div class="form-group">
                                <input class="form-control" placeholder="Prezime" name="prezime_kontakt_osobe" type="text" value="<?php
                                if ($tip == 'promeni') {
                                    echo $partner[0]['prezime_kontakt_osobe'];
                                } else {
                                    echo set_value('prezime_kontakt_osobe');
                                }
                                ?>">
                            </div>
                            <span style="color: red;"><?php echo form_error('prezime_kontakt_osobe'); ?></span>
                            <div class="form-group">
                                <input class="form-control" placeholder="Telefon kontakt osobe" name="telefon_kontakt_osobe" type="number" value="<?php
                                if ($tip == 'promeni') {
                                    echo $partner[0]['telefon_kontakt_osobe'];
                                } else {
                                    echo set_value('telefon_kontakt_osobe');
                                }
                                ?>">
                            </div>
                            <span style="color: red;"><?php echo form_error('telefon_kontakt_osobe'); ?></span>
                            <div class="form-group">
                                <input class="form-control" placeholder="Email kontakt osobe" name="email_kontakt_osobe" type="text" value="<?php
                                if ($tip == 'promeni') {
                                    echo $partner[0]['email_kontakt_osobe'];
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
