<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
 
    <title>ETF Partneri</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <a class="navbar-brand" href="<?php echo site_url("Korisnik/index");?>">ETF Partneri</a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav">
            <li class="nav-item active">
            <a class="nav-link" href="<?php echo site_url("Korisnik/index");?>">Partneri clanovi<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url("Korisnik/partneri");?>">Partneri</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url("Korisnik/paketi"); ?>">Paketi</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url("Korisnik/oglasi"); ?>">Oglasi</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url("Korisnik/predavanja"); ?>">Predavanja</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url("Korisnik/dodajKompaniju"); ?>">Dodaj Kompanije</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url("Korisnik/dodajOglas"); ?>">Dodaj Oglasa</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url("Korisnik/dodajPredavanje"); ?>">Dodaj Predavanja</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url("Korisnik/logout");?>">Logout</a>
          </li>

        </ul>
       
      </div>

    </nav>
     <div class="container body">
