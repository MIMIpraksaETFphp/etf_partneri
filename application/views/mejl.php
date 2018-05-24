
<span style="background-color:red;">
    <div class="container"><!-- container class is used to centered  the body of the browser with some decent width-->
        <div class="row"><!-- row class is used for grid system in Bootstrap-->
            <div class="col-md-4 col-md-offset-4"><!--col-md-4 is used to create the no of colums in the grid also use for medimum and large devices-->
                <div class="login-panel panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">E-mail</h3>
                    </div>
                    <div class="panel-body">

                        <form role="form" method="post" action="<?php echo site_url('ITmenadzer/saljiMejl'); ?>">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="TO:" name="to" type="text" >
                                </div>
                                <?php //echo form_error('email_primaoca'); ?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="CC:" name="cc" type="text" >
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="BCC:" name="bcc" type="text" >
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Subject" name="subject" type="text" value="<?php echo $subject; ?>" >
                                </div>
                                <?php //echo form_error('naslov'); ?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Sadrzaj" name="message"" type="text" value="<?= $message; ?>" >
                                </div>
                                <?php //echo form_error('sadrzaj'); ?>

                                <input class="btn btn-lg btn-success btn-block" type="submit" value="Posalji" name="submit" >

                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>





</span>
