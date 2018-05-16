<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
 
    <title>ETF Partneri</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <a class="navbar-brand" href="<?php echo site_url("Admin/index");?>">ETF Partneri</a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav">
            <li class="nav-item active">
            <a class="nav-link" href="<?php echo site_url("Admin/index");?>">Partneri clanovi<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url("Admin/partneri");?>">Partneri</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url("Admin/paketi"); ?>">Paketi</a>
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
            <a class="nav-link" href="<?php echo site_url("Admin/logout");?>">Logout</a>
          </li>

        </ul>
       
      </div>

    </nav>
      Admin
     <div class="container body">
