<?php
 //var_dump($partneri);
 echo "<br/><br/>";
//var_dump($clanovi);
foreach ($clanovi as $clan) {
    $usernameClana=$clan['username'];
    $filtriraniPartneri = $partneri[$usernameClana];
    
        echo $usernameClana."<br/>";
        echo form_open("$kontroler/dodavanjePartneraClanu","method=post");
                echo "Dodaj Partnera Clanu: "?>
            <div class="row">
            <div class="col-md-3 col-md-offset-4">
                <input type="hidden" name="idKorisnika" value="<?php echo $clan['idKorisnik']; ?>">
                <div class="form-control">
                    <select name="id_partnera" class="form-control">
                                        <?php foreach ($partner as $value){ ?>
                                            <option value="<?php echo $value['idPartner']; ?>"><?php echo $value['naziv'];  ?></option>
                                        <?php } ?>
                    </select>
                </div>
                <input class="btn btn-lg btn-success btn-block" type="submit" value="Dodaj Partnera Clanu" name="dodavanjePartneraClanu" >
                </div>
               </div>
            <?php echo form_close();
        foreach ($filtriraniPartneri as $filtriraniPartner) {
            echo $filtriraniPartner['naziv']."<a href=" . site_url("$kontroler/izbrisiPartnerClan/".$filtriraniPartner['idKorisnik']."/".$filtriraniPartner['idPartner']) . ">Izbrisi</a><br/>";
        }
 
        echo "<br/><br/>";
    }

