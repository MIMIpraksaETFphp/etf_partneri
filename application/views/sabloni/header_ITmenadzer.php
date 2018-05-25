<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
 
    <title>ETF Partneri</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/1f59a29ea5.js"></script>
    
<?php      
        if (($this->session->userdata('korisnik')) == NULL) 
           redirect("Gost");
       elseif ($this->session->userdata('korisnik')->status_korisnika_idtable1 == 2) 
            redirect("korisnik");
//       elseif ($this->session->userdata('korisnik')->status_korisnika_idtable1 == 3) 
//           redirect("ITmenadzer");
       elseif($this->session->userdata('korisnik')->status_korisnika_idtable1 == 4)
               redirect("Admin");
?>       
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <a class="navbar-brand" href="<?php echo site_url("ITmenadzer/index");?>">ETF Partneri</a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav">
            <li class="nav-item active">
            <a class="nav-link" href="<?php echo site_url("ITmenadzer/index");?>">IT menadzer<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url("ITmenadzer/part");?>">Partneri clanovi</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url("ITmenadzer/partneri");?>">Partneri</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url("ITmenadzer/paketi"); ?>">Paketi</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url("ITmenadzer/oglasi"); ?>">Oglasi</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url("ITmenadzer/predavanja"); ?>">Predavanja</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url("ITmenadzer/dodajPartnera"); ?>">Dodaj Kompanije</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url("ITmenadzer/dodajOglas"); ?>">Dodaj Oglasa</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url("ITmenadzer/dodajPredavanje"); ?>">Dodaj Predavanja</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url("ITmenadzer/Clanovi"); ?>">Clanovi</a>
          </li>

          <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Ugovori
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" name="ugovori" value="">
            <a class="dropdown-item" href="<?php echo site_url("ITmenadzer/novcaniUgovori"); ?>">Novcani ugovori</a>
          <a class="dropdown-item" href="<?php echo site_url("ITmenadzer/donatorskiUgovori"); ?>">Donatorski ugovori</a>
        </div>
          </li>
          
           <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dodaj ugovor
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" name="ugovori" value="">
            <a class="dropdown-item" href="<?php echo site_url("ITmenadzer/dodajUgovor"); ?>">Novcani ugovori</a>
          <a class="dropdown-item" href="<?php echo site_url("ITmenadzer/dodajUgovorDonacije"); ?>">Donatorski ugovori</a>
        </div>
          </li>
          
          <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url("ITmenadzer/mejl"); ?>">Mejl</a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url("ITmenadzer/logout");?>">Logout</a>
          </li>

        </ul>
       
      </div>

    </nav>
      IT menadzer
     <div class="container body">
