<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
 
    <title>ETF Partneri</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

        <?php      
        if (($this->session->userdata('korisnik')) == NULL) 
           redirect("Gost");
       elseif ($this->session->userdata('korisnik')->status_korisnika_idtable1 == 2) 
            redirect("korisnik");
       elseif ($this->session->userdata('korisnik')->status_korisnika_idtable1 == 3) 
           redirect("ITmenadzer");
//       elseif($this->session->userdata('korisnik')->status_korisnika_idtable1 == 4)
//               redirect("Admin");
?>  
    
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <a class="navbar-brand" href="<?php echo site_url("Admin/index");?>">ETF Partneri</a>

      <div class="collapse navbar-collapse">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url("Admin/index");?>">Partneri clanovi</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url("Admin/korisnici");?>">Korisnici</a>
          </li>
         <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url("Admin/partneri");?>">Partneri</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url("Admin/adminPaketi"); ?>">Paketi</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url("Admin/oglasi"); ?>">Oglasi</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url("Admin/predavanja"); ?>">Predavanja</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url("Admin/dodajPartnera"); ?>">Dodaj Kompanije</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url("Admin/dodajOglas"); ?>">Dodaj Oglasa</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url("Admin/dodajPredavanje"); ?>">Dodaj Predavanja</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url("Admin/dodajPaket"); ?>">Dodaj Paket</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url("Admin/logout");?>">Logout</a>
          </li>

        </ul>
       
      </div>

    </nav>
      Admin
     <div class="container body">
