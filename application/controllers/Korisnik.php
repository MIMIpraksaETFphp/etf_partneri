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

public function dodajKompaniju(){
    $this->loadView("dodajKompaniju.php");
}

public function dodajOglas(){
    $this->loadView("dodajOglas.php");
}

public function dodajPredavanje(){
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
        $data['oglasi']= $this->ModelGost->pretragaOglasa();
        $this->loadView("oglasi.php", $data);
    }

    public function predavanja() {
        $predavanja = $this->ModelGost->ispisPredavanja();
        $data['kontroler']='korisnik';
        $data['predavanja']=$predavanja;
        $this->loadView("predavanja.php", $data);
    }
    
    public function arhiva() {
        $predavanja = $this->ModelGost->ispisPredavanjaArhiva();
        $data['predavanja']=$predavanja;
        $this->loadView("arhivaPredavanja.php", $data);
    }
    
    public function partneri(){
        $kompanija = $this->input->post("kompanija");

        $partneri = $this->ModelGost->pretraga($kompanija);
//            $data['partneri'] = $partneri;

        $paketi = $this->ModelGost->spisakPaketa();
        $data['paketi'] = $paketi;

        foreach ($paketi as $paket){
            $naziv_paketa=$paket['naziv_paketa'];
            $data['partneri'][$naziv_paketa]=$this->filtrirajPartnere($paket,$partneri);
        }
        $data['kontroler']='korisnik';
        $data['metoda']='partneri';
        $this->loadView("partneri.php", $data);
    }
    private function filtrirajPartnere($paket,$partneri){
        $filter = array($paket['naziv_paketa']);
        $filtriraniPartneri = array_filter($partneri, function ($s) use ($filter) {
            return in_array($s['naziv_paketa'], $filter);
        });
        return $filtriraniPartneri;
    }
    
    
    public function dodajPartnera() {
        $this->form_validation->set_rules("naziv", "naziv", "required");
        $this->form_validation->set_rules("adresa", "adresa", "required");
        $this->form_validation->set_rules("postanski_broj", "postanski_broj", "required");
        $this->form_validation->set_rules("grad", "grad", "required");
        $this->form_validation->set_rules("drzava", "drzava", "required");
        $this->form_validation->set_rules("ziro_racun", "ziro_racun", "required");
//      $this->form_validation->set_rules("valuta_racuna", "valuta_racuna", "required");
        $this->form_validation->set_rules("PIB", "PIB", "required");
        $this->form_validation->set_rules("telefon1", "telefon1", "required");
        $this->form_validation->set_rules("email1", "email1", "required");
        $this->form_validation->set_rules("opis", "opis", "required");
        $this->form_validation->set_rules("veb_adresa", "veb_adresa", "required");
        $this->form_validation->set_rules("ime_kontakt_osobe", "ime_kontakt_osobe", "required");
        $this->form_validation->set_rules("prezime_kontakt_osobe", "prezime_kontakt_osobe", "required");
        $this->form_validation->set_rules("telefon_kontakt_osobe", "telefon_kontakt_osobe", "required");
        $this->form_validation->set_rules("email_kontakt_osobe", "email_kontakt_osobe", "required");
        $this->form_validation->set_message("required", "Polje {field} je ostalo prazno");
        if ($this->form_validation->run() == FALSE) {
            $this->dodajKompaniju();
        } else {         
            $partner = array(
                'naziv' => $this->input->post('naziv'),
                'adresa' => $this->input->post('adresa'),
                'postanski_broj' => $this->input->post('postanski_broj'),
                'grad' => $this->input->post('grad'),
                'drzava' => $this->input->post('drzava'),
                'ziro_racun' => $this->input->post('ziro_racun'),
                'valuta_racuna' => $this->input->post('valuta_racuna'),
                'PIB' => $this->input->post('PIB'),
                'telefon1' => $this->input->post('telefon1'),
                'telefon2' => $this->input->post('telefon2'),
                'email1' => $this->input->post('email1'),
                'email2' => $this->input->post('email2'),
                'email3' => $this->input->post('email3'),
                'email4' => $this->input->post('email4'),
                'email5' => $this->input->post('email5'),
                'opis' => $this->input->post('opis'),
                'veb_adresa' => $this->input->post('veb_adresa'),
                'ime_kontakt_osobe' => $this->input->post('ime_kontakt_osobe'),
                'prezime_kontakt_osobe' => $this->input->post('prezime_kontakt_osobe'),
                'telefon_kontakt_osobe' => $this->input->post('telefon_kontakt_osobe'),
                'email_kontakt_osobe' => $this->input->post('email_kontakt_osobe'),

            );

            $insertovanidPartnera=$this->ModelKorisnik->dodatPartner($partner);
            for($i=1;$i<=5;$i++) {
                if(!empty($partner['email'.$i])) {
                    $email=$partner['email'.$i];
                    $this->ModelKorisnik->dodatEmailPartnera($email, $insertovanidPartnera);
                }
            }
            for($i=1;$i<=2;$i++) {
                if(!empty($partner['telefon'.$i])) {
                    $telefon=$partner['telefon'.$i];
                    $this->ModelKorisnik->dodatTelefonPartnera($telefon, $insertovanidPartnera);
                }
            }
            redirect("Korisnik/dodajKompaniju");
    }
}




}
