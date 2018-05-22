
<span style="background-color:red;">
    <div class="container"><!-- container class is used to centered  the body of the browser with some decent width-->
        <div class="row"><!-- row class is used for grid system in Bootstrap-->
            <div class="col-md-4 col-md-offset-4"><!--col-md-4 is used to create the no of colums in the grid also use for medimum and large devices-->
                <div class="login-panel panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">E-mail</h3>
                    </div>
                    <div class="panel-body">

                        <form role="form" method="post" action="<?php echo site_url('ITmenadzer/email'); ?>">
                            <fieldset>
<!--                                <div class="form-group">
                                    <input class="form-control" placeholder="FROM:" name="korisnik_salje_mail" type="text" >
                                </div>-->
                                <div class="form-group">
                                    <input class="form-control" placeholder="TO:" name="email_primaoca" type="email" >
                                </div>
                                <?php //echo form_error('email_primaoca'); ?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="CC:" name="email_primaoca" type="email" >
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="BCC:" name="email_primaoca" type="email" >
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Subject" name="naslov" type="text" >
                                </div>
                                <?php //echo form_error('naslov'); ?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Sadrzaj" name="sadrzaj" type="text" >
                                </div>
                                <?php //echo form_error('sadrzaj'); ?>

                                <input class="btn btn-lg btn-success btn-block" type="submit" value="Posalji" name="email" >

                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>





</span>
