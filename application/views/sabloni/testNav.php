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
//       elseif ($this->session->userdata('korisnik')->status_korisnika_idtable1 == 3) 
//           redirect("ITmenadzer");
        elseif ($this->session->userdata('korisnik')->status_korisnika_idtable1 == 4)
            redirect("Admin");
        ?>    
          </head>

    <body>
<!--        <div class="row">
        <div class="col-md-12">  
            <img src="<?php echo base_url('assets/logo/etfetf.jpg'); ?>" alt="etf" class="img-responsive" width="100%" height="200"> 
        </div>
        </div>    -->
<section class="cover text-center">
    <nav class="navbar navbar-toggleable-sm navbar-trans navbar-inverse">
        <div class="container">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarToggler-1" aria-controls="navbarToggler-1" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">Bootstrap 4 Cover Nav</a>
            <div class="collapse navbar-collapse pull-xs-right justify-content-end" id="navbarToggler-1">
                <ul class="navbar-nav mt-2 mt-md-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Our Work</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-white btn-outline" href="#"><i class="fa fa-user"></i> Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</section>
        <div class="container body">