<br/>
<span style="background-color:red;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="login-panel panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title col-md-12 col-md-offset-4">Login</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="<?php echo site_url('Gost/ulogujse') ?>">
                            <fieldset>
                                <?php
                                if (isset($poruka)) {
                                    echo "<font color='red'>$poruka</font><br>";
                                }
                                ?>
                                <div class="form-group">
                                    <input class="form-control col-md-4" placeholder="Korisnicko ime" name="username" type="text" value="<?php echo set_value('username') ?>" autofocus>
                                    <span class="message col-md-8"><?php echo form_error('username'); ?></span>
                                </div>
                                <div class="form-group">
                                    <input class="form-control col-md-4" placeholder="Lozinka" name="password" type="password" value="">
                                    <span class="message col-md-8"><?php echo form_error('password'); ?></span>
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-lg btn-success btn-block col-md-2" type="submit" value="Uloguj se" name="login" >
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</span>       