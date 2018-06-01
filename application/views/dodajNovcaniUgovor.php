<br/>
<span style="background-color:red;">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-4">
                <div class="login-panel panel panel-success">
                    <?php if (isset($message)) { ?>
                        <span style="color:<?php echo $boja; ?>"> <?php echo $message; ?></span><br />
                    <?php } ?>
                    <div class="panel-heading">
                        <h3 class="panel-title">Dodaj Novčani Ugovor</h3>
                    </div>
                    <div class="panel-body">

                        <?php echo form_open_multipart("$kontroler/dodavanjeNovcanogUgovora", "method=post"); ?>
                        <fieldset>
                            <div class="form-group">
                                <select name="id_partnera" class="form-control">
                                    <?php foreach ($partneriUgovori as $partneriUgovor) { ?>
                                        <option value="<?php echo $partneriUgovor['idPartner']; ?>"><?php echo $partneriUgovor['naziv']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sel1">Datum potpisivanja:</label>
                                <input class="form-control" placeholder="Datum potpisivanja" name="datum_potpisivanja" type="date" 
                                       value="<?php echo set_value('datum_potpisivanja'); ?>">
                            </div>
                            <span style="color:red;"><?php echo form_error('datum_potpisivanja'); ?></span>                                                        
                            <div class="form-group">                                
                                <select class="form-control" style="width: 100%" name="id_paketa">
                                    <?php foreach ($paketiUgovori as $paketiUgovor) { ?>
                                        <option value="<?php echo $paketiUgovor['idPaketi']; ?>"><?php echo $paketiUgovor['naziv_paketa']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <br/>
                            <div class="form-group">
                                <input class="form-control" placeholder="Vrednost" name="vrednost" type="text" value="<?php echo set_value('vrednost'); ?>">
                            </div>
                            <span style="color:red;"><?php echo form_error('vrednost'); ?></span>
                            <div class="form-group">
                                <label for="sel1">Valuta:</label>
                                <select class="form-control" style="width: 100%" name="valuta">
                                    <option value="RSD">RSD</option>
                                    <option value="EUR">EUR</option>
                                    <option value="USD">USD</option>
                                </select>
                            </div>
                            <br/>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label><input name="faktura" type="checkbox" value="1">Faktura</label>
                                </div>                            
                                <div class="checkbox">
                                    <label><input name="uplata" type="checkbox" value="1">Uplata</label>
                                </div> 
                            </div>
                            <div class="form-group">
                                <label for="sel1">Datum uplate:</label>
                                <input class="form-control" placeholder="Datum uplate" name="datum_uplate" type="date" value="<?php echo set_value('datum_uplate'); ?>">

                            </div>
                            <div class="form-group">                                
                                <select class="form-control" style="width: 100%" name="idstatus_ugovora">
                                    <?php foreach ($statusUgovor as $element) { ?>
                                        <option value="<?php echo $element['idstatus_ugovora']; ?>"><?php echo $element['opis']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <br/>
                            <input class="btn btn-lg btn-success btn-block" type="submit" value="Dodaj Novcani Ugovor" name="dodajNovcaniUgovor" >
                            <br/><br/>
                        </fieldset>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</span>
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