<br/>
<?php 
$podaci = array(
    'ime' => $this->session->korisnik->ime,
    'prezime' => $this->session->korisnik->prezime,
    'username' => $this->session->korisnik->username,
    'datum_rodjenja' => $this->session->korisnik->datum_rodjenja,
    'telefon' => $this->session->korisnik->telefon,
    'email' => $this->session->korisnik->email,
);
// var_dump($podaci);

?>

<table class="table table-striped ">
<th colspan='2'>Vaši podaci</th>
<?php
    echo "<tr><td>Ime:</td><td> " . $podaci['ime'] . "</td></tr>";
    echo "<tr><td>Prezime:</td><td> " . $podaci['prezime'] . "</td></tr>";
    echo "<tr><td>Datum rodjenja:</td><td> " . $podaci['datum_rodjenja'] . "</td></tr>";
    echo "<tr><td>Telefon:</td><td> " . $podaci['telefon'] . "</td></tr>";
    echo "<tr><td>Email:</td><td> " . $podaci['email'] . "</td></tr>";
?>
<tr><td colspan='2'><a href='<?php echo site_url("$kontroler/promeniPassword");?>'>Promeni password</a></td></tr>
</table>