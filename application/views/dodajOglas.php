<span style="background-color:red;">
    <div class="container"><!-- container class is used to centered  the body of the browser with some decent width-->
        <div class="row"><!-- row class is used for grid system in Bootstrap-->
            <div class="col-md-4 col-md-offset-4"><!--col-md-4 is used to create the no of colums in the grid also use for medimum and large devices-->
                <div class="login-panel panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Dodaj Oglas</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo form_open_multipart("Korisnik/dodavanjeOglasa","method=post");?>
                        <!--<form role="form" method="post" action="<?php //echo site_url('Korisnik/dodavanjeOglasa'); ?>">-->
                            <fieldset>

                                <div class="form-group">
                                    <input class="form-control" placeholder="Naslov Oglasa" name="oglasnaslov" type="text" autofocus>
                                </div>
                                <?php echo form_error('oglasnaslov'); ?>


                                <div class="form-group">
                                    <label for="oglastext">Tekst Oglasa</label>
                                    <textarea class="form-control" rows="10" name="oglastext" id="oglastext"></textarea>
                                </div>
                                <?php echo form_error('oglastext'); ?>

                                <div class="checkbox">
                                    <label><input name="praksa" type="checkbox" value="1" checked>Praksa</label>
                                </div>
                                <div class="checkbox">
                                    <label><input name="zaposlenje" type="checkbox" value="1">Zaposlenje</label>
                                </div>
                                <?php //echo form_error(''); ?>
                                <input type="hidden" name="datum_unosenja" value="<?php echo mdate('%Y-%m-%d %H:%i:%s', now()); ?>"/>
                                
                                <div class="form-control">
                                    <label>Naziv Partnera</label>
                                    <select name="naziv_partnera" class="form-control">
                                        <?php foreach ($partneriOglasi as $partneriOglas){ ?>
                                            <option value="<?php echo $partneriOglas['idPartner']; ?>"><?php echo $partneriOglas['naziv'];  ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    Logo: <input type="file" name="fajl" /><br>
                                </div>
                                <input class="btn btn-lg btn-success btn-block" type="submit" value="Dodaj Oglas" name="dodavanjeOglasa" >

                            </fieldset>
                        <!--</form>-->
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>





</span>