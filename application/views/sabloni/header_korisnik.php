<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <title>ETF Partneri</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <script src="https://use.fontawesome.com/1f59a29ea5.js"></script>
         <script src="//cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
        <link href="<?php echo base_url(); ?>assets/css/headercss.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/partnericss.css" rel="stylesheet" type="text/css" />
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
        <header id="header">
            <div class="toolbar">
                <ul id="nav-right">
                    <li class="nav-item"><a class="nav-link" href="<?php echo site_url("Admin/mojProfil"); ?>">Moj profil</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo site_url("Admin/logout"); ?>">Logout</a></li>
                </ul>
            </div>
            <div class="container">
                <strong id="logo">
                    <a title="" href="<?php echo site_url("Korisnik/index"); ?>">
                        <img src="<?php echo base_url('assets/logo/etf2.png'); ?>" alt="etf" class="img-responsive" width="100%" height="200"> 
                    </a>
                </strong>
            </div>
            <div id="nav-wrap">
                <nav id="nav">
                    <ul class="nav-strane">
                        <li class="nav-item"><a class="nav-link" href="<?php echo site_url("Korisnik/index"); ?>">Pretraga partnera</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo site_url("Korisnik/partneri"); ?>">Partneri fakulteta</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo site_url("Korisnik/paketi"); ?>">Paketi</a> </li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo site_url("Korisnik/oglasi"); ?>">Oglasi</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo site_url("Korisnik/predavanja"); ?>">Predavanja</a> </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Dodaj
                            </a>
                            <div class="dropdown-menu" name="dodaj" value="">
                                <a class="dropdown-item" href="<?php echo site_url("Korisnik/dodajPartnera"); ?>">Dodaj Kompaniju</a>
                                <a class="dropdown-item" href="<?php echo site_url("Korisnik/dodajOglas"); ?>">Dodaj Oglas</a>
                                <a class="dropdown-item" href="<?php echo site_url("Korisnik/dodajPredavanje"); ?>">Dodaj Predavanje</a>
                            </div>
                        </li>        
                    </ul>
                </nav>
            </div>
        </header>
        <div class="container body">
