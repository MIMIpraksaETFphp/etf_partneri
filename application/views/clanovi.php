<br />
<?php
// var_dump($partner);
//var_dump($clanovi);
echo form_error('id_partnera'); 
foreach ($clanovi as $clan) {
    if($clan['status_korisnika_idtable1']==2 || $clan['status_korisnika_idtable1']==3 || $clan['status_korisnika_idtable1']==4){
        $usernameClana = $clan['username'];
        $filtriraniPartneri = $partneri[$usernameClana];
        // var_dump($filtriraniPartneri);
        // var_dump($clan);
        ?>
        <br />
        <div class="row">
            <div class="col-md-4 col-md-offset-4 ">
                <table class="table table-bordered">

                    <th><?php echo $usernameClana . "<br/>" ?></th>
                    <?php echo form_open("$kontroler/dodavanjePartneraClanu", "method=post"); ?>
                    <tr><td>  <?php echo "Dodaj Partnera Članu: " ?></td>
                    <input type="hidden" name="idKorisnika" value="<?php echo $clan['idKorisnik']; ?>">
                    </tr>
                    <tr>
                        <td> <select name="id_partnera" class="form-control">
                                <?php foreach ($partner as $value) { ?>
                                    <option value="<?php echo $value['idPartner']; ?>"><?php echo $value['naziv']; ?></option>
                                <?php } ?>
                            </select></td>
                    </tr>
                    <tr>
                        <td><input class="btn btn-success btn-block" type="submit" value="Dodaj Partnera Clanu" name="dodavanjePartneraClanu" ></td>
                    </tr>
                    <tr>
                        <td><h6>Clan je zaduzen za kompanije: </h6></td>
                    </tr>
                    <?php
                    echo form_close();
                    foreach ($filtriraniPartneri as $filtriraniPartner) {
                        ?>
                        <tr>
                            <td><?php echo $filtriraniPartner['naziv']; ?>
                            <a href="<?php echo site_url($kontroler.'/izbrisiPartnerClan/'.$filtriraniPartner['idKorisnik'].'/'.$filtriraniPartner['idPartner']);?>">Izbrisi</a></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
        </div>
<?php
    }
}
?>

