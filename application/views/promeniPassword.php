
<br/>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="login-panel panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title col-md-8 col-md-offset-4">Promeni podatke</h3>
                </div>
                <div class="panel-body">

                    <form role="form" method="post" action="<?php echo site_url("$kontroler/menjajPassword"); ?>">
                        <fieldset>
                            <?php
                            echo $poruka;
                            echo form_error('username');
                            ?>                                                            
                            <div class="form-group">
                                <input class="form-control col-md-6" name="username" type="text" value="" placeholder="Unesi username">
                            </div>
                            <div class="form-group">
                                <input class="form-control col-md-6" name="stari_password" type="password" value="" placeholder="Unesi staru lozinku">
                            </div>  
                            <div class="form-group">
                                <input class="form-control col-md-6" name="novi_password" type="password" value="" placeholder="Unesi novu lozinku">
                            </div> 
                            <div class="form-group">
                                <input class="btn btn-lg btn-success btn-block col-md-3" type="submit" value="Promeni password" name="promeniPassword" >    
                            </div>
                        </fieldset>
                    </form>
