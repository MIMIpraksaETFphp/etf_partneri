<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <title>ETF Partneri</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <script src="https://use.fontawesome.com/1f59a29ea5.js"></script>
        <link href="<?php echo base_url(); ?>assets/css/headercss.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/partnericss.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <header id="header">
            <div class="container">
                <strong id="logo">
                    <a title="" href="<?php echo site_url("Gost/index"); ?>">
                        <img src="<?php echo base_url('assets/logo/etf2.png'); ?>" alt="etf" class="img-responsive" width="100%" height="200"> 
                    </a>
                </strong>
            </div>
            <div id="nav-wrap">
                <nav id="nav">
                    <ul class="nav-strane">
                        <li class="nav-item"><a class="nav-link" href="<?php echo site_url("Gost/index"); ?>">Partneri fakulteta</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo site_url("Gost/paketi"); ?>">Paketi</a> </li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo site_url("Gost/oglasi"); ?>">Oglasi</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo site_url("Gost/predavanja"); ?>">Predavanja</a> </li>
                    </ul>
                    <ul class="nav-strane" id="nav-right">
                        <li class="nav-item"><a class="nav-link" href="<?php echo site_url("Gost/registracija"); ?>">Registracija</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo site_url("Gost/login"); ?>">Login</a></li>
                    </ul>
                </nav>
            </div>
        </header>
        <div class="container body">
