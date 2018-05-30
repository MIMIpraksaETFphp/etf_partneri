


<span style="background-color:red;">
    <div class="container"><!-- container class is used to centered  the body of the browser with some decent width-->
        <div class="row"><!-- row class is used for grid system in Bootstrap-->
            <div class="col-md-4 col-md-offset-4"><!--col-md-4 is used to create the no of colums in the grid also use for medimum and large devices-->
                <div class="login-panel panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Promeni podatke</h3>
                    </div>
                    <div class="panel-body">

                        <form role="form" method="post" action="<?php echo site_url("$kontroler/promeniPodatke"); ?>">
                            <fieldset>
                                <?php echo form_error('username'); ?>                                                            
                                <div class="form-group">
                                    <input class="form-control" name="username" type="text" value="" placeholder="Unesi username">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="password" type="text" value="" placeholder="Unesi staru lozinku">
                                </div>  
                                <div class="form-group">
                                    <input class="form-control" name="password" type="text" value="" placeholder="Unesi novu lozinku">
                                </div>                                                                                   
                                <input class="btn btn-lg btn-success btn-block" type="submit" value="Promeni password" name="promeniPassword" >                              
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>





</span>