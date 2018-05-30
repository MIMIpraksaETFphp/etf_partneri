<span style="background-color:red;">
    <div class="container"><!-- container class is used to centered  the body of the browser with some decent width-->
        <div class="row"><!-- row class is used for grid system in Bootstrap-->
            <div class="col-md-4 col-md-offset-4"><!--col-md-4 is used to create the no of colums in the grid also use for medimum and large devices-->
                <div class="login-panel panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Dodaj Predavanje</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo form_open_multipart("$kontroler/dodavanjePredavanja","method=post");?>
                        <!--<form role="form" method="post" action="<?php //echo site_url('Korisnik/dodavanjeOglasa'); ?>">-->
                            <fieldset>

                                <div class="form-group">
                                    <input class="form-control" placeholder="Naslov Predavanja" name="naslov_srpski" type="text" autofocus>
                                </div>
                                <?php echo form_error('naslov_srpski'); ?>

                                <div class="form-group">
                                    <input class="form-control" placeholder="Naslov Predavanja Engleski" name="naslov_engleski" type="text">
                                </div>
                                
                                <div class="form-group">
                                 Opis predavanja(srpski)
                                    <textarea class="form-control" rows="10" name="opis_srpski" ></textarea>
                                </div>
                                <?php echo form_error('opis_srpski'); ?>
                                
                                <div class="form-group">
                                 Opis predavanja(engleski)
                                    <textarea class="form-control" rows="10" name="opis_engleski" ></textarea>
                                </div>
                                
                                <div class="form-group">
                                    <input class="form-control" placeholder="Vreme predavanja" name="vreme_predavanja" type="date">
                                </div>
                                <?php echo form_error('vreme_predavanja'); ?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Sala" name="sala" type="text">
                                </div>
                                <?php echo form_error('sala'); ?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Ime predavaca" name="ime_predavaca" type="text">
                                </div>
                                
                                <div class="form-group">
                                    <input class="form-control" placeholder="Prezime predavaca" name="prezime_predavaca" type="text">
                                </div>
                                
                                <div class="form-group">
                                 CV predavaca(srpski)
                                    <textarea class="form-control" rows="10" name="cv_srpski" ></textarea>
                                </div>
                                
                                <div class="form-group">
                                 CV predavaca(engleski)
                                    <textarea class="form-control" rows="10" name="cv_engleski" ></textarea>
                                </div>
                                
                                <div class="form-control">
                                    <label>Naziv Partnera</label>
                                    <select name="id_partnera" class="form-control">
                                        <?php foreach ($partneriPredavanja as $partneriPredavanje){ ?>
                                            <option value="<?php echo $partneriPredavanje['idPartner']; ?>"><?php echo $partneriPredavanje['naziv'];  ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                
<!--                                <div class="form-group">
                                    Fajl: <input type="file" name="fajl" /><br>     izbacili smo formu za dodavanje fajlova
                                </div>-->
                                <input class="btn btn-lg btn-success btn-block" type="submit" value="Dodaj Predavanje" name="dodavanjePredavanja" >
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