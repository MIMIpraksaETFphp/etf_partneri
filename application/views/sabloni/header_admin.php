<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <title>ETF Partneri</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <script src="https://use.fontawesome.com/1f59a29ea5.js"></script>
        
        <script src="<?php echo base_url('assets/js/vis.js'); ?>"></script>
        <link href="<?php echo base_url(); ?>assets/css/vis-timeline-graph2d.min.css" rel="stylesheet" type="text/css" />

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
        <div class="row">
            <div class="col-md-12">  
                <img src="<?php echo base_url('assets/logo/etfetf.jpg'); ?>" alt="etf" class="img-responsive" width="100%" height="200"> 
            </div>
        </div>    
        <nav class="navbar navbar-expand-md navbar-light bg-light">
            <a class="navbar-brand" href="<?php echo site_url("Admin/index"); ?>">ETF Partneri</a>

            <div class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url("Admin/index"); ?>">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url("Admin/dashboard"); ?>">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url("Admin/korisnici"); ?>">Partneri clanovi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url("Admin/partneri"); ?>">Partneri</a>
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
                        <a class="nav-link" href="<?php echo site_url("Admin/Clanovi"); ?>">Clanovi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url("Admin/dodajPaket"); ?>">Dodaj Paket</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ugovori
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" name="ugovori" value="">
                            <a class="dropdown-item" href="<?php echo site_url("Admin/novcaniUgovori"); ?>">Novcani ugovori</a>
                            <a class="dropdown-item" href="<?php echo site_url("Admin/donatorskiUgovori"); ?>">Donatorski ugovori</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dodaj ugovor
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" name="ugovori" value="">
                            <a class="dropdown-item" href="<?php echo site_url("Admin/dodajUgovor"); ?>">Novcani ugovori</a>
                            <a class="dropdown-item" href="<?php echo site_url("Admin/dodajUgovorDonacije"); ?>">Donatorski ugovori</a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url("Admin/mejl"); ?>">Mejl</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url("Admin/logout"); ?>">Logout</a>
                    </li>

                </ul>

            </div>

        </nav>
        <div class="container body">
