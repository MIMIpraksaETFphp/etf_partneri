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