<form name="loginform" action="<?php echo site_url('Gost/ulogujse') ?>" method="post">
    <?php if(isset($poruka))
        echo "<font color='red'>$poruka</font><br>";
    ?>
    Username:<input type="text" name="username" value="<?php echo set_value('username') ?>"/>
    <?php echo form_error("username","<font color='red'>","</font>"); ?><br>
    Password:<input type="password" name="password"/>
    <?php echo form_error("password","<font color='red'>","</font>"); ?><br>
    <input type="submit" value="Uloguj se"/>
</form>

   <!-- <body>
            <div class="container">
                <div class="row">
                    <div class="iffset-sm-4 col-sm-4 bg-secondary p-4 text-light">
                        <form name="loginform" action="<?php //echo site_url('Gost/ulogujse') ?>" method="post">
                            <div class="form-group">
                                <label for="Username">Username:</label>
                                <input type="text" class="form-control" name="username" id="Username"  value="<?php echo set_value('username') ?>">
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
        
        
        