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

    public function index() {
        $this->loadView("partneriClanovi.php");
    }

    public function dodajKompaniju() {
        $this->loadView("dodajKompaniju.php");
    }

    public function dodajOglas() {
        $this->loadView("dodajOglas.php");
    }

    public function dodavanjeOglasa() {
        $this->form_validation->set_rules("oglasnaslov", "oglasnaslov", "required");
        $this->form_validation->set_rules("oglastext", "oglastext", "required");
        if ($this->form_validation->run() == FALSE) {
            $this->dodajOglas();
        } else {
            $a = $this->input->post('praksa');
            $b = $this->input->post('zaposlenje');
            if ($a == NULL)
                $a = 0;

            if ($b == NULL)
                $b = 0;
            $oglas = array(
                'oglasnaslov' => $this->input->post('oglasnaslov'),
                'oglastext' => $this->input->post('oglastext'),
                'praksa' => $a,
                'zaposlenje' => $b,
                'datum_unosenja' => $this->input->post('datum_unosenja')
            );
            
            $this->ModelKorisnik->dodatOglas($oglas);
            redirect("Korisnik/index");
        }
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
