<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <title>ETF Partneri</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous"> 
        <script src="https://use.fontawesome.com/1f59a29ea5.js"></script>

        <script src="<?php echo base_url('assets/js/vis.js'); ?>"></script>
        <link href="<?php echo base_url(); ?>assets/css/vis-timeline-graph2d.min.css" rel="stylesheet" type="text/css" />  
        <link href="<?php echo base_url(); ?>assets/css/headercss.css" rel="stylesheet" type="text/css" />

        <?php
        if (($this->session->userdata('korisnik')) == NULL) {
            redirect("Gost");
        } elseif ($this->session->userdata('korisnik')->status_korisnika_idtable1 == 2) {
            redirect("korisnik");
        }
//       elseif ($this->session->userdata('korisnik')->status_korisnika_idtable1 == 3) 
//           redirect("ITmenadzer");
        elseif ($this->session->userdata('korisnik')->status_korisnika_idtable1 == 4) {
            redirect("Admin");
        }
        ?>    
    </head>
    <body>
        <header id="header">
            <div class="container">
                <strong id="logo">
                    <a title="" href="<?php echo site_url("ITmenadzer/index"); ?>">
                        <img src="<?php echo base_url('assets/logo/etf2.png'); ?>" alt="etf" class="img-responsive" width="100%" height="200"> 
                    </a>
                </strong>
            </div>
            <div id="nav-wrap">
                <nav id="nav">
                    <ul class="nav-strane">
                        <li><a href="<?php echo site_url("ITmenadzer/index"); ?>">Dashboard</a></li>
                        <li><a href="<?php echo site_url("ITmenadzer/part"); ?>">Partneri clanovi</a></li>
                        <li><a href="<?php echo site_url("ITmenadzer/partneri"); ?>">Partneri fakulteta</a></li>
                        <li><a href="<?php echo site_url("ITmenadzer/paketi"); ?>">Paketi</a> </li>
                        <li><a href="<?php echo site_url("ITmenadzer/oglasi"); ?>">Oglasi</a></li>
                        <li><a href="<?php echo site_url("ITmenadzer/predavanja"); ?>">Predavanja</a> </li>
                        <li><a href="<?php echo site_url("ITmenadzer/novcaniUgovori"); ?>">Novcani ugovori</a></li>
                        <li><a href="<?php echo site_url("ITmenadzer/donatorskiUgovori"); ?>">Donatorski ugovori</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Dodaj
                            </a>
                            <div class="dropdown-menu" name="dodaj" value="">
                                <a class="dropdown-item" href="<?php echo site_url("ITmenadzer/dodajPartnera"); ?>">Dodaj Kompaniju</a>
                                <a class="dropdown-item" href="<?php echo site_url("ITmenadzer/dodajOglas"); ?>">Dodaj Oglas</a>
                                <a class="dropdown-item" href="<?php echo site_url("ITmenadzer/dodajPredavanje"); ?>">Dodaj Predavanje</a>
                                <a class="dropdown-item" href="<?php echo site_url("ITmenadzer/dodajUgovor"); ?>">Dodaj novcani ugovor</a>
                                <a class="dropdown-item" href="<?php echo site_url("ITmenadzer/dodajUgovorDonacije"); ?>">Dodaj donatorski ugovor</a>
                            </div>
                        </li>             
                        <li><a href="<?php echo site_url("ITmenadzer/Clanovi"); ?>">Članovi</a></li>

                        <!--                        <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Ugovori
                                                    </a>
                                                    <div class="dropdown-menu" name="ugovori" value="">-->

                        <!--                            </div>
                                                </li>-->

                        <!--                        <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Dodaj ugovor
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" name="ugovori" value="">
                                                        <a class="dropdown-item" href="<?php echo site_url("ITmenadzer/dodajUgovor"); ?>">Novcani ugovori</a>
                                                        <a class="dropdown-item" href="<?php echo site_url("ITmenadzer/dodajUgovorDonacije"); ?>">Donatorski ugovori</a>
                                                    </div>
                                                </li>-->

                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url("ITmenadzer/mejl"); ?>">Mejl</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url("ITmenadzer/logout"); ?>">Logout</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
        <div class="container body">
