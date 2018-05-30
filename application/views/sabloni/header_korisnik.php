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
//       elseif ($this->session->userdata('korisnik')->status_korisnika_idtable1 == 2) 
//            redirect("korisnik");
        elseif ($this->session->userdata('korisnik')->status_korisnika_idtable1 == 3)
            redirect("ITmenadzer");
        elseif ($this->session->userdata('korisnik')->status_korisnika_idtable1 == 4)
            redirect("Admin");
        ?>  

    </head>

    <body>
        <div class="row">
            <div class="col-md-12">  
                <img src="<?php echo base_url('assets/logo/etf.jpg'); ?>" alt="etf" class="img-responsive" width="100%" height="250"> 
            </div>
        </div>    
        <nav class="navbar navbar-expand-md navbar-light bg-light">
            <a class="navbar-brand" href="<?php echo site_url("Korisnik/index"); ?>">ETF Partneri</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item ">
                        <a class="nav-link" href="<?php echo site_url("Korisnik/index"); ?>">Partneri clanovi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url("Korisnik/partneri"); ?>">Partneri</a>
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
                        <a class="nav-link" href="<?php echo site_url("Korisnik/dodajPartnera"); ?>">Dodaj Kompaniju</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url("Korisnik/dodajOglas"); ?>">Dodaj Oglasa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url("Korisnik/dodajPredavanje"); ?>">Dodaj Predavanja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url("Korisnik/mojProfil"); ?>">Moj profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url("Korisnik/logout"); ?>">Logout</a>
                    </li>                    
                </ul>

            </div>

        </nav>
        <div class="container body">
