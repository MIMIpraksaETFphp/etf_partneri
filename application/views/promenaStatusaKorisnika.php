<br />
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
echo "<br/><br/>Trenutni status korisnika:";?>
<br/>
<table class="table" >
    <?php
    // foreach ($trenutniStat as $el) {
    ?>
    <tbody>
        <?php
//            echo "<br/><br/>" . $el['username'] . "- ";                                        // table-striped za poboljsavanje tabele al moze i ovako klot
//            echo $el['ime'] . " ";
//            echo $el['prezime'] . " ";
//            echo "Trenutni status korisnika: " . $el['status_korisnika_idtable1'] . "<br/>";
        ?>
        <tr>
            <th>Username</th>
            <th>Ime</th>
            <th>Prezime</th>
            <th>Trenutni status korisnika</th>
        </tr>

        <tr>
            <?php
            foreach ($trenutniStat as $el) {
                ?>
                <td><?php echo $el['username']; ?></td>
                <td><?php echo $el['ime']; ?></td>
                <td><?php echo $el['prezime']; ?></td>
                <td><?php echo $el['status_korisnika_idtable1']; ?></td>
            </tr>
        </tbody>
        <?php
    }
    ?>
</table>

<br/><h5><a href="<?php echo site_url($kontroler.'/registracija');?>">Registruj novog korisnika</h5></a><br /><br />
