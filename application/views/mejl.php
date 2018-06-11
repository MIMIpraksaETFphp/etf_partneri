<br />
<span style="background-color:red;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="login-panel panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title col-md-12 col-md-offset-4">E-mail</h3>
                    </div>
                    <div class="panel-body">

                        <form role="form" method="post" action="<?php echo site_url("$kontroler/saljiMejl"); ?>">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control col-md-6" placeholder="TO:" name="to" type="text" value="<?php if (!empty($to)) {echo $to;} ?>">
                                <span class="message col-md-6"><?php echo form_error('to'); ?></span>
                                </div>
                                <div class="form-group">
                                    <input class="form-control col-md-6" placeholder="CC:" name="cc" type="text" >
                                <span class="message col-md-6"><?php echo form_error('cc'); ?></span>
                                </div>
                                <div class="form-group">
                                    <input class="form-control col-md-6" placeholder="BCC:" name="bcc" type="text" >
                                
                                <span class="message col-md-6"><?php echo form_error('bcc'); ?></span>
                                </div>
                                <div class="form-group">
                                    <input class="form-control col-md-6" placeholder="Subject" name="subject" type="text" value="<?php if (!empty($subject)) {echo $subject;} ?>" >
                                </div>
                                <div class="form-group col-md-6">
                                    <textarea class="form-control col-md-6" placeholder="Sadrzaj" name="message" id="message" type="text">
                                    </textarea>
                                    <script>
                                        document.getElementById("message").value = "<p><?php if (!empty($message)) {echo $message;} ?></p>";
                                        CKEDITOR.replace("message");
                                    </script>
                                </div>
                                <input type="hidden" name="datum_slanja" value="<?php echo mdate('%Y-%m-%d %H:%i:%s', now()); ?>"/>
                                <div class="form-group">
                                <input class="btn btn-lg btn-success btn-block col-md-3" type="submit" value="Pošalji" name="submit" >
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>





</span>
