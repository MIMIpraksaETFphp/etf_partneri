<?php echo form_open("$kontroler/dodavanjeStatusaClanu", "method=post"); ?>
<div class="row">
    <div class="col-md-3 col-md-offset-4">
        <div class="form-control">

            <select name="idKorisnik" class="form-control">
                <?php foreach ($status as $el) { ?>
                    <option value="<?php echo $el['idKorisnik']; ?>"><?php echo $el['username']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
</div>    
<div class="row">
    <div class="col-md-3 col-md-offset-4">
        <div class="form-control">

            <select name="statusKorisnika" class="form-control">
                <?php foreach ($status2 as $el) { ?>
                    <option value="<?php echo $el['idtable1']; ?>"><?php echo $el['opis']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>     
</div>
<div class="row"> 
    <div class="col-md-3 col-md-offset-4">
        <div>
            <input class="btn btn-lg btn-success btn-block" type="submit" value="Promena statusa korisnika" name="dodavanjeStatusaClanu" >
        </div>
    </div>
</div>

<?php echo form_close(); ?>

<?php
echo "<br/><br/>Trenutni status korisnika:";

foreach ($trenutniStat as $el) {

    echo "<br/><br/>".$el['username'] ."- ";
    echo $el['ime'] ." ";
    echo $el['prezime'] ." ";
    echo "Trenutni status korisnika: " . $el['status_korisnika_idtable1'] . "<br/>";
}
?>