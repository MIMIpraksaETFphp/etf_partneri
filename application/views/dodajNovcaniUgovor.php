
<span style="background-color:red;">
    <div class="container"><!-- container class is used to centered  the body of the browser with some decent width-->
        <div class="row"><!-- row class is used for grid system in Bootstrap-->
            <div class="col-md-4 col-md-offset-4"><!--col-md-4 is used to create the no of colums in the grid also use for medimum and large devices-->
                <div class="login-panel panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Dodaj Novcani Ugovor</h3>
                    </div>
                    <div class="panel-body">

                        <?php echo form_open_multipart('ITmenadzer/dodavanjeNovcanogUgovora', "method=post"); ?>
<!--                        <form role="form" method="post" action="<?php //echo site_url('Korisnik/dodajPartnera');  ?>">-->
                        <fieldset>
                            <div class="form-group">
                                <select name="id_partnera" class="form-control">
                                        <?php foreach ($partneriUgovori as $partneriUgovor){ ?>
                                            <option value="<?php echo $partneriUgovor['idPartner']; ?>"><?php echo $partneriUgovor['naziv'];  ?></option>
                                        <?php } ?>
                                </select>
                            </div>
                            <?php echo form_error('naziv'); ?>
                            <div class="form-group">
                                <input class="form-control" placeholder="Datum potpisivanja" name="datum_potpisivanja" type="text" value="">
                            </div>
                            <?php echo form_error('datum_potpisivanja'); ?>
                            <div class="form-group">
                                <input class="form-control" placeholder="Datum isticanja" name="datum_isticanja" type="text" value="">
                            </div>
                            <?php echo form_error('datum_isticanja'); ?>
                            <div class="form-group">                                
                                <select class="form-control" style="width: 100%" name="id_paketa">
                                    <?php foreach ($paketiUgovori as $paketiUgovor){ ?>
                                            <option value="<?php echo $paketiUgovor['idPaketi']; ?>"><?php echo $paketiUgovor['naziv_paketa'];  ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <br/>
                            <?php echo form_error('paket'); ?>
                            <div class="form-group">
                                <input class="form-control" placeholder="Vrednost" name="vrednost" type="text" value="">
                            </div>
                            <?php echo form_error('vrednost'); ?>
                            <div class="form-group">
                                <label for="sel1">Valuta:</label>
                                <select class="form-control" style="width: 100%" name="valuta">
                                    <option value="RSD">RSD</option>
                                    <option value="EUR">EUR</option>
                                    <option value="USD">USD</option>
                                </select>
                            </div>
                            <br/>
                            <?php echo form_error('valuta'); ?>
                                <div class="checkbox">
                                    <label><input name="faktura" type="checkbox" value="1">Faktura</label>
                                </div>
                                <div class="checkbox">
                                    <label><input name="uplata" type="checkbox" value="1">Uplata</label>
                                </div> 
                                <div class="form-group">
                                    <input class="form-control" placeholder="Datum uplate" name="datum_uplate" type="text" value="">
                                </div>
                                <?php echo form_error('datum_uplate'); ?>
                                <div class="form-group">
                                    Tip ugovora: NOVCANI
                                </div>
                                <div class="form-group">
                                    <label for="sel1">Status ugovora:</label>
                                    <select class="form-control" style="width: 100%" name="opis">
                                        <option value="pripremljen">Pripremljen</option>
                                        <option value="poslat kompanije">Poslat kompaniji</option>
                                        <option value="potpisan od strane fakulteta">Potpisan od strane fakulteta</option>
                                        <option value="potpisan od strane kompanije">Potpisan od strane kompanije</option>
                                        <option value="potpisan sa obe strane">Potpisan sa obe strane</option>
                                        <option value="predat arhivi fakulteta">Predat arhivi fakultetae</option>
                                    </select>
                                </div>
                                <br/>
                                <?php echo form_error('opis'); ?>
                                <input class="btn btn-lg btn-success btn-block" type="submit" value="Dodaj Novcani Ugovor" name="dodajNovcaniUgovor" >
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