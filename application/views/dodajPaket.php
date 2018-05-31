<br />
<div class="panel-heading">
    <h3 class="panel-title">Dodaj Paket</h3>
</div>
<div class="panel-body">
    <?php echo form_open("Admin/dodavanjePaketa", "method=post"); ?>
    <div class="form-group">
        <label for="naziv">Naziv Paketa</label>
        <input class="form-control" type="text" name="naziv" placeholder="Uneti naziv Paketa" id="naziv" value="<?php echo set_value('naziv');?>">
    </div>
    <span style="color: red;"><?php echo form_error('naziv'); ?></span>
    <div class="form-group">
        <label for="vrednost">Vrednost Paketa u EUR</label><br />
        <input class="form-control" type="number" name="vrednost" placeholder="Uneti vrednost Paketa u EUR" id="vrednost" min="0" value="<?php echo set_value('vrednost');?>">
    </div>
    <span style="color: red;"><?php echo form_error('vrednost'); ?></span>
    <div class="form-group">
        <label for="trajanje">Trajanje ugovora</label><br />
        <input class="form-control" type="number" name="trajanje" placeholder="Uneti godine trajanja ugovora" id="trajanje" min="0" value="<?php echo set_value('trajanje');?>">
    </div>
    <span style="color: red;"><?php echo form_error('trajanje'); ?></span>
    <div class="form-group">
        <label for="maxbroj">Maksimalni broj kompanija u paketu</label><br />
        <input class="form-control" type="number" name="maxbroj" placeholder="Uneti max broj kompanija u paketu" id="maxbroj" min="0" value="<?php echo set_value('maxbroj');?>">
    </div>
    <span style="color: red;"><?php echo form_error('maxbroj'); ?></span>
    <div class="form-group">
        <label for="stavkeUbazi">Izaberite stavke paketa:</label><br />
        <?php for ($i = 0; $i < count($stavkeUbazi); $i++) { ?>
            <input type="checkbox" name="stavkeUbazi[]" value="<?php echo $stavkeUbazi[$i]['idstavke'];?>" id="stavke<?php echo $i; ?>"> <label for="stavke<?php echo $i;?>"><?php echo $stavkeUbazi[$i]['opis']; ?></label><br /> 
            <!--for($i) umesto foreach() zbog label taga-->
        <?php } ?>
    </div>

    <input class="btn btn-lg btn-success " type="submit" value="Dodaj Paket" name="dodavanjePaketa"/>

    <?php echo form_close(); ?>
    <br/> 
    <?php echo form_open("Admin/dodavanjeStavke", "method=post"); ?>
    <div class="form-group">
        <label for="novaStavka">Nova Stavka</label><br />
        <input class="form-control" type="text" name="novaStavka" placeholder="Uneti novu Stavku" id="novaStavka" value="<?php echo set_value('novaStavka');?>"><br />
        <span style="color: red;"><?php echo form_error('novaStavka'); ?></span>
        <input class="btn btn-lg btn-success " type="submit" value="Dodaj Stavku" name="dodavanjeStavke"/>
    </div>
    <?php echo form_close(); ?>
</div>

