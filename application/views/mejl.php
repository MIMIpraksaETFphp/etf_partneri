<br />
<span style="background-color:red;">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-4">
                <div class="login-panel panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">E-mail</h3>
                    </div>
                    <div class="panel-body">

                        <form role="form" method="post" action="<?php echo site_url("$kontroler/saljiMejl"); ?>">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="TO:" name="to" type="text" value="<?php if (!empty($to)) echo $to; ?>">
                                </div>
                                <?php echo form_error('to'); ?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="CC:" name="cc" type="text" >
                                </div>
                                <?php echo form_error('cc'); ?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="BCC:" name="bcc" type="text" >
                                </div>
                                <?php echo form_error('bcc'); ?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Subject" name="subject" type="text" value="<?php if (!empty($subject)) echo $subject; ?>" >
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Sadrzaj" name="message" id="message" type="text">
                                    </textarea>
                                    <script>
                                        document.getElementById("message").value = "<p><?php if (!empty($message)) echo $message; ?></p>";
                                        CKEDITOR.replace("message");
                                    </script>
                                </div>
                                <input type="hidden" name="datum_slanja" value="<?php echo mdate('%Y-%m-%d %H:%i:%s', now()); ?>"/>
                                <!--<div class="form-group">-->
                                    <input class="btn btn-lg btn-success btn-block col-md-4" type="submit" value="Pošalji" name="submit" >
                                <!--</div-->
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>





</span>
