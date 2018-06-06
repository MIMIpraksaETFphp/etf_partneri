<br/>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="login-panel panel panel-success">
                <?php if (isset($message)) { ?>
                    <span style="color:<?php echo $boja; ?>"> <?php echo $message; ?></span><br />
                <?php } ?>
                <div class="panel-heading">
                    <h3 class="panel-title col-md-12 col-md-offset-4">Dodaj Donatorski Ugovor</h3>
                </div>
                <div class="panel-body">
                    <?php echo form_open_multipart("$kontroler/dodavanjeDonatorskogUgovora", "method=post"); ?>
                    <fieldset>
                        <div class="form-group">
                            <select name="id_partnera" class="form-control col-md-6">
                                <?php foreach ($partneriUgovori as $partneriUgovor) { ?>
                                    <option value="<?php echo $partneriUgovor['idPartner']; ?>"><?php echo $partneriUgovor['naziv']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sel1">Datum potpisivanja:</label><br />
                            <input class="form-control col-md-6" placeholder="Datum potpisivanja" name="datum_potpisivanja" type="date" id="sel1"
                                   value="<?php echo set_value('datum_potpisivanja'); ?>">
                            <span class="message col-md-6"><?php echo form_error('datum_potpisivanja'); ?></span>   
                        </div>
                        <div class="form-group">                                
                            <select class="form-control col-md-6" style="width: 100%" name="id_paketa">
                                <?php foreach ($paketiUgovori as $paketiUgovor) { ?>
                                    <option value="<?php echo $paketiUgovor['idPaketi']; ?>"><?php echo $paketiUgovor['naziv_paketa']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <br/>
                        <div class="form-group">
                            <input class="form-control col-md-6" placeholder="Procenjena vrednost" name="procenjena_vrednost" type="text" value="<?php echo set_value('procenjena_vrednost'); ?>">
                            <span class="message col-md-6"><?php echo form_error('procenjena_vrednost'); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="sel2">Valuta:</label><br />
                            <select class="form-control col-md-6" style="width: 100%" name="valuta" id="sel2">
                                <option value="RSD">RSD</option>
                                <option value="EUR">EUR</option>
                                <option value="USD">USD</option>
                            </select>
                        </div>
                        <br/>
                        <div class="form-group">
                            <input class="form-control col-md-6" placeholder="Opis donacije" name="opis_donacije" type="text" value="<?php echo set_value('opis_donacije'); ?>">
                            <span class="message col-md-6"><?php echo form_error('opis_donacije'); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="sel3">Datum isporuke:</label><br />
                            <input class="form-control col-md-6" placeholder="Datum isporuke" name="datum_isporuke" type="date" id="sel3"
                                   value="<?php echo set_value('datum_isporuke'); ?>">
                        </div>
                        <div class="form-group">
                            <input class="form-control col-md-6" placeholder="Komentar" name="komentar" type="text" value="<?php echo set_value('komentar'); ?>">
                        </div>
                        <div class="form-group">                                
                            <select class="form-control col-md-6" style="width: 100%" name="idstatus_ugovora">
                                <?php foreach ($statusUgovor as $element) { ?>
                                    <option value="<?php echo $element['idstatus_ugovora']; ?>"><?php echo $element['opis']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <br/>
                        <div class="form-group">
                            <input class="btn btn-lg btn-success btn-block col-md-3" type="submit" value="Dodaj Donatorski Ugovor" name="dodavanjeDonatorskogUgovora" >
                        </div>
                    </fieldset>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <table class="table">
                <tr>
                    <th>Paket</th>
                    <th>Broj Partnera u paketu</th>
                    <th>Max broj Parnera</th>
                </tr>
                <?php foreach ($brojPartnera as $broj) { ?>
                    <tr>
                        <td><?php echo $broj['naziv_paketa']; ?></td>
                        <td><?php echo $broj['broj']; ?></td>
                        <td><?php echo $broj['maks_broj_partnera']; ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>