<!--<form name="loginform" action="<?php// echo site_url('Gost/ulogujse') ?>" method="post">
    <?php //if(isset($poruka))
     // echo "<font color='red'>$poruka</font><br>";
    ?>
    Username:<input type="text" name="username" autofocus value="<?php// echo set_value('username') ?>"/>
    <?php //echo form_error("username","<font color='red'>","</font>"); ?><br>
    Password:<input type="password" name="password"/>
    <?php //echo form_error("password","<font color='red'>","</font>"); ?><br>
    <input type="submit" value="Uloguj se"/>
</form>-->

   <!-- <body>
            <div class="container">
                <div class="row">
                    <div class="iffset-sm-4 col-sm-4 bg-secondary p-4 text-light">
                        <form name="loginform" action="<?php //echo site_url('Gost/ulogujse') ?>" method="post">
                            <div class="form-group">
                                <label for="Username">Username:</label>
                                <input type="text" class="form-control" name="username" id="Username"  value="<?php //echo set_value('username') ?>">
                                <?php //echo form_error("username","<font color='red'>","</font>"); ?><br>                                     
                            </div>
                            <div class="form-group">
                                <label for="Password">Password:</label>
                                <input type="password" class="form-control" name="password" id="Password">
                                <?php //echo form_error("password","<font color='red'>","</font>"); ?><br>
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Uloguj se">
                        </form>
                    </div>
                </div>
            </div>-->
        
        
 <br/>
<span style="background-color:red;">
    <div class="container"><!-- container class is used to centered  the body of the browser with some decent width-->
        <div class="row"><!-- row class is used for grid system in Bootstrap-->
            <div class="col-md-4 col-md-offset-4"><!--col-md-4 is used to create the no of colums in the grid also use for medimum and large devices-->
                <div class="login-panel panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Login</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="<?php echo site_url('Gost/ulogujse') ?>">
                            <fieldset>
                                 <?php
                                if (isset($poruka))
                                    echo "<font color='red'>$poruka</font><br>";
                                ?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Korisnicko ime" name="username" type="text" value="<?php echo set_value('username') ?>" autofocus>
                                </div>
                                <?php echo form_error('username'); ?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Lozinka" name="password" type="password" value="">
                                </div>
                                <?php echo form_error('password'); ?>

                                <input class="btn btn-lg btn-success btn-block" type="submit" value="Uloguj se" name="login" >
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</span>       