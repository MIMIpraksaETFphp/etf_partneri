<?php

class Korisnik extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("ModelKorisnik");
        $this->load->model("ModelGost");

        $this->load->library('session');
        // if(($this->session->userdata('korisnik'))==NULL)
        //redirect ("Gost");
    }

    public function loadView($page, $data = []) {
        $this->load->view("sabloni/header_korisnik.php");
        $this->load->view($page, $data);
        $this->load->view("sabloni/footer.php");
    }

    public function index($pocetni_index = 0) {
        $data['kontroler'] = 'Korisnik';
        $data['metoda'] = 'index';

        $kompanija = $this->input->post("kompanija");
        $paket = $this->input->post("paket");
        $vazeciUgovor = $this->input->post("vazeciUgovor");
        $limit = 2;
        $pocetni_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $rezultat = $this->ModelKorisnik->pretragaPartnera($limit, $pocetni_index);
        $data['rezultat'] = $rezultat;

        $ukupanBrPartnera = $this->ModelKorisnik->brojPartnera();
        
        $this->config->load('bootstrap_pagination');
        $config_pagination=$this->config->item('pagination');
        $config_pagination['base_url']= site_url("Korisnik/index");
        $config_pagination['total_rows']=$ukupanBrPartnera;
        $config_pagination['per_page']= $limit;
        $config_pagination['next_link'] = 'Next';
        $config_pagination['prev_link'] = 'Prev';
        
        
        $this->pagination->initialize($config_pagination);
        $data['links']=$this->pagination->create_links();

        $this->loadView("partneriClanovi.php", $data);
    }

    public function dodajKompaniju() {
        $this->loadView("dodajKompaniju.php");
    }

    public function dodajOglas() {
        $this->loadView("dodajOglas.php");
    }

    public function dodajPredavanje() {
        $this->loadView("dodajPredavanje.php");
    }

    public function logout() {
        $this->session->unset_userdata('korisnik');
        $this->session->sess_destroy();
        redirect("Gost");
    }

    public function paketi() {
        $paketi = $this->ModelGost->spisakPaketa();
        $paketiStavke = $this->ModelGost->ispisPaketa();
        $data['paketi'] = $paketi;
        $data['paketiStavke'] = $paketiStavke;
        $this->loadView("paketi.php", $data);
    }

    public function oglasi() {
        $data['oglasi'] = $this->ModelGost->pretragaOglasa();
        $this->loadView("oglasi.php", $data);
    }

    public function predavanja() {
        $predavanja = $this->ModelGost->ispisPredavanja();
        $data['kontroler'] = 'korisnik';
        $data['predavanja'] = $predavanja;
        $this->loadView("predavanja.php", $data);
    }

    public function arhiva() {
        $predavanja = $this->ModelGost->ispisPredavanjaArhiva();
        $data['predavanja'] = $predavanja;
        $this->loadView("arhivaPredavanja.php", $data);
    }

    public function partneri() {
        $kompanija = $this->input->post("kompanija");

        $partneri = $this->ModelGost->pretraga($kompanija);
//            $data['partneri'] = $partneri;

        $paketi = $this->ModelGost->spisakPaketa();
        $data['paketi'] = $paketi;

        foreach ($paketi as $paket) {
            $naziv_paketa = $paket['naziv_paketa'];
            $data['partneri'][$naziv_paketa] = $this->filtrirajPartnere($paket, $partneri);
        }
        $data['kontroler'] = 'korisnik';
        $data['metoda'] = 'partneri';
        $this->loadView("partneri.php", $data);
    }

    private function filtrirajPartnere($paket, $partneri) {
        $filter = array($paket['naziv_paketa']);
        $filtriraniPartneri = array_filter($partneri, function ($s) use ($filter) {
            return in_array($s['naziv_paketa'], $filter);
        });
        return $filtriraniPartneri;
    }

}
