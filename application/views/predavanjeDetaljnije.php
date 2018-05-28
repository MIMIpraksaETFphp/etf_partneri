<?php            
      //  echo "<h2>".$predavanje['naslov_srpski']."</h2><br/><br/><h5>".$predavanje['ime_predavaca']." ".$predavanje['prezime_predavaca']."</h5><br/><br/>".$predavanje['sala']." ".$predavanje['vreme_predavanja']."<br/>".$predavanje['opis_srpski']."<br/><br/><h5>Biografija predavaca</h5>".$predavanje['cv_srpski'];
        ?>
<br/>
<table class="table table-striped ">
            <tbody>
            <th colspan="2"><?php echo $predavanje['naslov_srpski']  ?></th>
            <tr>
                <td>Opis predavanja</td>
                <td><?php echo $predavanje['opis_srpski']; ?></td>
            </tr>
            <tr>
                <td>Ime i prezime predavaca</td>
                <td><?php echo $predavanje['ime_predavaca']; ?>
                <?php echo $predavanje['prezime_predavaca']; ?></td>
            </tr>
            <tr>
                <td>Sala</td>
                <td><?php echo $predavanje['sala']; ?></td>
            </tr>
            <tr>
                <td>Vreme predavanja</td>
                <td><?php echo $predavanje['vreme_predavanja']; ?></td>
            </tr>
            <tr>
                <td>Biografija predavaca</td>
                <td><?php echo $predavanje['cv_srpski']; ?></td>
            </tr>
        </tbody>
</table>
