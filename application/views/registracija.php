
<?php
/*
echo form_open("Gost/registracija", "method=post");
echo "Korisnicko ime";
echo form_input("username", set_value('username'));
echo "<br/>Lozinka";
echo form_password("password", set_value('password'));
echo "<br/>Ponovi lozinku";
echo form_password("password", set_value('password'));
echo "<br/>Ime";
echo form_input("ime", set_value('ime'));
echo "<br/>Prezime";
echo form_input("prezime", set_value('prezime'));
echo "<br/>";
//echo "<br/>Datum rodjenja"; 
// ubacujemo jquery za datum rodjenja...ali ne izbacuje kao na slici na netu kalendar...*/
?>

<!--<script type="text/javascript">
            $(function() {
                $("#datepicker").datepicker({
                    minDate : 0,
                    dateFormat: 'yy-mm-dd'
                });
                
            });
</script>
          <label id ="pdesc_txt">Datum rodjenja:</label>

            <input type="text" id="datepicker" placeholder="Pickup Date" name="Datum rodjenja"/>-->
            
<?php
/*
echo "<br/>Telefon";
echo form_input("telefon", set_value('telefon'));
echo "<br/>e-mail";
echo form_input("mail", set_value('mail'));
echo "<br/>";
echo form_submit("registracija", "Registruj se");
echo form_close();
*/
?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" media="screen" title="no title">
 
<span style="background-color:red;">
  <div class="container"><!-- container class is used to centered  the body of the browser with some decent width-->
      <div class="row"><!-- row class is used for grid system in Bootstrap-->
          <div class="col-md-4 col-md-offset-4"><!--col-md-4 is used to create the no of colums in the grid also use for medimum and large devices-->
              <div class="login-panel panel panel-success">
                  <div class="panel-heading">
                      <h3 class="panel-title">Registracija</h3>
                  </div>
                  <div class="panel-body">
 
                  <?php
                  /*$error_msg=$this->session->flashdata('error_msg');
                  if($error_msg){
                    echo $error_msg;
                  } */
                   ?>
 
                      <form role="form" method="post" action="<?php echo site_url('Gost/registracija'); ?>">
                          <fieldset>
                              <div class="form-group">
                                  <input class="form-control" placeholder="Korisnicko ime" name="username" type="text" autofocus>
                              </div>
                              <div class="form-group">
                                  <input class="form-control" placeholder="Lozinka" name="password" type="password" value="">
                              </div>
                            
                              <div class="form-group">
                                  <input class="form-control" placeholder="Potvrdi Lozinku" name="password" type="password" value="">
                              </div>
                              <div class="form-group">
                                  <input class="form-control" placeholder="Ime" name="ime" type="text" value="">
                              </div>
                              <div class="form-group">
                                  <input class="form-control" placeholder="Prezime" name="prezime" type="text" value="">
                              </div>
                              <div class="form-group">
                                  <input class="form-control" placeholder="E-mail" name="mail" type="email" autofocus>
                              </div>
                              <div class="form-group">
                                  <input class="form-control" placeholder="Godine" name="godine" type="number" value="">
                              </div>
 
                              <div class="form-group">
                                  <input class="form-control" placeholder="Telefon" name="telefon" type="number" value="">
                              </div>
 
                              <input class="btn btn-lg btn-success btn-block" type="submit" value="Registruj se" name="registracija" >
 
                          </fieldset>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
 
 
 
 
 
</span>